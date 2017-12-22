<?php
/**
 * redis 单例模式
 */

require dirname(__FILE__).'/redisconfig.php';

class modelRdeis
{

    private $config = [];

    //保存例实例在此属性中
    private static $_instance;

    //构造函数声明为private,防止直接创建对象
    private function __construct($name)
    {
        //按照Redis服务器名称获取Redis实例
        $this->config = RedisConfig::getInstance($name);
        $this->_initConnect();
    }

    //单例方法
    public static function get_instance($name = 'public')
    {
        if(!isset(self::$_instance))
        {
            self::$_instance=new self($name);
        }
        return self::$_instance;
    }

    private function _initConnect()
    {
        //获取配置
        $config = $this->config->get();
        if(empty($config)){
            return false;
        }
        $config = $config['local'];
        //Redis操作对象
        $this->Redis = new Redis();
        $ret = $this->Redis->connect($config['ip'], $config['port']);
        //设置读Redis是否连接成功
        if ($ret){
            $this->connected = true;
        }
    }

    private function __clone()
    {
        trigger_error('Clone is not allow' ,E_USER_ERROR);
    }

    /**
     * @desc 写缓存
     * @access public
     * @param string $key 组存KEY
     * @param string $value 缓存值
     * @param int $expire 过期时间， 0:表示无过期时间
     * @return bool
     */
    public function set($key, $value, $expire=0)
    {
        // 永不超时
        if($expire == 0){
            $ret = $this->Redis->set($key, $value);
        } else {
            $ret = $this->Redis->setex($key, $expire, $value);
        }
        return $ret;
    }

    /**
     * @desc 读缓存
     * @access public
     * @param string $key 缓存KEY,支持一次取多个 $key = array('key1','key2')
     * @return string || boolean  失败返回 false, 成功返回字符串
     */
    public function get($key)
    {
        $func= is_array($key) ? 'mGet': 'get';
        $result = $this->Redis->{$func}($key);
        return $result;
    }

}
