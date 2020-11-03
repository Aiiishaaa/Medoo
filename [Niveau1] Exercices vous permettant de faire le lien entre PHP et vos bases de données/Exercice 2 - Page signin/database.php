<?php
include_once ("Medoo.php");
use Medoo\Medoo;

// Initialisation
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'connection',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4'
]);
?>