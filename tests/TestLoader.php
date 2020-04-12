<?php
use PHPUnit\Framework\TestCase;

class TestLoader extends TestCase
{
    public function testLoaderSources()
    {        
        $this->assertSame(class_exists('Kito\Loader\Sources'), true);
    }
}
