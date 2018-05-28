<?php
/**
 * Created by index.php
 * Author: XHF
 * Date: 2018/5/28
 * Time: 13:59
 */

namespace Test;

$loader = require_once "../vendor/autoload.php";
$loader->addClassMap([
    'Test\Outdata' => './Outdata.php'
]);

$loader->register();

class Index
{
    use Outdata;

    public static $_instance;

    //单例方法
    public static function get_instance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance=new self();
        }
        return self::$_instance;
    }

    public function getvalue()
    {
        return self::$redis->get('test_key');
    }
}

echo Index::get_instance()->getvalue();

