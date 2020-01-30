<?php
namespace Ocun\Database\Linguistic;
use Ocun\Database\ConnectionUpdatable;

class Cleanse extends ConnectionUpdatable {

  public function cleanMorphemes(){
    $sql = "DELETE FROM `morpheme` WHERE `id` NOT IN (SELECT `morpheme` FROM `chain`)";
    $this->execute($sql, []);
  }

  public function killSentence($id){
    $sql = "DELETE FROM `chain` WHERE `sentence` = :sentence";
    $this->execute($sql, [$id]);
    $sql = "DELETE FROM `sentence` WHERE `id` = :id";
    $this->execute($sql, [$id]);
    $this->cleanMorphemes();
  }


}


 ?>
