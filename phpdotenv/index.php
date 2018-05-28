<?php

require_once "../vendor/autoload.php";


$dotenv = new Dotenv\Dotenv("../");
$dotenv->load();

$conn = getenv('DB_CONNECTION');
$host = $_ENV['DB_HOST'];
$databases = $_SERVER['DB_DATABASE'];

echo $conn.'-'.$host.'-'.$databases;

