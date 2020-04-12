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

/**
 *
 * @author TheKito < blankitoracing@gmail.com >
 */
abstract class SQL implements SQLInterface {

    public final function getArray($table, $column, $where = array()): array {
        $r = array();

        foreach ($this->select($table, array($column), $where) as $ROW) {
            array_push($r, $ROW[$column]);
        }

        return $r;
    }

    public final function getHashMap($table, $columnKey, $columnValue, $where = array()): array {
        $r = array();

        foreach ($this->select($table, array($columnKey, $columnValue), $where) as $ROW) {
            $r[$ROW[$columnKey]] = $ROW[$columnValue];
        }

        return $r;
    }

    public final function getRow($table, $column = array(), $where = array()): array {
        $RS = $this->select($table, $column, $where, 2);

        if (count($RS) > 1) {
            throw new TooManyRowsException();
        }

        if (count($RS) == 0) {
            return null;
        }

        return $RS[0];
    }

    public final function getText($table, $column, $where = array()): ?string {
        $ROW = $this->getRow($table, array($column), $where);

        if ($ROW == null) {
            return null;
        }

        return $ROW[$column];
    }

    public final function autoTable($table, $data, $column = array(), $create = true): array {
        $rs = $this->select($table, $column, $data, 1);

        if (count($rs) > 0) {
            return $rs[0];
        } else if ($create) {
            if ($this->insert($table, $data)) {
                $rs = $this->select($table, $column, $data, 1);

                if (count($rs) > 0) {
                    return $rs[0];
                } else {
                    throw new InsertException(print_r(array($table, $data), true));
                }
            } else {
                throw new InsertException(print_r(array($table, $data), true));
            }
        } else {
            return null;
        }
    }

    public final function autoUpdate($table, $data, $index): int {
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

    public final function autoInsert($table, $data): bool {
        $rs = $this->select($table, array(), $data, 1);

        if (count($rs) > 0) {
            return true;
        }

        if ($this->insert($table, $data)) {
            return true;
        }

        return false;
    }

    public function getTablesWithPrefix($prefix): array {
        $prefixLen = strlen($prefix);

        $_ = array();

        foreach ($this->getTables() as $table) {
            if (substr($table, 0, $prefixLen) == $prefix) {
                $_[] = $table;
            }
        }

        return $_;
    }

}
