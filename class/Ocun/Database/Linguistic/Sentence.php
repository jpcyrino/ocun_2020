<?php
namespace Ocun\Database\Linguistic;
use Ocun\Database\Connection;

class Sentence extends Connection {

  public function morphemeList($source){
    $sql = <<<SQL
    SELECT `sentence`.`id` AS `sentence`,
    `morpheme`.`form` AS `form`,
    `morpheme`.`meaning` AS `meaning`,
    `morpheme`.`id` AS `id`,
    `sentence`.`translation` AS `translation`
    FROM `sentence`, `chain`, `morpheme`
    WHERE `sentence`.`source` = $source
    AND `chain`.`sentence` = `sentence`.`id`
    AND `chain`.`morpheme` = `morpheme`. `id`
    ORDER BY `sentence`.`id`, `chain`.`position`  ASC
SQL;
    return $this->queryList($sql);
  }

  public function morphemeListById($id){
    $sql = <<<SQL
    SELECT `sentence`.`id` AS `sentence`,
    `morpheme`.`form` AS `form`,
    `morpheme`.`meaning` AS `meaning`,
    `morpheme`.`id` AS `id`,
    `sentence`.`translation` AS `translation`
    FROM `sentence`, `chain`, `morpheme`
    WHERE `sentence`.`id` IN (SELECT `sentence` FROM `chain` WHERE `morpheme` = {$id})
    AND `chain`.`sentence` = `sentence`.`id`
    AND `chain`.`morpheme` = `morpheme`. `id`
    ORDER BY `sentence`.`id`, `chain`.`position`  ASC
SQL;
    return $this->queryList($sql);
  }

  public function morphemeListbySentence($source, $sentId){
    $sql = <<<SQL
    SELECT `sentence`.`id` AS `sentence`,
    `morpheme`.`form` AS `form`,
    `morpheme`.`meaning` AS `meaning`,
    `morpheme`.`id` AS `id`,
    `sentence`.`translation` AS `translation`
    FROM `sentence`, `chain`, `morpheme`
    WHERE `sentence`.`source` = $source
    AND `sentence`.`id` = $sentId
    AND `chain`.`sentence` = `sentence`.`id`
    AND `chain`.`morpheme` = `morpheme`. `id`
    ORDER BY `sentence`.`id`, `chain`.`position`  ASC
SQL;
    return $this->queryList($sql);
  }

  public function sentenceList($source){
    $list = array();
    $sentence = array();
    $pid = 0;
    foreach($this->morphemeList($source) as $row){
      if($row['sentence'] == $pid){
        $sentence[] = $row;
      } elseif($pid == 0) {
        $pid = $row['sentence'];
        $sentence[] = $row;
      } else {
        $list[] = $sentence;
        $sentence = array();
        $sentence[] = $row;
        $pid = $row['sentence'];
      }
    }
    $list[] = $sentence;
    return $list;
  }

  public function sentenceListByMorpheme($id){
    $list = array();
    $sentence = array();
    $pid = 0;
    foreach($this->morphemeListById($id) as $row){
      if($row['sentence'] == $pid){
        $sentence[] = $row;
      } elseif($pid == 0) {
        $pid = $row['sentence'];
        $sentence[] = $row;
      } else {
        $list[] = $sentence;
        $sentence = array();
        $sentence[] = $row;
        $pid = $row['sentence'];
      }
    }
    $list[] = $sentence;
    return $list;
  }

}


 ?>
