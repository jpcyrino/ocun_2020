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
    $meaningString = implode(".", array_unique(array_map('trim',$meaningArray)));
    return (array_values(array_unique(array_filter(preg_split('/(\.|\||\{|\}|\<|\>|\(|\)|\:|\+|\›|\‹)/', $meaningString)))));
  }

  public function listAbbreviations($source){
    return $this->queryList("SELECT * FROM `abbreviation` ORDER BY `abbreviation` ASC");
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
