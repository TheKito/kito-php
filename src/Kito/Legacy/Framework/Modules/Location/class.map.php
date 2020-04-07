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
 * @author TheKito <blankitoracing@gmail.com>
 */
class Map
{
    public static function getMap($x,$y,$z)
    {
        getModule("HTML");
        return new HTMLiframe("http://maps.google.es/?ie=UTF8&amp;ll='.$x.','.$y.'&amp;spn=9.368034,19.753418&amp;z='.$z.'&amp;output=embed");
    }

    public static function getMapWithMarker($x,$y)
    {
        getModule("HTML");
        return new HTMLiframe("http://maps.google.es/maps?f=d&amp;source=s_d&amp;saddr='.$x.','.$y.'&amp;daddr=&amp;hl=es&amp;geocode=&amp;mra=dme&amp;mrcr=0&amp;mrsp=0&amp;sz=6&amp;sll='.$x.','.$y.'&amp;sspn='.$x.','.$y.'&amp;ie=UTF8&amp;ll='.$x.','.$y.'&amp;spn='.$x.','.$y.'&amp;output=embed");
    }
}
?>
