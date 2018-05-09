<?php
/**
 * Created by index.php
 * Author: XHF
 * Date: 2018/5/9
 * Time: 9:48
 */


/************************* Session 选项************************/
//PHP 7 session_start()函数可以接收一个数组作为参数，可以覆盖php.ini中session的配置项。
//这个特性也引入了一个新的php.ini设置（session.lazy_write）,默认情况下设置为 true，意味着session数据只在发生变化时才写入。
/*
session_start([
    'cache_limiter' => 'private',
    'read_and_close' => true,
]);
/*

/*************************错误处理************************/
//Error 类并不是从 Exception 类 扩展出来的，所以用 catch (Exception $e) { ... } 这样的代码是捕获不 到 Error 的。
//你可以用 catch (Error $e) { ... } 这样的代码，或者通过注册异常处理函数（ set_exception_handler()）来捕获 Error。
//Error
//    ArithmeticError
//    AssertionError
//    DivisionByZeroError
//    ParseError
//    TypeError

class MathOperations
{
    protected $n = 10;
    // 求余数运算，除数为 0，抛出异常
    public function doOperation(): string
    {
        try {
            $value = $this->n % 0;
            return $value;
        } catch (DivisionByZeroError $e) {
            return $e->getMessage();
        }
    }
}

$mathOperationsObj = new MathOperations();
print($mathOperationsObj->doOperation());

exit;
/*************************CSPRNG************************/
//random_bytes() - 加密生存被保护的伪随机字符串(二进制)。
//random_int() - 加密生存被保护的伪随机整数。

$bytes = random_bytes(5);
print(bin2hex($bytes));

echo  PHP_EOL;

$int = random_int(500,1000);
echo  $int;


/*************************整除intdiv************************/
//http://php.net/manual/zh/function.intdiv.php
var_dump(intdiv(10, 3));


/*************************Generator 加强************************/
function gen()
{
    yield 1;
    yield 2;
    yield from gen2();
}
function gen2()
{
    yield 3;
    yield 4;
}
foreach (gen() as $val)
{
    echo $val, PHP_EOL;
}


/*************************use 加强************************/
//  PHP 7 之前版本用法
//use some\namespace\ClassA;
//use some\namespace\ClassB;
//use some\namespace\ClassC as C;
//
//use function some\namespace\fn_a;
//use function some\namespace\fn_b;
//use function some\namespace\fn_c;
//
//use const some\namespace\ConstA;
//use const some\namespace\ConstB;
//use const some\namespace\ConstC;
//

// PHP 7+ 用法
//use some\namespace\{ClassA, ClassB, ClassC as C};
//use function some\namespace\{fn_a, fn_b, fn_c};
//use const some\namespace\{ConstA, ConstB, ConstC};


/*************************预期************************/
//http://php.net/manual/zh/function.assert.php
ini_set('assert.exception', 1);
class CustomError extends AssertionError {}
assert(false, new CustomError('Some error message'));


/*************************IntlChar（需要安装扩展）************************/
//http://php.net/manual/zh/class.intlchar.php
printf('%x', IntlChar::CODEPOINT_MAX);
echo IntlChar::charName('@');
var_dump(IntlChar::ispunct('!'));

/*************************为unserialize()提供过滤************************/
//http://php.net/manual/zh/function.unserialize.php
class MyClass1 {public $obj1prop;}
class MyClass2 {public $obj2prop;}
$obj1 = new MyClass1(); $obj1->obj1prop = 1;
$obj2 = new MyClass2(); $obj2->obj2prop = 2;
$serializedObj1 = serialize($obj1);
$serializedObj2 = serialize($obj2);

// 默认行为是接收所有类
// 第二个参数可以忽略
// 如果 allowed_classes 设置为 false, unserialize 会将所有对象转换为 __PHP_Incomplete_Class 对象
$data = unserialize($serializedObj1 , ["allowed_classes" => true]);
// 转换所有对象到 __PHP_Incomplete_Class 对象，除了 MyClass1 和 MyClass2
$data2 = unserialize($serializedObj2 , ["allowed_classes" => ["MyClass1", "MyClass2"]]);
var_dump($data);var_dump($data2);


