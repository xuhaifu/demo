<?php
/**
 * Created by OutputTest.php
 * Author: XHF
 * Date: 2018/5/25
 * Time: 14:13
 */

use PHPUnit\Framework\TestCase;

class OutputTest extends TestCase
{
    public function testExpectFooActualFoo()
    {
        $this->expectOutputString('foo');
        print 'foo';
    }

    public function testExpectBarActualBaz()
    {
        $this->expectOutputString('bar');
        print 'baz';
    }
}
