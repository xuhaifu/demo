<?php
/**
 * Created by DatabaseTest.php
 * Author: XHF
 * Date: 2018/5/25
 * Time: 15:22
 */

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public static $redis;

    protected static $dbh;

    public static function setUpBeforeClass()
    {
        self::$redis = new Redis();
        self::$redis->connect('127.0.0.1');

        self::$dbh = new PDO('sqlite::memory:');
    }

    public static function tearDownAfterClass()
    {
        self::$dbh = null;
    }

    public function testOne()
    {
        $this->assertEquals('value',self::$redis->get('test_key'));
    }
}
