<?php
/**
 * Created by ExpectedErrorTest.php
 * Author: XHF
 * Date: 2018/5/25
 * Time: 14:06
 */

use PHPUnit\Framework\TestCase;

//class ExceptionTest extends TestCase
//{
//    public function testException()
//    {
//        $this->expectException(InvalidArgumentException::class);
//    }
//}

//class ExceptionTest extends TestCase
//{
//    /**
//     * @expectedException InvalidArgumentException
//     */
//    public function testException()
//    {
//    }
//}


//class ExpectedErrorTest extends TestCase
//{
//    /**
//     * @expectedException PHPUnit\Framework\Error
//     */
//    public function testFailingInclude()
//    {
//        include 'not_existing_file.php';
//    }
//}

class ErrorSuppressionTest extends TestCase
{
    public function testFileWriting() {
        $writer = new FileWriter;
        $this->assertFalse(@$writer->write('/is-not-writeable/file', 'stuff'));
    }
}
class FileWriter
{
    public function write($file, $content) {
        $file = fopen($file, 'w');
        if($file == false) {
            return false;
        }
        // ...
    }
}