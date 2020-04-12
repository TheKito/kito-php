<?php

/**
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 */

namespace Kito\SQL;

use Kito\NotImplementedException;

/**
 *
 * @author TheKito < blankitoracing@gmail.com >
 */
class MsSQL extends SQL implements SQLInterface {

    private $server;
    private $user;
    private $password;
    private $scheme;
    private $cnn = null;

    function __construct($server, $user, $password, $scheme) {
        $this->server = $server;
        $this->user = $user;
        $this->password = $password;
        $this->scheme = $scheme;

        $this->connect();
    }

    public function connect() {
        if ($this->isConnected()) {
            $this->close();
        }

        $this->cnn = @mssql_connect($this->server, $this->user, $this->password);

        if ($this->cnn === false) {
            $this->cnn = null;
            throw new ConnectException($this->server, $this->user, mssql_get_last_message(), -1);
        }


        if (!@mssql_select_db($this->scheme, $this->cnn)) {
            @mssql_close($this->cnn);
            $this->cnn = null;
            throw new SelectDBException($this->scheme, mssql_get_last_message(), -1);
        }
    }

    public function close() {
        if (!$this->isConnected()) {
            return;
        }

        @mssql_close($this->cnn);
        $this->cnn = null;
    }

    public function isConnected() {
        return $this->cnn !== null;
    }

    public function __destruct() {
        if ($this->isConnected()) {
            $this->close();
        }
    }

    private function sendCommand($sql) {
        if (!$this->isConnected()) {
            throw new ConnectionClosedException();
        }

        $RS = @mssql_query($sql, $this->cnn);

        if ($RS === false) {
            throw new CommandException($sql, @mssql_get_last_message(), -1);
        }

        return $RS;
    }

    public function query($sql) {
        $RS = $this->sendCommand($sql);

        if ($RS === true) {
            throw new GetResultSetException($sql, 'No ResultSet found', -1);
        }


        $RS2 = array();
        while ($ROW = @mssql_fetch_assoc($RS)) {
            $ROW2 = array();

            foreach ($ROW as $KEY => $VALUE) {
                $ROW2[strtoupper($KEY)] = utf8_encode(trim($VALUE));
            }

            array_push($RS2, $ROW2);
        }
        @mssql_free_result($RS);

        return $RS2;
    }

    public function command($sql) {
        $RS = $this->sendCommand($sql);

        if ($RS !== true) {
            throw new CommandException($sql, 'ResultSet found', -1);
        }

        return true;
    }

    private function arrayToEqual($data, $and = "and", $null_case = "is null") {
        $t = "";
        foreach ($data as $key => $value) {
            if ($t != "") {
                $t .= " $and ";
            }

            if (strpos($key, '!') === 0) {
                $key = substr($key, 1);
                $t .= 'not ';
            }

            if ($value === null) {
                $t .= "" . $key . " " . $null_case;
            } else {
                $t .= "" . $key . "=" . self::mssql_escape($value) . "";
            }
        }
        return $t;
    }

    private function arrayToWhere($data) {
        $t = $this->arrayToEqual($data);
        if ($t != "") {
            return " where " . $t;
        } else {
            return "";
        }
    }

    private static function mssql_escape($data) {

        if (is_numeric($data)) {
            return $data;
        } else {
            return "'" . $data . "'";
        }

        $unpacked = unpack('H*hex', $data);
        return '0x' . $unpacked['hex'];
    }

    private static function arrayToSelect($data) {

        if (is_array($data) && count($data) > 0) {
            return '' . implode(',', $data) . '';
        } else {
            return '*';
        }
    }

    private function arrayToInsert($data) {
        $t0 = "";
        $t1 = "";
        foreach ($data as $key => $value) {
            if ($t0 != "") {
                $t0 .= ",";
            }

            if ($t1 != "") {
                $t1 .= ",";
            }

            $t0 .= "" . $key . "";

            if ($value === null) {
                $t1 .= "null";
            } else {
                $t1 .= "" . self::mssql_escape($value) . "";
            }
        }

        return "(" . $t0 . ") VALUES (" . $t1 . ")";
    }

    public function select($table, $col = array(), $where = array()) {
        try {
            return $this->query("SELECT " . self::arrayToSelect($col) . " FROM " . $table . $this->arrayToWhere($where));
        } catch (Exception $ex) {
            throw new SelectException($ex);
        }
    }

    public function delete($table, $where = array()) {
        try {
            return $this->command("DELETE FROM " . $table . $this->arrayToWhere($where));
        } catch (Exception $ex) {
            throw new DeleteException($ex);
        }
    }

    public function insert($table, $data = array()) {
        try {
            return $this->command("INSERT INTO " . $table . " " . $this->arrayToInsert($data));
        } catch (Exception $ex) {
            throw new InsertException($ex);
        }
    }

    public function update($table, $data, $where = array()) {
        try {
            return $this->command("UPDATE " . $table . " SET " . $this->arrayToEqual($data, ",", "= null") . $this->arrayToWhere($where));
        } catch (Exception $ex) {
            throw new UpdateException($ex);
        }
    }

    public function selectRow($table, $col = array(), $where = array()) {
        $RS = $this->select($table, $col, $where);

        if (count($RS) > 1) {
            throw new TooManyRowsException();
        }

        if (count($RS) == 0) {
            return null;
        }

        return $RS[0];
    }

    public static function dateNormalizer($d) {
        if ($d == null) {
            return null;
        } elseif ($d instanceof DateTime) {
            return $d->getTimestamp();
        } else {
            return strtotime($d);
        }
    }

    public static function unixTime2SQL($time) {
        if ($time === null) {
            return null;
        }

        $timezone = new \DateTimeZone('America/Montevideo');
        $date = new \DateTime('now', $timezone);
        $date->setTimestamp($time);
        return $date->format("Y-m-d\TH:i:s");
    }

    public function count($table, $where = array()) {
        
    }

    public function getDatabase() {
        return $this->scheme;
    }

    public function getDatabases() {
        throw new NotImplementedException();
    }

    public function getTables() {
        throw new NotImplementedException();
    }

    public function max($table, $column, $where = array()) {
        throw new NotImplementedException();
    }

    public function min($table, $column, $where = array()) {
        throw new NotImplementedException();
    }

    public function copyTable($sourceTable, $destinationTable) {
        return $this->command('SELECT * INTO ' . $destinationTable . ' FROM ' . $sourceTable . ' WHERE 1=0;');
    }

}
