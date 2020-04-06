<?php
/*
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 */

namespace Kito;

/**
 *
 * @author TheKito < blankitoracing@gmail.com >
 */

class Path
{    
    public static function getRoot($directorySeparator = DIRECTORY_SEPARATOR)
    {
        return new Path(array(), $directorySeparator);
    }
    private static function parsePath($stringPath, $directorySeparator = DIRECTORY_SEPARATOR)
    {
        $tmp = array();
        foreach(explode($directorySeparator, str_replace("/", $directorySeparator , str_replace("\\", $directorySeparator , $stringPath))) as $name)
        {
            if(empty($name))
                continue;

            if($name=='.')
                continue;

            if($name=='..' && count($tmp)>0)
            {
                array_pop ($tmp);
                continue;
            }
            
            $tmp[] = $name;
        }        
        return $tmp;        
    }
    
    public static function getFromString($stringPath, $directorySeparator = DIRECTORY_SEPARATOR)
    {
        return new Path(self::parsePath($stringPath, $directorySeparator), $directorySeparator);
    }
    
    private $directorySeparator;
    protected $pathElements;
    public function __construct(array $pathElements = array(), $directorySeparator = DIRECTORY_SEPARATOR)
    {
        $this->directorySeparator = $directorySeparator;
        $this->pathElements = $pathElements;
    }    
    public function isRoot()                    {return $this->getDeep()==0;}    
    public function getDeep()                   {return count($this->pathElements);}    
    public function getName()                   {return end($this->pathElements);}    
    public function getChild($name)             {return new Path(array_merge($this->pathElements,array($name)) , $this->directorySeparator);}    
    public function getParent()                 {if($this->isRoot())return null ; return new Path(array_slice ($this->pathElements, 0, count($this->pathElements)-1, true) , $this->directorySeparator);}    
    public function __toString()                {return $this->directorySeparator . implode($this->directorySeparator, $this->pathElements);}    
    public function combine(Path $subPath)  {return new Path(array_merge($this->pathElements,$subPath->pathElements) , $this->directorySeparator);}        
    public function getDirectorySeparator()     {return $this->directorySeparator;}
    public function getElements()           {return $this->pathElements;}
    public function getElement($index)      {return isset($this->pathElements[$index])?$this->pathElements[$index]:null;}
    public function getUID() {return implode('#', $this->pathElements);}   
    
    public function setDirectorySeparator($directorySeparator) {$this->directorySeparator = $directorySeparator;}


}
