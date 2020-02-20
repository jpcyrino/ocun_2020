<?php
namespace Ocun\Pages\Welcome;
use Ocun\Pages\Controller;
use Ocun\Database\User\Profile;

Class Welcome extends Controller{


  private static function logIn(){
    if(isset($_POST['email'], $_POST['password'])){
      $prof = new Profile;
      $prof->authenticate($_POST['email'], $_POST['password']);
      $_POST = array();
    }
  }

  public static function load(){
    self::logIn();
    echo self::loadTemplate("/../Welcome/template.html.php", []);
  }



}




 ?>
