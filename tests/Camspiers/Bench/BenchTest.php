<?php

namespace Camspiers\Bench;

class BenchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Camspiers\Bench\Bench
     */
    protected $bench;
    
    public function setUp()
    {
        $this->bench = new Bench();
    }
    
    public function testWrapClosure()
    {
        $timingFunction = $this->bench->wrapClosure(function () {});
        $this->assertTrue(is_float($timingFunction()));
    }
    
    public function testWrapMethod()
    {
        $mock = $this->getMock('stdClass', array('test'));
        $mock->expects($this->once())->method('test');
        
        $timingFunction = $this->bench->wrapMethod($mock, 'test');
        $this->assertTrue(is_float($timingFunction()));
    }
}