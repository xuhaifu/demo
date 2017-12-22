<?php
/**
 * @package: PhpStorm.
 * @author: xhf
 * @since: 2017/12/22 10:01
 */

require "modelInterface.php";

class modelTest implements modelInterface
{
    public function getData($param = [])
    {
        // TODO: Implement getData() method.
        if(empty($param)){
            return false;
        }
        $param['Orders'] = array(
            array(
                'Order' => 40,
                'OrderNumber' => 123,
                'OrderDate' => '2017-12-01 14:45:16'
            ),
            array(
                'Order' => 50,
                'OrderNumber' => 456,
                'OrderDate' => '2017-12-01 14:45:16'
            ),
            array(
                'Order' => 60,
                'OrderNumber' => 789,
                'OrderDate' => '2017-12-01 14:45:16'
            ),
        );
        $data['Works'] = $param;

        return $data;
    }
}