<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class
 *
 * @author andresrg
 */
class INPUTtext extends HTMLinput
{
    function __construct($title,$name,$value)
    {
        parent::__construct("text");
        $this->setAttr("name", $name);
        $this->setAttr("value", $value);
        $this->setAttr("alt", $title);
    }
}
?>
