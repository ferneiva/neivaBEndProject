<?php
session_start();
define ("ROOT", "");
$url_parts = explode("/", $_SERVER["REQUEST_URI"]);
//echo"<pre>";
//print_r($url_parts);
$controller = $url_parts[1];
//$id = $url_parts[3];
//echo $controller;
if(empty($controller)){
    $controller = "home";
}

if(!empty($url_parts[2])){
    $id = $url_parts[2];
}
// echo $controller;
//echo $id;
// require("controllers/home.php");
require("controllers/" .$controller. ".php");