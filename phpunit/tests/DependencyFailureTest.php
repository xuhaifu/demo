<?php
/**
 * Created by DependencyFailureTest.php
 * Author: XHF
 * Date: 2018/5/25
 * Time: 11:34
 */

use PHPUnit\Framework\TestCase;

class DependencyAndDataProviderComboTest extends TestCase
{
    public function provider()
    {
        return [['provider1'], ['provider2']];
    }

    public function testProducerFirst()
    {
        $this->assertTrue(true);
        return 'first';
    }

    public function testProducerSecond()
    {
        $this->assertTrue(true);
        return 'second';
    }

    /**
     * @depends testProducerFirst
     * @depends testProducerSecond
     * @dataProvider provider
     */
    public function testConsumer()
    {
        $this->assertEquals(
            ['provider1', 'first', 'second'],
            func_get_args()
        );
    }
}

class DependencyFailureTest extends TestCase
{
    public function testOne()
    {
        $this->assertTrue(False);
    }

    public function testTwo()
    {

    }
}