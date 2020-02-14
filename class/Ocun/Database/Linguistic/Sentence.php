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
    ORDER BY `sentence`.`id` ASC
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

}


 ?>
