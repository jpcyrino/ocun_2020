<?php

 include __DIR__ . '/../conf/autoload.php';
 use Ocun\Database\User\Session;

 session_start();
 Session::checkRegisteredLevel();
 $_SESSION['level'] = 7;
 $_SESSION['id'] = 2;
 $_SESSION['user'] = 'jjj@i.com';
 $_SESSION['name'] = 'João Paulo';

if(isset($_GET['page'])){
  $class = $_GET['page'];
  $path = "Ocun\\Pages\\{$class}\\{$class}";
  $path::load();

}

?>
