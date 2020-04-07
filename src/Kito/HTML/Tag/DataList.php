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

namespace Kito\HTML\Tag;

/**
 *
 *
 * @author TheKito <blankitoracing@gmail.com>
 */
class DataList extends Element
{

    function __construct($name)
    {
        $this->closeMode = 3;
        $this->setAttr("name", $name);
    }

    public static function autoDataList($elements, $use_index = false)
    {
        $sl = new HTMLdatalist();
        foreach ($elements as $key => $value) {
            if ($use_index === false) {
                $op = new HTMLoption(false);
                $op->setAttr("value", $value);
            } else {
                $op = new HTMLoption(false);
                $op->setAttr("value", $key);
            }

            $op->addChild($value);
            $sl->addChild($op);
        }
        return $sl;
    }

}
