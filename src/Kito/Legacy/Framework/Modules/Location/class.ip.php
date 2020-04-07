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
class Ip
{
    private $ip=false;
    private $object=false;
    private $image_path=false;

    var $flag_name;
    var $country_code;
    var $country_code3;
    var $country_name;
    var $region;
    var $city;
    var $postal_code;
    var $latitude;
    var $longitude;
    var $area_code;
    var $dma_code;
    private function __construct($ip)
    {
        include_once "geoipcity.php";

        $this->ip=$ip;
        $gi = geoip_open(dirname(__FILE__)."/GeoLiteCity.dat", GEOIP_STANDARD);
        $this->object = geoip_record_by_addr($gi, $ip);
        geoip_close($gi);

        $this->image_path=dirname(__FILE__)."/Images/";
        if(!file_exists($this->image_path)) {
            if(!mkdir($this->image_path, 0777, true)) {
                trigger_error("Can not create $this->image_path", E_USER_ERROR);
            }
        }

        $this->flag_name=strtolower($data->country_code."_".$data->country_code3).".gif";
       
        if (!file_exists($this->image_path.$this->flag_name)) {
            file_put_contents($this->image_path.$this->flag_name, file_get_contents(getFlagURL("http://api.hostip.info/flag.php?ip=".$ip)));
        }

        if (!file_exists($this->image_path.$this->flag_name)) {
            $this->flag_name = "unknow.gif";
        }

        $this->area_code=$this->object->area_code;
        $this->city=$this->object->city;
        $this->country_code=$this->object->country_code;
        $this->country_code3=$this->object->country_code3;
        $this->country_name=$this->object->country_name;
        $this->dma_code=$this->object->dma_code;
        $this->latitude=$this->object->latitude;
        $this->longitude=$this->object->longitude;
        $this->postal_code=$this->object->postal_code;
        $this->region=$this->object->region;

        unset($this->object);

    }

}
?>
