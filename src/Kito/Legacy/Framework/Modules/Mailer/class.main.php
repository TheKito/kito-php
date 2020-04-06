<?php
/*
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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
 * @author Blankis <blankitoracing@gmail.com>
 */
class Mailer extends Module
{
    private $z_queues=null;

    private $z_accounts=null;

    public function __load()
    {
        $this->z_accounts=Zone::getZoneByName("Accounts", $this->zone, true);
        $this->z_queues=Zone::getZoneByName("Queues", $this->zone, true);

        $a=new Accounts("Test");
        $a->setDomain("192.168.10.1");
        $a->setFrom("andresrg@adinet.com.uy");
        $a->setPort(25);
        $a->setSMTPProtocol();
        $a->setSSL(false);
        $a->setUser("");
        $a->setPassword("");

        if(getParam("Module")=="Mailer")
            $a->sendMail ("El Tito", "regandy@gmail.com", "miauuuu", "<h1>mau mau</h1>");
        
    }
    public function __construct() 
    {
        include_once 'class.phpmailer.php';
        include_once 'class.account.php';
    }
    public function __destruct() {
    }
    public function __unload() {
    }


    public function authUser($name,$domain,$password)
    {
        $t =  new POP3();
        $t2= new SMTP();

        if($t->Connect("ssl://".$domain,995) && $t->Login($name, $password))
            return true;
        
        if($t2->Connect("ssl://".$domain,465) && $t2->Authenticate($name, $password))
            return true;

        if($t->Connect($domain,110) && $t->Login($name, $password))
            return true;
        
        if($t2->Connect($domain,25) && $t2->Authenticate($name, $password))
            return true;

        $t->Disconnect();
        $t2->Close();
        return false;
    }
}
?>