<?php
require_once 'controller/AppController.class.php';

$c = $_GET['c'] ?? 'AppController';
$m = $_GET['m'] ?? 'login';

$controller = new $c();
$controller->$m();
