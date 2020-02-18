<?php
namespace Ocun\Database\Linguistic;
use Ocun\Database\ConnectionUpdatable;

class Morpheme extends ConnectionUpdatable{


public function queryMorpheme($source, $form, $meaning){
  $sql = "SELECT * FROM `morpheme` WHERE `source` = {$source} AND `form` = '{$form}' AND `meaning` = '{$meaning}'";
  $this->queryList($sql);
}

public function queryForm($source, $form){
  $sql = "SELECT * FROM `morpheme` WHERE `source` = {$source} AND `form` = '{$form}'";
  $this->queryList($sql);
}

public function queryMeaning($source, $meaning){
  $sql = "SELECT * FROM `morpheme` WHERE `source` = {$source} AND `form` = '{$form}' AND `meaning` = '{$meaning}'";
  $this->queryList($sql);
}

public function updateMorpheme($source, $form, $meaning, $new_form, $new_meaning){
  $sql = "UPDATE `morpheme` SET `form` = :form, `meaning` = :meaning WHERE `source` = {$source} AND `form` = '{$form}' AND `meaning` = '{$meaning}'";
  $this->execute($sql, [$new_form, $new_meaning]);
}




}



?>
