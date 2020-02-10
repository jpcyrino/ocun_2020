<?php
namespace Ocun\Pages\Abbreviations;
use Ocun\Pages\Controller;
use Ocun\Database\Linguistic\Abbreviation;
use Ocun\Database\Linguistic\Source;
use Ocun\Database\User\Session;

class Abbreviations extends Controller{

  private function checkAccess($sourceID){
    $src = new Source;
    foreach($src->loadListAccess() as $row){
      if($row['id'] == $sourceID){
        return true;
      }
    }
    return false;
  }

  private function storeAbbreviation(){
    if(isset($_POST['abbreviation'], $_POST['meaning']) && $_POST['submit']=='Salvar'){
      $abbv = new Abbreviation;
      $abbv->storeAbbreviation($_GET['id'], htmlspecialchars($_POST['abbreviation'], ENT_QUOTES, 'UTF-8'), htmlspecialchars($_POST['meaning'], ENT_QUOTES, 'UTF-8'));
    }
  }

  private function updateAbbreviation(){
    if(isset($_POST['eabbreviation'], $_POST['emeaning'], $_POST['abid']) && $_POST['submit'] == 'Atualizar'){
      $abbv = new Abbreviation;
      foreach($_POST['abid'] as $i => $row){
        $abbv->updateAbbreviation($_POST['abid'][$i], htmlspecialchars($_POST['eabbreviation'][$i], ENT_QUOTES, 'UTF-8'), htmlspecialchars($_POST['emeaning'][$i], ENT_QUOTES, 'UTF-8'));
      }

    }
  }

  private function meanings(){
    $abbv = new Abbreviation;
    return $abbv->parseMeanings($_GET['id']);
  }

  public static function load(){
    if(!isset($_GET['id'], $_GET['language'], $_GET['source'])){
      echo $_GET['id'];
      die();
    } else {
      if(!self::checkAccess($_GET['id'])){
        Session::denyAccess(5);
      }
    }
    self::storeAbbreviation();
    self::updateAbbreviation();
    $abbv = new Abbreviation;
    $abbvs = $abbv->listAbbreviations($_GET['id']);
    echo self::loadTemplate("/../Abbreviations/template.html.php", [
      'abbvs' => $abbvs,
      'source' => $_GET['source'],
      'language' => $_GET['language'],
      'id' => $_GET['id'],
      'meanings' => self::meanings()
        ]);
  }



}

?>
