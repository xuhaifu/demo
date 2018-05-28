<?php
/**
 * Created by Outdata.php
 * Author: XHF
 * Date: 2018/5/28
 * Time: 13:56
 */

namespace Test;
use Redis;

trait Outdata
{
    public static $redis;

    public $conn;

    public function __construct()
    {
        if(self::$redis === null){
            self::$redis = new Redis();
        }
        $this->conn = self::$redis->connect('127.0.0.1');
    }
}