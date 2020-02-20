<?php
namespace Ocun\Pages\AddLanguage;
use Ocun\Pages\Controller;
use Ocun\Database\Linguistic\Language;
use Ocun\Database\User\Session;

class AddLanguage extends Controller{

  private static function checkPOST(){
    if(!isset($_POST['name'])){
        return false;
      } else {
        return true;
      }
  }

  private static function handlePOST(){
    if(self::checkPOST()){
        $lang = new Language;
        return $lang->store([$_POST['name'], $_POST['info']]);
    } else {
      return false;
    }
  }

  public static function load() {
    Session::denyAccess(3);
    if(self::handlePOST() && !isset($_GET['id'])){
      header("Location: index.php?page=AddSource");
      die();
    }
    if(isset($_GET['id'])){
      $l = new Language;
      echo self::loadTemplate("/../AddLanguage/template.html.php", ['language' => $l->loadInfo($_GET['id'])]);
    } else{
      echo self::loadTemplate("/../AddLanguage/template.html.php");
    }

  }

}



 ?>
