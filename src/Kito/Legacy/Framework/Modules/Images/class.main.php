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
class Images extends Module
{

    
    public function __construct() 
    {
        $image=getParam("Image");
        $source=getParam("Source"); //Application,Module,System

        if(getParam("Module")=="Images") {
            $this->sendImage($source, $image);
        }
    }
    public function __destruct()
    {

    }
    public function __load()
    {

    }
    public function __unload()
    {

    }

    private static function sendImage($source,$image)
    {

        //ATAQUES DE ../

        if($source==false) { $source="System";
        }
        if($image==false) { $image="default.png";
        }

        if($source=="System") {
            $path = dirname(__FILE__)."../../System/Images/".$image;
        } elseif($source=="Application") {
        }
        else {
            $path = getModule($module)->path."Images/".$image;
        }



        if (file_exists($path) && is_file($path)) {

            $ext = substr($image, -3);
            // set the MIME type
            switch ($ext)
            {
            case 'jpg':
                $mime = 'image/jpeg';
                break;
            case 'gif':
                $mime = 'image/gif';
                break;
            case 'png':
                $mime = 'image/png';
                break;
            default:
                $mime = false;
            }


            if ($mime) {
                header('Content-type: '.$mime);
                header('Content-length: '.filesize($path));
                $file = @ fopen($path, 'rb');
                if ($file) {
                    fpassthru($file);
                    exit;
                }
            }
            else {
                return $this->sendImage("System", "default.png");
            }
        }

    }

}
?>
