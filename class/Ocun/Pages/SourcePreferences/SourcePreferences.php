<?php
namespace Ocun\Pages\SourcePreferences;
use Ocun\Pages\Controller;
use Ocun\Database\Linguistic\Source;
use Ocun\Database\Linguistic\Language;
use Ocun\Database\Linguistic\Encode;
use Ocun\Database\User\Session;

class SourcePreferences extends Controller{

  private static $source;

  private static function getSource($name, $language){
    $src = new Source;
    foreach ($src->loadList() as $row){
      if($row['name'] == $name && $row['language'] == $language){
        return $row['id'];
      }
    }
  }

  private static function getLanguageName($language){
    $lang = new Language;
    foreach ($lang->loadList() as $row){
      if($row['id'] == $language){
        return $row['name'];
      }
    }
  }

  private static function getSourceData(){
    $src = new Source;
    foreach ($src->loadList() as $row){
      if($row['id'] == self::$source){
        return $row;
      }
    }
  }

  private static function getEncodeData(){
    $enc = new Encode;
    return $enc->loadList(self::$source);
  }

  private static function storeLicenseData($license, $url){
    $src = new Source;
    return $src->updateLicense(self::$source, $license, $url);
  }

  private static function storeSeparators($separators){
    $src = new Source;
    return $src->updateSeparators(self::$source, $separators);
  }

  private static function storeEncode($input, $output){
    $enc = new Encode;
    return $enc->store([self::$source, $input, $output]);
  }

  private static function updateEncode($id, $input, $output){
    $enc = new Encode;
    return $enc->update($id, $input, $output);
  }

  public static function load() {
    Session::denyAccess(3);
    if(isset($_GET['id'])){
      self::$source = $_GET['id'];
    } elseif(isset($_GET['name'], $_GET['language'])) {
      self::$source = self::getSource($_GET['name'], $_GET['language']);
    } else {
      /*header('Location: index.php');
      die(); */
      echo $_GET['id'];
      die();
    }

    if(isset($_POST['license'], $_POST['url'])){
      $status = self::storeLicenseData($_POST['license'], $_POST['url']);
    }

    if(isset($_POST['separators'])){
      $status = self::storeSeparators($_POST['separators']);
    }

    if(isset($_POST['submit']) && $_POST['submit'] == 'Atualizar'){
      foreach($_POST['encid'] as $i => $data){
        $status = self::updateEncode($_POST['encid'][$i], $_POST['einput'][$i], $_POST['eoutput'][$i]);
      }

    } elseif(isset($_POST['input'], $_POST['output'])){
      $status = self::storeEncode($_POST['input'], $_POST['output']);
    }

    $s = self::getSourceData();

    echo self::loadTemplate("/../SourcePreferences/template.html.php", [
      'source' => self::$source,
      'sourceName' => $s['name'],
      'languageName' => self::getLanguageName($s['language']),
      'sourceLicense' => $s['license'],
      'sourceURL' => $s['url'],
      'sourceMorphemeSeparators' => $s['separators'],
      'encode' => self::getEncodeData()
    ]);
  }
}



 ?>
