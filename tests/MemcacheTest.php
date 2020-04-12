<?php
use PHPUnit\Framework\TestCase;

class MemcacheTest extends TestCase
{
    public function testMemcache()
    {        
        $this->assertSame(class_exists('Kito\Storage\Memcache'), true);
    }
    public function testInstanceMemcache($keyPrefix = null)
    {          

            new Kito\Storage\Memcache($keyPrefix);

    }
    public function testInstanceMemcacheKeyPrefix()            
    {
        $this->testInstanceMemcache('ExampleKeyPrefix');
    }
}
