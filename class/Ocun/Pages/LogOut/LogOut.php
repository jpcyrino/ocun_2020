<?php
namespace Ocun\Pages\LogOut;
use Ocun\Pages\Controller;

Class LogOut extends Controller{

  public static function load(){
    session_start();
    session_destroy();
    header("Location: index.php");
    die();
  }

}






 ?>
