<?php
include_once ("Medoo.php");
use Medoo\Medoo;

// Initialisation
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'connexions',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);
?>