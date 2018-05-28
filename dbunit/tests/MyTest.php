<?php
/**
 * Created by Test.php
 * Author: XHF
 * Date: 2018/5/28
 * Time: 10:48
 */
namespace tests;

use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{
    public function testCalculate()
    {
        $this->assertEquals(2, 1 + 1);
    }
}