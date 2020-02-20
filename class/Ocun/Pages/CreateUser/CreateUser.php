<?php

namespace Ocun\Pages\CreateUser;
use Ocun\Pages\Controller;
use Ocun\Database\User\Profile;

Class CreateUser extends Controller{


  private static function ajaxCheckEmail($email){
    $prof = new Profile;
    if($prof->checkEmailExists($email)){
      echo "true";
    } else {
      echo "false";
    }
  }

  private static function registerUser(){
    if(isset($_POST['name'])){
      $prof = new Profile;
      $prof->createUser($_POST['name'], $_POST['email'], $_POST['password']);
      echo self::loadTemplate("/../CreateUser/register.html.php", []);
      die();
    }
  }

  public static function load(){
    self::registerUser();
    if(isset($_GET['ajax'])){
      self::ajaxCheckEmail($_GET['ajax']);
    } else {
      echo self::loadTemplate("/../CreateUser/template.html.php", []);
    }

  }



}


 ?>
