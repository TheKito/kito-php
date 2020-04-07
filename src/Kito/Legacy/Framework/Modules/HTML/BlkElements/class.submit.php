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
class INPUTsubmit extends HTMLinput
{
    function __construct($title)
    {
        parent::__construct("submit");
        $this->setAttr("value", $title);
        $this->setAttr("alt", $title);
    }
}
?>
