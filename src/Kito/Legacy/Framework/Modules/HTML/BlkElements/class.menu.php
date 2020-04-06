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
class BLKMenu extends HTMLnav
{
    private $elements=array();
    public function  __construct($elements=false)
    {
        if(is_array($elements))
            $this->elements=$elements;

    }
    public function __toString(){return $this->toHtml();}
    public function toHtml($direct_write=false)
    {
        $e=new HTMLul();
        BLKMenu::doSub($this->elements,$e);
        $this->addChild($e);
        return parent::toHtml($direct_write);
    }
    private static function doSub(&$array,&$parent)
    {
        foreach($array as $element)
        {
            if($element instanceof HTMLa)
            {
                $e=new HTMLli();
                $e->addChild($element);
                $parent->addChild($e);
            }
            else if(is_array($element))
            {
                $e=new HTMLul();
                BLKMenu::doSub($element,$e);
                $parent->addChild($e);
            }

        }
    }
}
?>
