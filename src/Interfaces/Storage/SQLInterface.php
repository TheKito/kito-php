<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Kito\Interfaces\Storage;

/**
 *
 * @author Instalacion
 */
interface SQLInterface {
    public function isConnected(): bool;

    public function query($query): array;

    public function command($command): bool;

    public function delete($table, $where = array(), $limit = 100): bool;

    public function insert($table, $data = array()): bool;

    public function update($table, $data, $where = array(), $limit = 0): bool;

    public function select($table, $column = array(), $where = array(), $limit = 100, $rand = false): array;

    public function count($table, $where = array()): int;

    public function max($table, $column, $where = array()): int;

    public function min($table, $column, $where = array()): int;

    public function getTables(): array;

    public function getDatabases(): array;

    public function getDatabase(): string;

    public function copyTable($sourceTable, $destinationTable): bool;
}
