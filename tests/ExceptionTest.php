<?php
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    public function testLoaderException()
    {        
        $this->expectException(Kito\Exception::class);
        throw new Exception('Test');
    }

}
