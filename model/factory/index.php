<?php
/**
 * @package: 简单的工厂模式实例
 * @author: xhf
 * @since: 2017/12/22 9:57
 */

require 'model/modelTest.php';
require 'return/returnResult.php';


try {
    $data = [
        'ModuleVersion' => '2.4.1',
        'Parameters' => array(
            'Start' => 0,
            'End' => '2017-12-22 10:57:05'
        )
    ];
    $test = new modelTest();

    $returnData = new CallbackResult();
    $modelData = $test->getData($data);

    echo $returnData -> returnData($modelData,'json');
} catch (Exception $exception) {
    echo $exception->getMessage();
}

