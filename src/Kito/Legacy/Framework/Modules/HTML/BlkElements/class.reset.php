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
class INPUTreset extends HTMLinput
{
    function __construct($title)
    {
        parent::__construct("reset");
        $this->setAttr("value", $title);
        $this->setAttr("alt", $title);
    }
}
?>
