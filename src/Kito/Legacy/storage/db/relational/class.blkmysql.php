<?php

/*
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

/**
 *
 * @author The TheKito < blankitoracing@gmail.com >
 */
class BLKMySql
{

    public static function getMySqlConnection($server = "127.0.0.1", $database = "test", $user = "test", $password = null)
    {
        static $CNNs = null;

        if ($CNNs === null) {
            $CNNs = array();
        }

        $KEY = implode(',', array($server, $database, $user, $password));

        if (!isset($CNNs[$KEY])) {
            $CNNs[$KEY] = new self($server, $database, $user, $password);
        }

        return $CNNs[$KEY];
    }

    public static function getSqlConnectionServerAccount($server, $database)
    {
        return self::getMySqlConnection($server, $database, strtoupper(gethostname()), null);
    }

    public static function getSqlConnectionLocalHost($database, $user, $password = null)
    {
        return self::getMySqlConnection('127.0.0.1', $database, $user, $password);
    }

    private $server = "127.0.0.1";
    private $database = "test";
    private $user = "test";
    private $password = null;
    private $cnn = null;
    var $__DEBUG = false;

    public function getId()
    {
        return md5($this->server . $this->user . $this->password . $this->database);
    }

    private function __construct($server = "127.0.0.1", $database = "test", $user = "test", $password = null)
    {
        $this->server = $server;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;

        $this->connect();
    }

    public function isConnected()
    {
        if ($this->cnn === null) {
            return false;
        }

        return @$this->cnn->ping();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function connect()
    {
        if (!$this->isConnected()) {
            $this->cnn = new mysqli($this->server, $this->user, $this->password, $this->database);

            if ($this->cnn->connect_errno > 0) {
                throw new SqlException($this->cnn->connect_error, $this->cnn->connect_errno);
            }

            $this->cnn->set_charset("utf8");
        }

        return true;
    }

    public function disconnect()
    {
        if ($this->isConnected()) {
            return @$this->cnn->close();
        }

        return true;
    }

    private function doCall($sql)
    {
        $this->connect();

        //echo "$sql\n";

        $rs = $this->cnn->query($sql);

        if ($rs === false) {
            throw new SqlException($this->cnn->error, $this->cnn->errno);
        }

        if ($rs === true) {
            return true;
        } else {
            $data = array();

            while ($row = $rs->fetch_assoc()) {
                array_push($data, $row);
            }

            $rs->free();

            return $data;
        }
    }

    public function query($query)
    {
        try {

            $t = microtime(true);

            $rs = $this->doCall($query);

            $t = round(microtime(true) - $t, 3);

            if ($this->__DEBUG && $t > 1) {
                echo "QUERY ($t): " . $query . PHP_EOL;
            }

            return $rs;
        } catch (SqlException $e) {
            SqlException::throwCommandException($query, $e->getMessage(), $e->getCode());
        }
    }

    public function command($command)
    {
        try {

            $t = microtime(true);

            $this->doCall($command);

            $t = round(microtime(true) - $t, 3);

            if ($this->__DEBUG) {
                echo "COMMAND ($t): " . $command . PHP_EOL;
            }

            return true;
        } catch (SqlException $e) {
            SqlException::throwCommandException($command, $e->getMessage(), $e->getCode());
        }
    }

    public function delete($table, $where = array(), $limit = 100)
    {
        try {
            return $this->command("DELETE FROM " . $table . $this->arrayToWhere($where) . self::getLimit($limit));
        } catch (SqlException $ex) {
            SqlException::throwDeleteException($ex);
        }
    }

    public function insert($table, $data = array())
    {
        try {
            return $this->command("INSERT INTO " . $table . " " . $this->arrayToInsert($data));
        } catch (SqlException $ex) {
            SqlException::throwInsertException($ex);
        }
    }

    public function update($table, $data, $where = array(), $limit = 0)
    {
        try {
            return $this->command("UPDATE " . $table . " SET " . $this->arrayToEqual($data, ",", "= null") . $this->arrayToWhere($where) . self::getLimit($limit));
        } catch (SqlException $ex) {
            SqlException::throwUpdateException($ex);
        }
    }

    public function select($table, $col = array(), $where = array(), $limit = 100, $rand = false)
    {
        try {
            if ($rand) {
                return $this->query("SELECT " . self::arrayToSelect($col) . " FROM " . $table . $this->arrayToWhere($where) . ' ORDER BY RAND() ' . self::getLimit($limit));
            } else {
                return $this->query("SELECT " . self::arrayToSelect($col) . " FROM " . $table . $this->arrayToWhere($where) . self::getLimit($limit));
            }
        } catch (SqlException $ex) {
            SqlException::throwSelectException($ex);
        }
    }

    public function count($table, $where = array())
    {
        try {
            $rs = $this->query("SELECT COUNT(*) as TOTAL FROM " . $table . $this->arrayToWhere($where));
            $rs = $rs[0];
            return $rs["TOTAL"];
        } catch (SqlException $ex) {
            SqlException::throwCountException($ex);
        }
    }

    protected static function getLimit($limit)
    {
        if (is_numeric($limit) && $limit > 0) {
            return " LIMIT " . $limit . ";";
        } else {
            return ";";
        }
    }

    public function getTables()
    {
        $tables = array();

        foreach ($this->query("SHOW TABLES;") as $ROW) {
            foreach ($ROW as $COL) {
                array_push($tables, $COL);
                break;
            }
        }

        return $tables;
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function getRows($table, $count)
    {
        static $pos = null;

        if ($pos === null) {
            $pos = array();
        }

        $hash = $table;

        if (isset($pos[$hash])) {
            $start = $pos[$hash];
        } else {
            $start = 0;
        }

        $pos[$hash] = $start + $count;


        $rs = $this->query("SELECT * FROM $table LIMIT $start,$count");

        if (count($rs) == 0) {
            $pos[$hash] = 0;

            if ($start > 0) {
                return $this->getRows($table, $count);
            }
        }

        return $rs;
    }

    protected function arrayToWhere($data)
    {
        $t = $this->arrayToEqual($data);
        if ($t != "") {
            return " where " . $t;
        } else {
            return "";
        }
    }

    protected function arrayToEqual($data, $and = "and", $null_case = "is null")
    {
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
                $t .= "`" . $key . "` " . $null_case;
            } else {
                $t .= "`" . $key . "`='" . mysqli_real_escape_string($this->cnn, $value) . "'";
            }
        }
        return $t;
    }

