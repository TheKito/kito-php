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
class INPUThidden extends HTMLinput
{
    function __construct($name,$value)
    {
        parent::__construct("hidden");
        $this->setAttr("name", $name);
        $this->setAttr("value", $value);
    }
}
?>
