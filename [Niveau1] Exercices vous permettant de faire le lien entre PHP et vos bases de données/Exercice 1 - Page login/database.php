<?php
include_once ("Medoo.php");
use Medoo\Medoo;


$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'connection',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);
?>