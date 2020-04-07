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
 * @author TheKito <blankitoracing@gmail.com>
 */

function getSessionsZone()
{
    return getZone(getDBDriver("System"), "Sessions", null, true);
}
function getThisSessionZone()
{
    return getZone(getDBDriver("System"), getSessionId(), getSessionsZone(), false);
}
function getSessionValue($key,$def)
{
    return getThisSessionZone()->get($key, $def);
}
function setSessionValue($key,$val)
{
    return getThisSessionZone()->set($key, $val);
}


function loadSession()
{
    $ThisTime=timeGetTime(false);
    $TimeTime=($ThisTime-getSessionValue("UnixTime", $ThisTime));
    setSessionValue("Seconds", $TimeTime);
    if((float)$TimeTime>(float)  getSessionsZone()->get("MaxSeconds", 20)) { newSession();
    }
    setSessionValue("UnixTime", $ThisTime);

    $Client_IP=getIP();
    if($Client_IP!=getSessionValue("IP", $Client_IP)) { newSession();
    }

    if (getSessionValue("Clear", "N")=="N") {
        clearSessions();
        setSessionValue("Clear", "Y");
    }

}
function getSessionId()
{
    $SessionID=false;
    global $FORM_PARAMS;

    if(isset($FORM_PARAMS["Session"])) { $SessionID=$FORM_PARAMS["Session"];
    }

    $tmp=getCookie("Session");

    if($tmp!==false) { $SessionID=$tmp;
    }

    if($SessionID===false) { newSession();
    }

    if(isset($FORM_PARAMS["Session"])  &&  $tmp!==false && $FORM_PARAMS["Session"]==$tmp) { reloadSession();
    }

    return $SessionID;
}
function newSession()
{
    $Tmp=getSessionsZone()->get("SessionCount", 0);
    $Tmp++;
    getSessionsZone()->set("SessionCount", $Tmp);
    $Tmp=sha1($Tmp.timeGetTime().getIP());
    putCookie("Session", $Tmp);

    reloadSession($Tmp);
}
function reloadSession($ses_id=null)
{
    $URI="";
    foreach ($_GET as $a => $b)
    {
        if($a!="Session"  && !empty($b)) {
            $URI.="$a=$b&";
        }
    }
    if($ses_id!=null) {
        $URI.="Session=".$ses_id;
    }

    if ($URI=="") {
        Header("Location: ./");
    } else {
        Header("Location: ./?".$URI);
    }

    exit();
}

function clearSessions()
{
    $ThisTime=timeGetTime(false);
    foreach (getSessionsZone()->getChild() as $other_ses)
    {
        $TimeTime=($ThisTime-$other_ses->get("UnixTime", $ThisTime));
        if((float)$TimeTime>(float)getSessionsZone()->get("MaxSeconds", 20)) {
                $other_ses->delete(true);
        }
    }
}

loadSession();
?>
