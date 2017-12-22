<?php
/**
 * 返回XML格式
 * User: WuHaiJie
 * Date: 2017/11/27
 * Time: 9:24
 */
//namespace Common\sync;

class CallbackResult
{
    public $success;

    public $data    =   array();

    /**
     * 数据返回类型
     * @var string
     */
    public $type    =   '';

    public function returnData($data, $type = 'json', $rootNode = '')
    {
        //加载数据类
        $type       =   strtoupper($type);
        $dataFile   =   'Return'.$type;
        $filePath   =   dirname(__FILE__).DIRECTORY_SEPARATOR.$dataFile.'.php';

        if (file_exists($filePath)){
            require $filePath;
        }
        //类名
        $className  =   'Return'.$type;

        if($rootNode){
            $resultModel=   new $className([$rootNode]);
        }else{
            $resultModel=   new $className();
        }
        return call_user_func_array(array($resultModel, 'returnData'), $data);
    }

}