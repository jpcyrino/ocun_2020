<?php
namespace Ocun\Database\Linguistic;
use Ocun\Database\ConnectionUpdatable;
use Ocun\Database\Linguistic\Cleanse;

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
  //Check if new morpheme exists:
  $sql = "SELECT `id` FROM `morpheme` WHERE `source` = {$source} AND `form` = '{$new_form}' AND `meaning` = '{$new_meaning}'";
  $res = $this->query($sql);
  if($res){
    $sql = "UPDATE `chain`
    SET `morpheme` = :id
    WHERE `morpheme`= (SELECT `id` FROM `morpheme` WHERE `source` = :source AND `form` = :form AND `meaning` = :meaning)";
    $this->execute($sql, [$res['id'], $source, $form, $meaning]);
    $cl = new Cleanse;
    $cl->cleanMorphemes();
    $_GET['id'] = $res['id'];
  } else{
    $sql = "UPDATE `morpheme` SET `form` = :form, `meaning` = :meaning WHERE `source` = {$source} AND `form` = '{$form}' AND `meaning` = '{$meaning}'";
    $this->execute($sql, [$new_form, $new_meaning]);
  }
}




}



?>
