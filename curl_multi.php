<?php
/**
 * 模拟高并发请求
 * Author: XHF
 * Date: 2018/5/18
 * Time: 15:30
 */

ini_set("display_errors", "off");
header("Content-type: text/html; charset=utf-8");

$url='http://192.168.40.129/redis/index.php';
$num=3000;

$mh = curl_multi_init();

for ($i=0; $i<=$num; $i++) {
    $conn[$i]=curl_init($url);
    curl_setopt($conn[$i],CURLOPT_RETURNTRANSFER,1);
    curl_multi_add_handle ($mh,$conn[$i]);
}
do { $n=curl_multi_exec($mh,$active); } while ($active);
for ($i=0; $i<=$num; $i++) {
    $res[$i]=curl_multi_getcontent($conn[$i]);
    curl_close($conn[$i]);
}
echo "<pre>";
print_r($res);
echo "</pre>";