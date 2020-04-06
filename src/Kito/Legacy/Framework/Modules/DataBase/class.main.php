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
class DataBase extends Module {

    public static function getTable($rs)
    {
        

        if(!$rs->first())
            return false;

        $elements=array();
        foreach ($rs->get() as $col => $val)
            array_push ($elements, $col);

        $cols=count($elements);

        while($rs->next())
        {
            $row=$rs->get();
            foreach ($row as $value)
                array_push ($elements, $value);
        }

        return HTMLtable::autoTable($elements, $cols);
    }

    //put your code here
    public function __construct() {

    }
    public function __destruct() {

    }
    public function __load() {
        //TEST
        if(getParam("Module")=="DataBase")
        {
            include_once 'class.form.php';
            $frm=new DataForm(getSystemZone()->driver, "BLK_ATTR", 1);
            write($frm->getHtml());
            write(DataBase::getTable(getSystemZone()->driver->Query("select * from BLK_ATTR")));
        }
    }
    public function Form_Check($name,$value)
    {
        return $value!="que?";
    }
        public function Form_Save($params)
    {
        return true;
    }


    private function getIDEMenuSourcesTable()
    {

    }
    private function getIDEMenuSources()
    {
        $a=array();

        foreach (getDataSourcesZone()->getChild() as $zone)
        {
            $aa=array();

            $a[$zone->id]=$zone->name;
            $driver=getDBDriver($zone->name);
            foreach ($driver->getTables() as $table)
            {
                $aaa=array();
                array_push ($aa, $table);

                foreach ($driver->getTableCols($table) as $col => $data)
                    array_push($aaa, $col);

                array_push($aa, $aaa);
            }

            array_push($a, $aa);
        }

        return $a;
    }
    public function getIDEMenu()
    {
        //return getModule("Zones")->getIDEMenu(getDataZone());
        $a=array();

        $zone=getDataSourcesZone();
        $a[$zone->id]=$zone->name;
        array_push($a, $this->getIDEMenuSources());
        
        $zone= getDataLinksZone();
        $a[$zone->id]=$zone->name;
        //array_push($a, $this->getIDEMenuLinks());

        return $a;
    }
    public function __unload() {
    }
}
?>