    protected static function arrayToSelect($data)
    {
        $t = "";
        foreach ($data as $value) {
            if ($t != "") {
                $t .= ",";
            }

            $t .= "`" . $value . "`";
        }
        if ($t != "") {
            return $t;
        } else {
            return "*";
        }
    }

    protected function arrayToInsert($data)
    {
        $t0 = "";
        $t1 = "";
        foreach ($data as $key => $value) {
            if ($t0 != "") {
                $t0 .= ",";
            }

            if ($t1 != "") {
                $t1 .= ",";
            }

            $t0 .= "`" . $key . "`";

            if ($value === null) {
                $t1 .= "null";
            } else {
                $t1 .= "'" . mysqli_real_escape_string($this->cnn, $value) . "'";
            }
        }

        return "(" . $t0 . ") VALUES (" . $t1 . ")";
    }

    public function selectRow($table, $col = array(), $where = array())
    {
        $RS = $this->select($table, $col, $where, 2);

        if (count($RS) > 1) {
            SqlException::throwTooManyRows();
        }

        if (count($RS) == 0) {
            return null;
        }

        return $RS[0];
    }

    public function getText($table, $col, $where = array())
    {
        $ROW = $this->selectRow($table, array($col), $where);

        if ($ROW == null) {
            return null;
        }

        return $ROW[$col];
    }

    public function getArray($table, $colKey, $colValue, $where = array())
    {
        $r = array();

        foreach ($this->select($table, array($colKey, $colValue), $where) as $ROW) {
            $r[$ROW[$colKey]] = $ROW[$colValue];
        }

        return $r;
    }

