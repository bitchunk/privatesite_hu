<?php
require_once("./properties/env_common.php");//SESSIONチェックとか

// var_dump($_SERVER['HTTP_REFERER']);
$pathinfo = pathinfo($_SERVER['HTTP_REFERER']);
$_REQUEST['method'] = 'get';
$_REQUEST['scene'] = $pathinfo['filename'];
$_REQUEST['user'] = !empty($_SESSION['user']['account']) ? $_SESSION['user']['account'] : 'guest';
require_once("./controllers/JsCompreQuery.php");

?>

