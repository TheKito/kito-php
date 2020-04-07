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
 * @author Blankis <blankitoracing@gmail.com>
 */
class Accounts
{
    private $zone=null;
    function __construct($name=null)
    {
        if($name==null) {
            $name=uniqid();
        }

        $this->zone=getModuleZone("Mailer");
        $this->zone=Zone::getZoneByName("Accounts", $this->zone);
        $this->zone=Zone::getZoneByName($name, $this->zone);
    }

    function setDomain($dns)
    {
        return $this->zone->set("Domain", $dns);
    }
    function getDomain()
    {
        return $this->zone->get("Domain", "example.com");
    }

    function setSMTPProtocol()
    {
        return $this->zone->set("Protocol", "SMTP");
    }
    //    function setIMAPProtocol(){return $this->zone->set("Protocol", "IMAP");}
    //    function setPOPProtocol(){return $this->zone->set("Protocol", "POP");}
    function getProtocol()
    {
        return $this->zone->get("Protocol", "SMTP");
    }

    function setFrom($from)
    {
        return $this->zone->set("From", $from);
    }
    function getFrom()
    {
        return $this->zone->get("From", "root@".getDomain());
    }

    function setPort($port)
    {
        return $this->zone->set("Port", $port);
    }
    function getPort()
    {
        return $this->zone->get("Port", "25");
    }

    function setSSL($SSL)
    {
        return $this->zone->set("SSL", ($SSL?"Y":"N"));
    }
    function getSSL()
    {
        return $this->zone->get("SSL", "Y")=="Y";
    }

    function setUser($user)
    {
        return $this->zone->set("User", $user);
    }
    function getUser()
    {
        return $this->zone->get("User", "");
    }

    function setPassword($password)
    {
        return $this->zone->set("Password", $password);
    }
    function getPassword()
    {
        return $this->zone->get("Password", "");
    }

    function sendMail($from_name,$to,$subject,$text,$in_html=true)
    {
        $mail = new PHPMailer();

        $mail -> From = $this->getFrom();
        $mail -> FromName = $from_name;
        $mail -> AddAddress($to);
        $mail -> Subject = $subject;
        $mail -> Body = $text;
        $mail -> IsHTML($in_html);

        $mail->IsSMTP();
        if($this->getSSL()) {
            $mail->Host = "ssl://".$this->getDomain();
        } else {
            $mail->Host = $this->getDomain();
        }

        $mail->Port = $this->getPort();

        if($this->getUser()=="") {
            $mail->SMTPAuth = false;
        } else
        {
            $mail->SMTPAuth = true;
            $mail->Username = $this->getUser();
            $mail->Password = $this->getPassword();
        }

        if($mail->Send()) {
            return true;
        } else
        {
            ErrorHandler("-1", $mail->ErrorInfo, "%MailService%", "-1");
            return false;
        }
        

    }
}
?>
