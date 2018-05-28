<?php

namespace tests;
use tests\MysqlTestCase;

class MyTestCase extends MysqlTestCase
{

    public function getDataSet()
    {
        return $this->createMySQLXMLDataSet('/data/file.xml');
    }
}