<?php
/**
 * 返回XML数据
 * User: WuHaiJie
 * Date: 2017/11/27
 * Time: 9:31
 */

class ReturnJSON
{
    public $data    =   array();

    public $option  =   [];

    public function __construct($option = [])
    {
        $this->option   =   $option;
    }

    public function returnData($data)
    {
        //var_dump($data);exit;
        return json_encode($data);
    }
}