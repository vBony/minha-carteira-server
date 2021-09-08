<?php
require 'vendor/autoload.php';
date_default_timezone_set("America/Sao_Paulo");

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__.'/.env');

global $db;
try{
    $db = new PDO("mysql:dbname=".$_ENV['DB_NAME'].";host=".$_ENV['HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
}catch(PDOException $e){
    echo "Error: ".$e->getMessage();
    exit;
}
?>