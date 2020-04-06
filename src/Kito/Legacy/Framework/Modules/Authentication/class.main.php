<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classmain
 *
 * @author andresrg
 */
class Authentication extends Module {

        public function __destruct() {}
        public function __load() 
        {
         





            if(getParam("Tag")=="Secure")
            {


if(!isset($_SERVER['PHP_AUTH_USER']))
    doAuthBasic("Hola!","MySql");

            }

        }
        public function __unload() {}
        public function __construct() {}



    }
?>
