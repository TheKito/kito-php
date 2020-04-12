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
        try
        {
            new Kito\Storage\Memcache($keyPrefix);
            $this->assertSame(true,true);
        }
        catch (\Throwable $t)
        {
            $this->assertSame($t->getMessage(),true);
        }
        catch (\Exception $e)
        {
            $this->assertSame($e->getMessage(),true);
        }
    }
    public function testInstanceMemcacheKeyPrefix()            
    {
        $this->testInstanceMemcache('ExampleKeyPrefix');
    }
}
