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

class MySQLRS implements IResultSet
{
    var $rs;
    var $pos;
    function __construct($rs)
    {
        $this->rs=$rs;
        $this->first();
    }

    function next()
    {
        if($this->pos<$this->count()) {
            return $this->move($this->pos+1);
        }
        else {
            return false;
        }
    }

    function last()
    {
        return $this->move($this->count()-1);
    }

    function prev()
    {
        if($this->pos>0) {
            return $this->move($this->pos-1);
        }
        else {
            return false;
        }
    }

    function first()
    {
        return $this->move(0);
    }

    function get()
    {
        return mysql_fetch_assoc($this->rs);
    }

    function count()
    {
        $r=@mysql_num_rows($this->rs);
        if($r===false) {
            $r=-1;
        }

        return $r;
    }

    function flush()
    {
        return mysql_free_result($this->rs);
    }

    function move($Pos)
    {
        if ($Pos>=0 && $Pos<$this->count()) {
            if(@mysql_data_seek($this->rs, $Pos)) {
                $this->pos=$Pos;
                return true;
            }
            else {
                return false;
            } 
        } else {
            return false;
        }

    }

    function __destruct()
    {
        $this->flush();
    }
}
?>
