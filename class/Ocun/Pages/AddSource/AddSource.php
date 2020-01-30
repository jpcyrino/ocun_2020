<?php
namespace Ocun\Pages\AddSource;
use Ocun\Pages\Controller;
use Ocun\Database\Linguistic\Source;
use Ocun\Database\Linguistic\Language;

class AddSource extends Controller{

  private static function checkPOST(){
    if(!isset(
      $_POST['language'],
      $_POST['name'],
      $_POST['author'],
      $_POST['year'],
      $_POST['publisher'])){
        return false;
      } else {
        return true;
      }
  }

  private static function handlePOST(){
    if(self::checkPOST()){
        $src = new Source;
        return $src->store([
          $_POST['language'],
          $_POST['name'],
          $_POST['author'],
          $_POST['year'],
          $_POST['publisher']
        ]);
    } else {
      return false;
    }
  }

// Elaborar funcionamento dos templates.. frontend..
  public static function load() {
    if(self::handlePOST()){
      header("Location: index.php?page=SourcePreferences&language={$_POST['language']}&name={$_POST['name']}");
      die();
    }
    $lang = new Language;
    $languages = $lang->loadList();
    echo self::loadTemplate("/../AddSource/template.html.php", ['languages' => $languages]);
  }

}



 ?>
