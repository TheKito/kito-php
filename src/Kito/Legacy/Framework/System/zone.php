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
require_once 'class.list.php';
require_once 'class.zone.php';
function getViewZone()
{
    return Zone::getZone(getParam("Zone"), getDBDriver("System"));
}
function getSystemZone()
{
    return getZone(getDBDriver("System"), "System", null, true);
}
function getDesignZone()
{
    return getZone(getDBDriver("System"), "Design", null, true);
}

function getApplicationsZone()
{
    return Zone::getZoneByName("Applications", null, true);
}
function getApplicationZone()
{
    return Zone::getZoneByName(getSessionValue("Application", getValue("Application", "Default")), getApplicationsZone(), true);
}
//function getUserZone(){return getZone(getDBDriver("System"), getSystemZone(),null,true);}


function getRootZones()
{
    $rs=getDBDriver("System")->query("select ZONE_ID from BLK_ZONE where ZONE_PARENT_ID='0'");
    if ($rs===false) {
        return false;
    }

    $list=array();

    if ($rs->first()) {    
        while (true)
        {
            $row=$rs->get();
            array_push($list, Zone::getZone($row["ZONE_ID"], getDBDriver("System")));

            if (!$rs->next()) { break;
            }
        }
    }
    

    return $list;
}
function getZone($driver,$zone_name,$parent_zone=null,$create_system=false)
{
    return Zone::getZoneByName($zone_name, $parent_zone, $create_system, $driver);
}
function getAttr($driver,$attr_name,$unique=true)
{
    static $cache=array();

    if($unique) {
        $cache_id="Y".$attr_name;
    } else {
        $cache_id="N".$attr_name;
    }

    if(isset($cache[$cache_id])) {
        return $cache[$cache_id];
    }

    $row=$driver->autoTable("BLK_ATTR", array("ATTR_NAME" => $attr_name));

    if($row===false) {
        return false;
    }

    $cache[$cache_id]=new attr($row, $driver);
    return $cache[$cache_id];
}
class attr
{
    var $id=0;
    var $value=0;
    var $module=0;
    var $function=0;
    function __construct($row,$driver)
    {
        $this->id=$row["ATTR_ID"];
        $this->value=$row["ATTR_VALUE"];
        $this->module=$row["ATTR_MODULE"];
        $this->function=$row["ATTR_FUNCTION"];
    }
    function getModule()
    {
        return $this->module;
    }
    function getFunction()
    {
        return $this->function;
    }
}


?>
