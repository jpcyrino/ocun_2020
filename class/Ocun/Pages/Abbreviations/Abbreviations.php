<?php
namespace Ocun\Pages\Abbreviations;
use Ocun\Pages\Controller;
use Ocun\Database\Linguistic\Abbreviation;
use Ocun\Database\Linguistic\Source;
use Ocun\Database\User\Session;

class Abbreviations extends Controller{

  private static function checkAccess($sourceID){
    $src = new Source;
    foreach($src->loadListAccess() as $row){
      if($row['id'] == $sourceID){
        return true;
      }
    }
    return false;
  }

  private static function storeAbbreviation(){
    if(isset($_POST['abbreviation'], $_POST['meaning']) && $_POST['submit']=='Salvar'){
      $abbv = new Abbreviation;
      $abbv->storeAbbreviation($_GET['id'], htmlspecialchars($_POST['abbreviation'], ENT_QUOTES, 'UTF-8'), htmlspecialchars($_POST['meaning'], ENT_QUOTES, 'UTF-8'));
    }
  }

  private static function updateAbbreviation(){
    if(isset($_POST['eabbreviation'], $_POST['emeaning'], $_POST['abid']) && $_POST['submit'] == 'Atualizar'){
      $abbv = new Abbreviation;
      foreach($_POST['abid'] as $i => $row){
        $abbv->updateAbbreviation($_POST['abid'][$i], htmlspecialchars($_POST['eabbreviation'][$i], ENT_QUOTES, 'UTF-8'), htmlspecialchars($_POST['emeaning'][$i], ENT_QUOTES, 'UTF-8'));
      }

    }
  }

  private static function storeMeaningClassification(){
    if(isset($_POST['sig'], $_POST['classif']) && $_POST['submit'] == 'Salvar'){
      $abbv = new Abbreviation;
      foreach($_POST['sig'] as $i => $row){
        if($_POST['classif'][$i] != " "){
          $abbv->storeMeaningClassification($_POST['sig'][$i], $_POST['classif'][$i]);
        }
      }
    }
  }

  private static function meanings(){
    $abbv = new Abbreviation;
    $meanings = array();
    $class = [
      'f' => 'Funcional',
      'e' => 'Evento',
      't' => 'Entidade',
      'p' => 'Propriedade'
    ];
    foreach($abbv->parseMeanings($_GET['id']) as $m){
      $st = $abbv->getMeaningClassification(htmlspecialchars($m, ENT_QUOTES, 'UTF-8'));
      $meanings[] = $st ? [$m, $class[$st['classification']], $st['classification']] : [$m, " ", " "];
    }
    return $meanings;
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
    self::storeMeaningClassification();
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
