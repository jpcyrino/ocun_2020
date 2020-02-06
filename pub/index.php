<?php

 include __DIR__ . '/../conf/autoload.php';
 use Ocun\Database\User\Session;

 session_start();
 Session::CheckRegisteredLevel();
 $_SESSION['level'] = 7;
 $_SESSION['id'] = 1;
 $_SESSION['name'] = 'João Paulo';

if(isset($_GET['page'])){
  $class = $_GET['page'];
  $path = "Ocun\\Pages\\{$class}\\{$class}";
  $path::load();

}

?>
