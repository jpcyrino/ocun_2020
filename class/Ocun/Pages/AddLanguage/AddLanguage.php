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
        return $lang->store([$_POST['name']]);
    } else {
      return false;
    }
  }

// Elaborar funcionamento dos templates.. frontend..
  public static function load() {
    Session::DenyAccess(3);
    if(self::handlePOST()){
      header("Location: index.php?page=AddSource");
      die();
    }
    echo self::loadTemplate("/../AddLanguage/template.html.php");
  }

}



 ?>
