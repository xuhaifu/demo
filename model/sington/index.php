<?php

try {
    require "model/modelRdeis.php";
    $redis = modelRdeis::get_instance();
    $data = [
        'ModuleVersion' => '2.4.1',
        'Parameters' => array(
            'Start' => 0,
            'End' => '2017-12-22 10:57:05'
        )
    ];

    $key = 'modeltest';

    $json = $redis -> get($key);
    if(empty($json)){
        $redis -> set($key,json_encode($data));
    }else{
        echo $json;
    }

} catch (Exception $exception) {
    echo $exception->getMessage();
}



