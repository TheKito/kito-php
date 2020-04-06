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
 * mysql
 *
 * @author Blankis <blankitoracing@gmail.com>
 */
class MySqlDriver extends Driver
{
    var $server="127.0.0.1";
    var $database="test";
    var $user="test";
    var $password="";
    var $cnn=false;
    var $calls=0;

    function getStats(){return "Total Commands and Querys:".$this->calls;}

    function __construct($params)
    {
        if(isset ($params["Server"]))
            $this->server=$params["Server"];

        if(isset ($params["Database"]))
            $this->database=$params["Database"];

        if(isset ($params["User"]))
            $this->user=$params["User"];

        if(isset ($params["Password"]))
            $this->password=$params["Password"];

        
        $this->connect();
    }

    function isConnected()
    {
        if($this->cnn===false)
            return false;
        else
            return mysql_ping ($this->cnn);
    }

    function connect()
    {
        if($this->isConnected())
            $this->close();

        $this->cnn=mysql_connect($this->server, $this->user, $this->password);

        if (!$this->cnn)
        {
            trigger_error("Server Error ".$this->server, E_USER_WARNING);
            $this->close();
            return false;
        }

        if(!mysql_select_db($this->database, $this->cnn))
        {
            trigger_error("DataBase Error ".$this->database." on ".$this->server, E_USER_WARNING);
            $this->close();
            return false;
        }
        return true;
    }


    function close()
    {
        if (!$this->isConnected())
            return true;

        return !(mysql_close($this->cnn)===false);
    }

    function query ($sql)
    {
        callFunction ("Logger", "Log", array("DEBUG","MySql Query:".$sql));
        include_once 'class.resultset.php';
        $this->calls++;


        $Result=mysql_query($sql,$this->cnn);

        if ($Result===false)
        {
            trigger_error("MySQLQueryError;".mysql_error(), E_USER_WARNING);
            return false;
        }
        callFunction ("Logger", "Log", array("DEBUG","MySql Query OK->".$sql));
        return new MySQLRS($Result);
    }

    




    function gettext($Table_,$Row_,$Cond)
    {
        $tmp=$this->query("select ".$Row_." from ".$Table_." where ".$Cond." limit 1;");
      	if ($this->getRows($tmp)> 0)
                while ($rowEmp = mysql_fetch_assoc($tmp))
                        return $rowEmp[$Row_];

        return "";
    }

    function command ($SQL)
    {
        callFunction ("Logger", "Log", array("DEBUG","MySql Command:".$SQL));
        $this->calls++;
            $Result=mysql_unbuffered_query($SQL,$this->cnn);

        if ($Result===false)
        {
            trigger_error("command Error;".mysql_error(), E_USER_WARNING);
            return false;
        }
        else
        {
            callFunction ("Logger", "Log", array("DEBUG","MySql Command OK->".$SQL));
            return true;
        }
    }
    //Structure
    function getTables()
    {
        //debug_print_backtrace();
        $r=array();

        $tmp=$this->query("SHOW TABLES FROM ".$this->database);
      	
        while ($tmp->next())
        {
            $row=$tmp->get();
            array_push($r,$row["Tables_in_imo"]);
        }

        return $r;
    }
    function  __destruct() {
        $this->close();
    }
//    function getTableKeys($table)
//    {
//        $r=array();
//
//        $tmp=$this->query("SHOW COLUMNS FROM ".$table);
//      	if ($this->getRows($tmp)> 0)
//                while ($rowEmp = mysql_fetch_row($tmp))
//                    if(strtoupper($rowEmp[3])=="PRI")
//                        array_push($r, $rowEmp[0]);
//
//
//        return $r;
//    }
    function getTableCols($table)
    {

        $r=array();

        $tmp=$this->query("SHOW COLUMNS FROM ".$table);
      	if ($tmp!==false && $tmp->first())
                while (true)
                {
                    $row=$tmp->get();
                    $r[$row["Field"]]=$row;
                    
                    if (!$tmp->next()) break;
                }

                
        return $r;
    }

    function existTable($table)
    {
        return in_array(strtoupper($table), $this->getTables());
    }
    function createTable($table,$cols)
    {
        $sql="CREATE TABLE ".$table."("; 
        foreach (array_expression as $key => $value)
        {
            $sql.=$key." ".$value["Type"]." ".($value["Null"]=="NO"?"not null":"")." ".$value["Extra"].",";
        }
        $sql.=");";
    }
    function editTable($table,$cols)
    {
        
    }
    function alterTable($table,$cols)
    {
        $e=existTable($table);
        $table=strtoupper($table);

        if($cols==null || !is_array($cols) || array_count_values($cols)==0)
            if($e)
                return $this->command ("DROP TABLE IF EXISTS ".$table.";");
            else
                return true;


        if ($this->existTable($table))
            return $this->command(editTable($table,$cols));
        else
            return $this->command(createTable($table,$cols));
    }

    

    public function getPrimaryKey($table)
    {
        foreach ($this->getTableCols($table) as $col => $data)       
            foreach ($data as $key => $value)
                if ($key=="Key" && $value=="PRI")
                    return $col;
        return false;
    }
}
?>