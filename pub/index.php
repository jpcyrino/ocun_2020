<?php

include __DIR__ . '/../conf/autoload.php';
use Ocun\Database\User\Session;
use Ocun\Database\User\Profile;


session_start();
Session::checkRegisteredLevel();


$class = isset($_GET['page']) ? $_GET['page'] : "Welcome";
$path = "Ocun\\Pages\\{$class}\\{$class}";
$path::load();

?>
