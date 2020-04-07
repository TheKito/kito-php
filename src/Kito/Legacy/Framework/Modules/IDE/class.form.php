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

class ModuleForm extends HForm
{


    protected function getElements()
    {
        $a=array();
        array_push($a, new FormText("Module Name", "Module", ""));

        $combo=new FormSelect("System Modules", "Module2", "");
        $combo->setList(scandir(dirname(__FILE__)."/../", 1));
        array_push($a, $combo);

        return $a;
    }

    protected function getModule()
    {
        return "IDE";
    }
}
?>
