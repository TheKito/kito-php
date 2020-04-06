<?php
/*
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 */

/**
 *
 *
 * @author Blankis <blankitoracing@gmail.com>
 */
abstract class Driver
{
    var $zone=false;
    function getTablesZone(){return getZone(getDBDriver("System"), "Tables",  $this->zone,true);}
    function getColZone($table,$col){return getZone(getDBDriver("System"), $col, getTableZone($table),true);}
    function getTableZone($table)
    {
        if(!$this->existTable($table))
            return false;

        return getZone(getDBDriver("System"), $table, $this->getTablesZone(),true);
    }



    function autoTable($table,$cols,$create=true)
    {
        $query="";

        $insert="";
        $insert2="";
        foreach ($cols as $name => $value)
        {
            if ($insert!="")
                $insert.=",";
            $insert.=$name;

            if ($insert2!="")
                $insert2.=",";
            $insert2.="'".$value."'";

            if ($query!="")
                $query.=" and ";
            else
                $query.=" ";

            $query.=$name."='".$value."'";
        }
        $query="select * from $table where".$query.";";
        $insert="insert into $table (".$insert.") values (".$insert2.");";

        $rs=$this->query($query);
        if ($rs===false)
            return false;

        if ($rs->first())
            return $rs->get();


        if($create)
        {
            if ($this->command($insert))
                return $this->autoTable($table, $cols);
            else
                return false;
        }
        else
            return false;
    }
    //Data

    /**
    * execute query without any resultset
    * @return boolean
    */
    abstract function command($query);

    /**
    * execute quer
    * @return IResultSet
    */
    abstract function query($query);


    //Structure

    /**
    * List database tables
    * @return Array<String> tables name
    */
    abstract function getTables();

    /**
    * List table cols
    * @return Array<String,Array<String,String>> col name, {Attribute,Value}
    */
    abstract function getTableCols($table);

    /**
    * Create/Update/Remove table
    * @param tablename, array<String,array<Attribute,Value>> Cols
    * @return boolean
    */
    abstract function alterTable($table,$cols);

    /**
    * check if exist table
    * @param tablename
    * @return boolean
    */
    abstract function existTable($table);

    abstract function getStats();

    abstract function getPrimaryKey($table);

}
?>