/*************************Closure::call()************************/
//http://php.net/manual/en/closure.call.php
class A {private $x = 1;}

// Pre PHP 7 代码
$getXCB = function() {return $this->x;};
$getX = $getXCB->bindTo(new A, 'A'); // intermediate closure
echo $getX();

// PHP 7+ 代码
$getX = function() {return $this->x;};
echo $getX->call(new A);

/*************************Unicode codepoint 转译语法************************/
echo "\u{aa}";
echo "\u{0000aa}";
echo "\u{9999}";

/*************************匿名类************************/
//http://php.net/manual/zh/language.oop5.anonymous.php
class Res{
    public function getVal(array ...$arr)
    {
        return array_map(function(array $array): int{
            return array_sum($array);
        },$arr);
    }
}

$new_class = new class extends Res{
    public function index(): int
    {
        return '123456';
    }
};
var_dump($new_class->getVal([1,2,3]));
var_dump($class ?? $new_class->index());

interface Logger {
    public function log(string $msg);
}

class Application {
    private $logger;

    public function getLogger(): Logger {
        return $this->logger;
    }

    public function setLogger(Logger $logger) {
        $this->logger = $logger;
    }
}

$app = new Application;
$app->setLogger(new class implements Logger {
    public function log(string $msg) {
        echo $msg;
    }
});

var_dump($app->getLogger());


/*******************通过 define() 定义常量数组************************/
//http://php.net/manual/zh/function.define.php
define('ANIMALS', [
    'dog',
    'cat',
    'bird'
]);

echo ANIMALS[1]; // 输出 "cat"


/*******************太空船操作符（组合比较符）************************/
//http://php.net/manual/zh/language.operators.comparison.php#language.operators.comparison.ternary
//当$a大于、等于或小于$b时它分别返回-1、0或1
// 整型
echo 1 <=> 1; // 0
echo 1 <=> 2; // -1
echo 2 <=> 1; // 1

// 浮点型
echo 1.5 <=> 1.5; // 0
echo 1.5 <=> 2.5; // -1
echo 2.5 <=> 1.5; // 1

// 字符串
echo "a" <=> "a"; // 0
echo "a" <=> "b"; // -1
echo "b" <=> "a"; // 1

/*******************NULL 合并运算符************************/
//http://php.net/manual/zh/language.operators.comparison.php#language.operators.comparison.ternary
$a = 'x56x';
echo  $b ?? $c ?? $a ?? 'x12x34x';

// 如果 $_GET['user'] 不存在返回 'nobody'，否则返回 $_GET['user'] 的值
$username = $_GET['user'] ?? 'nobody';
// 类似的三元运算符
$username = isset($_GET['user']) ? $_GET['user'] : 'nobody';


/*******************返回值类型声明************************/
//http://php.net/manual/zh/functions.returning-values.php

function sum_re($a, $b): float {
    return $a + $b;
}
var_dump(sum_re(1, 2));

function arraysSum(array ...$arrays): array
{
    return array_map(function(array $array): int {
        return array_sum($array);
    }, $arrays);
}

print_r(arraysSum([1,2,3], [4,5,6], [7,8,9]));

/*******************标量类型声明************************/
//http://php.net/manual/zh/functions.arguments.php#functions.arguments.default
//强制模式,可以使用 string、int、float和 bool 了。

function sum(int $a, int $b) {
    return $a + $b;
}
try {
    var_dump(sum(1, 2));
    var_dump(sum(1.5, 2.5));
} catch (TypeError $e) {
    echo 'Error: '.$e->getMessage();
}

function sum2(...$numbers) {
    $acc = 0;
    foreach ($numbers as $n) {
        $acc += $n;
    }
    return $acc;
}
echo sum2(1, 2, 3, 4);

function sumOfInts(int ...$ints)
{
    var_dump($ints);
    return array_sum($ints);
}

var_dump(sumOfInts(2, '3', 4.1));





