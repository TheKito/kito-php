<?php
use PHPUnit\Framework\TestCase;

class LoaderTest extends TestCase
{
    public function testLoader()
    {        
        $this->assertSame(class_exists('Kito\Loader\Loader'), true);
    }
    public function testLoaderSources()
    {        
        $this->assertSame(class_exists('Kito\Loader\Sources'), true);
    }
}
