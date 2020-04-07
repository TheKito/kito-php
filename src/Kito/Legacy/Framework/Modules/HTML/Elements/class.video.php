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

class HTMLvide extends HTMLElement
{

    function __construct($src,$controls=true)
    {
        $this->tag="video";
        $this->closeMode=3;

        $this->addChild("Your browser does not support HTML5 video element.");
        $this->setAttr("src", $src);

        if($controls) {
            $this->setAttr("controls", "controls");
        }

    }

   
}
?>
