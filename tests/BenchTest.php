<?php

namespace bench;

class BenchTest extends \PHPUnit_Framework_TestCase
{
    public function testWrap()
    {
        $timingFunction = wrap(function () { return true; });
        $result = $timingFunction();
        $this->assertTrue($result);
        $this->assertTrue(is_float(collector()));
    }
    
    public function testInvoke()
    {
        $result = invoke(function () { return true; });
        $this->assertTrue($result);
        $this->assertTrue(is_float(collector()));
    }
    
    public function markProvider()
    {
        return [
            [0],
            [1],
            [2]
        ];
    }

    /**
     * @dataProvider markProvider
     */
    public function testMark($time)
    {
        mark($key = uniqid(microtime(true)));
        
        sleep($time);
        
        $this->assertEquals($time, (int) mark($key));
    }
}