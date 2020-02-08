<?php
namespace Ocun\Pages\FeedSentence;
use Ocun\Pages\Controller;
use Ocun\Database\Linguistic\DataFeeder;
use Ocun\Database\Linguistic\Cleanse;
use Ocun\Database\Linguistic\Source;
use Ocun\Database\Linguistic\Sentence;
use Ocun\Database\Linguistic\Encode;
use Ocun\Database\User\Session;

class FeedSentence extends Controller {

  private static $sourceData;

  private function checkAccess($sourceID){
    $src = new Source;
    foreach($src->loadListAccess() as $row){
      if($row['id'] == $sourceID){
        self::$sourceData = $row;
        return true;
      }
    }
    return false;
  }

  private function loadSentences($sourceID){
    $sent = new Sentence;
    return $sent->sentenceList($sourceID);
  }

  private function loadEncode($sourceID){
    $enc = new Encode;
    return $enc->loadList($sourceID);
  }

  private function getSentenceData($sentenceID, $sentences){
    $original = "";
    $gloss = "";
    foreach($sentences as $sent){
      if($sent[0]['sentence'] == $sentenceID){
        foreach($sent as $m){
          $original .= $m['form']."-";
          $gloss .= $m['meaning']."-";
        }
        $translation = $sent[0]['translation'];
      }
    }
    return [
      'original' => trim(str_replace("-_-", " ", $original), "-"),
      'gloss' => trim(str_replace("-_-", " ", $gloss), "-"),
      'translation' => $translation
    ];
  }

  private function storeEdit(){
    if(isset($_POST['eoriginal'], $_POST['egloss'], $_POST['etranslation'], $_GET['sid'])){
      $cl = new Cleanse;
      $cl->killSentence($_GET['sid']);
      $feed = new DataFeeder($_GET['id']);
      $feed->feed($_POST['eoriginal'], $_POST['egloss'], $_POST['etranslation']);
    }
  }

  private function storeSentence(){
    if(isset($_POST['ioriginal'], $_POST['igloss'], $_POST['itranslation'])){
      $feed = new DataFeeder($_GET['id']);
      $feed->feed($_POST['ioriginal'], $_POST['igloss'], $_POST['itranslation']);
    }
  }

  public static function load(){
    if(!isset($_GET['id'])){
      echo $_GET['id'];
      die();
    } else {
      if(!self::checkAccess($_GET['id'])){
        Session::denyAccess(5);
      }
    }
    self::storeEdit();
    self::storeSentence();
    $sentences = self::loadSentences($_GET['id']);
    if(isset($_GET['eid'])){
      $data = self::getSentenceData($_GET['eid'], $sentences);
      echo self::loadTemplate("/../FeedSentence/editsentence.html.php", [
        'id' => $_GET['id'],
        'sentence' => $_GET['eid'],
        'original' => $data['original'],
        'gloss' => $data['gloss'],
        'translation' => $data['translation'],
        'separators' => self::$sourceData['separators'],
        'encode' => self::loadEncode($_GET['id'])
      ]);
    } else {
      echo self::loadTemplate("/../FeedSentence/template.html.php", [
        'id' => $_GET['id'],
        'sentences' => $sentences,
        'separators' => self::$sourceData['separators'],
        'encode' => self::loadEncode($_GET['id'])
      ]);
    }
  }


}
