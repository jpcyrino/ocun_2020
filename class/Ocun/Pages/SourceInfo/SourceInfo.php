<?php
namespace Ocun\Pages\SourceInfo;
use Ocun\Pages\Controller;
use Ocun\Database\User\Session;
use Ocun\Database\Linguistic\Sentence;
use Ocun\Database\Linguistic\Source;
use Ocun\Statistics\Probability\MorphemeUnigram;
use Ocun\Pages\SourceInfo\Ajax;

class SourceInfo extends Controller{

protected static function checkAccess($sourceID){
  $src = new Source;
  if($src->getInfo($sourceID)['license'] != 'private'){
    return $src->getInfo($sourceID);
  } else {
    foreach($src->loadListAccess() as $row){
      if($row['id'] == $sourceID){
        self::$sourceData = $row;
        return $src->getInfo;
      }
    }
    return false;
  }
}

public static function load(){
  if(!isset($_GET['id'])){
    Session::denyAccess(8);
  }
  if(isset($_GET['ajax'])){
    $func = "ajax_" . $_GET['ajax'];
    Ajax::$func();
    die();
  }
  $sourceData = self::checkAccess($_GET['id']);
  if(!$sourceData){
    Session::denyAccess(8);
  }
  $s = new Sentence;
  echo self::loadTemplate("/../SourceInfo/template.html.php", [
    'sourceData' => $sourceData,
    'sentences' => $s->sentenceList($_GET['id'])
  ]);

}


}





 ?>
