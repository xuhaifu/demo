<?php
/**
 * @package: PhpStorm.
 * @author: xhf
 * @since: 2017/12/22 15:15
 */

class RedisConfig
{

    /**
     * 配置参数
     */
    public $config = [];

    /**
     * @desc 构造函数
     */
    public function __construct()
    {

    }

    /**
     * @desc 获取配置信息
     * @access	public
     * @param string $path 配置参数路径
     * @return RedisConfig
     */
    public function get()
    {
        return $this->config;
    }

    /**
     * @desc 获取Redis配置实例
     * @static
     * @access	public
     * @param string $name 配置名称
     * @return RedisConfig
     */
    public static function &getInstance($name){
        static $instances;
        if (!isset($instances)){
            $instances = array();
        }

        if (!$instances[$name]){
            $path = dirname(__FILE__).DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.$name.'.php';
            $classname = ucfirst($name).'RedisConfig';

            //类不存在的话,要载入类包
            if (!class_exists($classname)){
                if (file_exists($path)){
                    require $path;
                }

                if (!class_exists($classname)){
                    $classname = 'RedisConfig';
                }
            }

            $instances[$name] = $classname::get_instance();
        }
        return $instances[$name];
    }
}