    public function getList($table, $col, $where = array())
    {
        $r = array();

        foreach ($this->select($table, array($col), $where) as $ROW) {
            array_push($r, $ROW[$col]);
        }

        return $r;
    }

    function autoTable($table, $data, $col = array(), $create = true)
    {
        $rs = $this->select($table, $col, $data, 1);

        if (count($rs) > 0) {
            return $rs[0];
        } else if ($create) {
            //$data["ID"] = getUID($table);
            if ($this->insert($table, $data)) {
                $rs = $this->select($table, $col, $data, 1);

                if (count($rs) > 0) {
                    return $rs[0];
                } else {
                    SqlException::throwInsertException($table, $data);
                }
            } else {
                SqlException::throwInsertException($table, $data);
            }
        } else {
            return null;
        }
    }

    function insertUnique($table, $data)
    {
        return $this->autoInsert($table, $data);
    }

    function autoInsert($table, $data)
    {
        $rs = $this->select($table, array(), $data, 1);

        if (count($rs) > 0) {
            return true;
        }

        if ($this->insert($table, $data)) {
            return true;
        }

        return false;
    }

    function upgradeTable($table, $data, $index)
    {
        return $this->autoUpdate($table, $data, $index);
    }

    function autoUpdate($table, $data, $index)
    {
        $UPDATES = 0;

        $ROW = $this->autoTable($table, $index);

        foreach ($ROW as $KEY => $VALUE) {
            unset($ROW[$KEY]);
            $ROW[strtolower($KEY)] = $VALUE;
        }

        foreach ($data as $KEY => $VALUE) {
            unset($data[$KEY]);
            $data[strtolower($KEY)] = $VALUE;
        }

        foreach ($ROW as $KEY => $VALUE) {
            if (array_key_exists($KEY, $data) && $VALUE != $data[$KEY]) {
                $this->update($table, array($KEY => $data[$KEY]), $index, 1);
                $UPDATES++;
            }
        }

        return $UPDATES;
    }

    function existsRow($table, $where = array())
    {
        return $this->count($table, $where) > 0;
    }

}

class SqlException extends Exception
{

    public function __construct($message, $code, $previous = null)
    {
        if (!$previous instanceof Exception) {
            parent::__construct($message, $code);
        } else {
            parent::__construct($message . " > " . $previous->getMessage(), $code);
        }
    }

    private static function getException($message, $error)
    {
        return new SqlException($message, $error, null);
    }

    public static function throwSelectDBException($db, $message, $error)
    {
        throw new SqlException("Select DB $db Exception", 20001, self::getException($message, $error));
    }

    private static function getQueryException($query, $message, $error)
    {
        return new SqlException($query, 20002, self::getException($message, $error));
    }

    public static function throwGetResultSetException($query, $message, $error)
    {
        throw new SqlException("Get ResultSet Exception", 20003, self::getQueryException($query, $message, $error));
    }

    public static function throwCommandException($command, $message, $error)
    {
        throw new SqlException("Command Exception", 20004, self::getQueryException($command, $message, $error));
    }

    public static function throwDeleteException($commandException)
    {
        throw new SqlException("Delete Exception", 20005, $commandException);
    }

    public static function throwInsertException($commandException)
    {
        throw new SqlException("Insert Exception", 20006, $commandException);
    }

    public static function throwUpdateException($commandException)
    {
        throw new SqlException("Update Exception", 20007, $commandException);
    }

    public static function throwSelectException($queryException)
    {
        throw new SqlException("Select Exception", 20008, $queryException);
    }

    public static function throwCountException($queryException)
    {
        throw new SqlException("Count Exception", 20009, $queryException);
    }

    public static function throwTooManyRows()
    {
        throw new SqlException("Too Many Rows Exception", 20011, null);
    }

    public static function throwConnectException($server, $user, $message, $error)
    {
        throw new SqlException("Connect Exception $user@$server", 20010, self::getException($message, $error));
    }

}
