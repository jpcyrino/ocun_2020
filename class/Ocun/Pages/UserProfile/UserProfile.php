<?php

namespace Ocun\Pages\UserProfile;
use Ocun\Pages\Controller;
use Ocun\Database\User\Profile;

Class UserProfile extends Controller{

  protected static function changePassword(){
    $p = new Profile;
    if(isset($_GET['email'])){
      $p->changePassword($_GET['email'], $_POST['password_new']);
      return "Sucesso! Faça login com sua nova senha para acessar o sistema!";
    } else {
      if($p->authenticate($_SESSION['user'], $_POST['password_old'])){
        $p->changePassword($_SESSION['user'], $_POST['password_new']);
        return "Senha alterada com sucesso!";
      } else {
        return "Senha antiga incorreta.";
      }
    }
  }

  public static function load(){

    if(isset($_POST['password_new'])){
      echo self::loadTemplate("/../UserProfile/template.html.php", ['result' => self::changePassword()]);
    } else {
      echo self::loadTemplate("/../UserProfile/template.html.php", []);
    }

  }



}


 ?>
