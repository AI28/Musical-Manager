<?php
include('Util'.DIRECTORY_SEPARATOR.'autoloader.php');
header("Access-Control-Allow-Origin: *");

use \Firebase\JWT\JWT;

if(isset($_COOKIE['visited-before'])){
    $Router = new CRouter();
    $Router->{strtolower($_SERVER['REQUEST_METHOD'])}($_SERVER['REQUEST_URI'])->resolve();
}
else{
    setcookie('visited-before','true',time()+3600*24*30,'/',"localhost");
    include($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."Pages".DIRECTORY_SEPARATOR."landing.html");
}
?>