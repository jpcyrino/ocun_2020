<?php
namespace Ocun\Pages\MorphemeInfo;
use Ocun\Pages\Controller;
use Ocun\Database\User\Session;
use Ocun\Database\Linguistic\Morpheme;
use Ocun\Database\Linguistic\Sentence;
use Ocun\Database\Linguistic\Abbreviation;
use Ocun\Statistics\Probability\MorphemeBigram;
use Ocun\Statistics\Probability\MorphemeUnigram;

class MorphemeInfo extends Controller{

  private static function getMorphemeData(){
    $mor = new Morpheme;
    $thisMorpheme = $mor->queryFromID($_GET['id']);
    $allomorphs = $mor->queryMeaning($thisMorpheme['source'], $thisMorpheme['meaning']);
    $homonyms = $mor->queryForm($thisMorpheme['source'], $thisMorpheme['form']);
    return [
      'morpheme' => $thisMorpheme,
      'allomorphs' => $allomorphs,
      'homonyms' => $homonyms
    ];
  }

  private static function getMorphemeUnigramStats($morphemeData){
    $ml = new Sentence;
    $muMorpheme = new MorphemeUnigram($ml->morphemeList($morphemeData['morpheme']['source']), 'morpheme');
    $muMeaning = new MorphemeUnigram($ml->morphemeList($morphemeData['morpheme']['source']), 'meaning');
    $muForm = new MorphemeUnigram($ml->morphemeList($morphemeData['morpheme']['source']), 'form');
    foreach($muMorpheme->getData() as $t){
      if($t['morpheme'] == "{$morphemeData['morpheme']['form']} {$morphemeData['morpheme']['meaning']}"){
        $morpheme = [
          'count' => $t['count'],
          'P' => $t['P'],
          'logP' => $t['logP']
        ];
        break;
      }
    }
    foreach($muMeaning->getData() as $t){
      if($t['meaning'] == $morphemeData['morpheme']['meaning']){
        $meaning = [
          'count' => $t['count'],
          'P' => $t['P'],
          'logP' => $t['logP']
        ];
        break;
      }
    }
    foreach($muForm->getData() as $t){
      if($t['form'] == $morphemeData['morpheme']['form']){
        $form = [
          'count' => $t['count'],
          'P' => $t['P'],
          'logP' => $t['logP']
        ];
        break;
      }
    }
    return [
      'morpheme' => $morpheme,
      'meaning' => $meaning,
      'form' => $form
    ];
  }

  private static function getMeaningBigrams($morphemeData){
    $ml = new Sentence;
    $mbMeaning = new MorphemeBigram($ml->morphemeList($morphemeData['morpheme']['source']), 'morpheme');
    $retarray = array();
    foreach($mbMeaning->getTable() as $t){
      if($t['morpheme-B'] == "{$morphemeData['morpheme']['form']} {$morphemeData['morpheme']['meaning']}") $retarray['prefix'][] = $t;
      if($t['morpheme-A'] == "{$morphemeData['morpheme']['form']} {$morphemeData['morpheme']['meaning']}") $retarray['suffix'][] = $t;
    }
    return $retarray;
  }

  private static function getMeaningClassificationData($morphemeData){
    $ab = new Abbreviation;
    $listOfMeanings = $ab->parseMeaningFromMorphemeId($morphemeData['morpheme']['id']);
    $retarray = array();
    foreach($listOfMeanings as $row){
      $retarray[] = [
        'meaning' => $row,
        'explanation' => $ab->getAbbreviation($morphemeData['morpheme']['source'], $row),
        'classification' => $ab->getMeaningClassification($row)['classification']
      ];
    }
    return $retarray;
  }

  public static function load(){
    if (!isset($_GET['id'])){
      session::denyAccess(8);
    }
    $md = self::getMorphemeData();
    echo self::loadTemplate("/../MorphemeInfo/template.html.php", [
      'morphemeData' => $md,
      'unigram' => self::getMorphemeUnigramStats($md),
      'bigram' => self::getMeaningBigrams($md),
      'meanings' => self::getMeaningClassificationData($md)
    ]);

  }


}










 ?>
