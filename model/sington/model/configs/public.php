<?php
/**
 * @package: PhpStorm.
 * @author: xhf
 * @since: 2017/12/22 14:13
 */

class PublicRedisConfig extends RedisConfig
{
    private static $_instance;

    /**
     * 配置参数
     */
    public $config = array(
        //读Redis配置
        'local' => array(
            'ip' => '127.0.0.1',
            'port' => 6379,
        ),

        //写Redis配置
        'write' => array(
            'ip' => '127.0.0.1',
            'port' => 6379,
        ),
    );

    //单例方法
    public static function get_instance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance=new self();
        }
        return self::$_instance;
    }

}
