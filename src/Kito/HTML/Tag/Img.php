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
class Img extends HTMLElement {

    function __construct($src, $alt = false) {
        $this->tag = "img";
        $this->closeMode = 2;
        $this->setAttr("src", $src);
        if ($alt !== false) {
            $this->setAttr("alt", $alt);
        }
    }

}
