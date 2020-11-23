<?php 
    include_once 'Medoo.php';
    use Medoo\Medoo;
    $database = new Medoo(['database_type' => 'mysql',
    'database_name' => 'scraper',         
    'server' => 'localhost',         
    'username' => 'root',
    'password' => ''     
    ]);
?>