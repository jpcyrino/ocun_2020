<?php
namespace Ocun\Database\Linguistic;
use Ocun\Database\Source;
use Ocun\Database\ConnectionUpdatable;

class Abbreviation extends ConnectionUpdatable{

  public function parseMeanings($source){
    $meaningArray = array();
    foreach($this->queryList("SELECT DISTINCT `meaning` FROM `morpheme` WHERE `source` = {$source}") as $row){
      $meaningArray[] = $row['meaning'];
    }
    $meaningString = html_entity_decode(implode(".", array_unique(array_map('trim',$meaningArray))), ENT_QUOTES, 'UTF-8');
    return (array_values(array_unique(array_filter(preg_split('/(\.|\{|\}|\<|\>|\(|\)|\:|\+|\›|\‹)/', $meaningString)))));
  }

  public function parseMeaningFromMorphemeId($id){
    $meaningArray = array();
    foreach($this->queryList("SELECT DISTINCT `meaning` FROM `morpheme` WHERE `id` = {$id}") as $row){
      $meaningArray[] = $row['meaning'];
    }
    $meaningString = html_entity_decode(implode(".", array_unique(array_map('trim',$meaningArray))), ENT_QUOTES, 'UTF-8');
    return (array_values(array_unique(array_filter(preg_split('/(\.|\{|\}|\<|\>|\(|\)|\:|\+|\›|\‹)/', $meaningString)))));
  }


  public function storeMeaningClassification($meaning, $classification){
    $sql = "INSERT INTO `meaning_classification` SET `meaning` = :meaning, `classification` = :classification ON DUPLICATE KEY UPDATE `classification` = :classification";
    $this->execute($sql, [$meaning, $classification, $classification]);
  }

  public function getMeaningClassification($meaning){
  //  $sql = "SELECT `classification` FROM `meaning_classification`WHERE `source` = {$source} AND `meaning` = '{$meaning}'";
    $sql = "SELECT `classification` FROM `meaning_classification`WHERE `meaning` = '{$meaning}'";
    return $this->query($sql);
  }

  public function listAbbreviations($source){
    return $this->queryList("SELECT * FROM `abbreviation` WHERE `source` = {$source} ORDER BY `abbreviation` ASC");
  }

  public function getAbbreviation($source, $abb){
    return $this->query("SELECT `meaning` FROM `abbreviation` WHERE `source` = {$source} AND `abbreviation` = '{$abb}'")['meaning'];
  }

  public function updateAbbreviation($id, $abbreviation, $meaning){
    $sql = "UPDATE `abbreviation` SET `abbreviation` = :abbreviation, `meaning` = :meaning WHERE `id` = {$id}";
    $this->execute($sql, [$abbreviation, $meaning]);

  }

  public function storeAbbreviation($source, $abbreviation, $meaning){
    $sql = "INSERT IGNORE INTO `abbreviation` SET `source` = :source, `abbreviation` = :abbreviation, `meaning` = :meaning";
    $this->execute($sql, [$source, $abbreviation, $meaning]);
  }




}








 ?>
