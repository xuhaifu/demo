<?php

$redis = new Redis();
$redis->connect('127.0.0.1',6379);

$g_key = 'group_products_num';

if(isset($_GET['product_num'])){
    $products_num = $_GET['product_num'];

    if($products_num > 0){
        //生成一个库存列表
        for($i=1;$i<=$products_num;$i++){
            $redis->rPush($g_key,$i);
        }
    }
}

if(isset($_GET['user_id'])) {
    $user = $_GET['user_id'];
    $u_key = 'products_yes_user';
    if($redis->lSize($g_key)) {
        if($redis->lPop($g_key)) {
            $redis->rPush($u_key, $user);
            echo '用户'.$user.'抢购成功'.PHP_EOL;
        }
    } else {
        echo '用户'.$user.'抢购失败'.PHP_EOL;
    }
} else {
    echo '用户不存在'.PHP_EOL;
}