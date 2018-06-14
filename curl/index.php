<?php
/**
 * Created by index.php
 * Author: XHF
 * Date: 2018/6/14
 * Time: 10:43
 */

namespace Curl;
require_once '../vendor/autoload.php';

use GuzzleHttp\Client;

class Index
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @desc 模拟cookie登录
     * @author xhf
     * @date 2018/6/14 10:47
     * @param $host
     * @param $cookie
     * @param $mothed
     * @return string
     */
    public function CurlCookieTest($host,$cookie = [],$mothed = 'GET')
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar();

        $domain = parse_url($host);
        $cookieJar = $jar->fromArray($cookie, $domain['host']);

        $res = $this->client->request($mothed, $host, [
            'cookies' => $cookieJar
        ]);
        return $res->getBody();
    }
}

$Index = new Index();
echo $Index->CurlCookieTest('http://local1.hiselling.com/bg_os/index.php?com=index',[
    'sg_center_SID' => 'f579726c73aebbfec3e4f6827b842b1b'
]);