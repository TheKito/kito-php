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
class SPANContainer extends HTMLspan
{
    function  __construct($name)
    {
        parent::__construct();
        $this->setAttr("name", "C_".$name);
        SPANContainer::Containers("C_".$name);
    }
    public static function Containers($new=false)
    {
        static $a=array();

        if($new===false)
            return $a;
        else
            array_push($a, $new);
    }
}
?>
