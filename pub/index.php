<?php

 include __DIR__ . '/../conf/autoload.php';

if(isset($_GET['page'])){
  $class = $_GET['page'];
  $path = "Ocun\\Pages\\{$class}\\{$class}";
  $path::load();

}

?>
