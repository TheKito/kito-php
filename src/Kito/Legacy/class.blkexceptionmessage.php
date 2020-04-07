<?php
/*
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 */

/**
 *
 * @author The Blankis < blankitoracing@gmail.com >
 */
class BLKExceptionMessage extends Exception
{

 

    public function __construct($message, $code, $previous = null)
    {
        if(!$previous instanceof Exception) {
            parent::__construct($message, $code);
        } else {
            parent::__construct($message." > ".$previous->getMessage(), $code);
        }    
    }    
    

    
    public static function throwExceptionMessage($message,$data = null)
    {               
        if($data===null) {
            throw new self($message, crc32(strtolower($message)), null);
        } else {
            throw new self($message.': '.$data, crc32(strtolower($message)), null);
        }
    }
    

}
