<?php
namespace Ocun\Database\Linguistic;
use Ocun\Database\ConnectionUpdatable;

class Morpheme extends ConnectionUpdatable{


public function queryMorpheme($source, $form, $meaning){
  $sql = "SELECT * FROM `morpheme` WHERE `source` = {$source} AND `form` = '{$form}' AND `meaning` = '{$meaning}'";
  return $this->queryList($sql);
}

public function queryForm($source, $form){
  $sql = "SELECT * FROM `morpheme` WHERE `source` = {$source} AND `form` = '{$form}'";
  return $this->queryList($sql);
}

public function queryMeaning($source, $meaning){
  $sql = "SELECT * FROM `morpheme` WHERE `source` = {$source} AND `meaning` = '{$meaning}'";
  return $this->queryList($sql);
}

public function queryFromID($id){
  $sql = "SELECT * FROM `morpheme` WHERE `id` = {$id}";
  return $this->query($sql);
}

public function updateMorpheme($source, $form, $meaning, $new_form, $new_meaning){
  $sql = "UPDATE `morpheme` SET `form` = :form, `meaning` = :meaning WHERE `source` = {$source} AND `form` = '{$form}' AND `meaning` = '{$meaning}'";
  $this->execute($sql, [$new_form, $new_meaning]);
}




}



?>
