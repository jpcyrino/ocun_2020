<?php
namespace Ocun\Database\Linguistic;
use PDO;
use PDOException;
use Ocun\Database\ConnectionUpdatable;

class Encode extends ConnectionUpdatable{

  public function store($array){
    $sql = "INSERT IGNORE INTO `encode` SET `source` = :source, `input` = :input, `output` = :output";
    return $this->execute($sql, $array);
  }

  public function update($id, $input, $output){
    $sql = "UPDATE `encode` SET `input` = :input, `output` = :output WHERE `id` = {$id}";
    return $this->execute($sql, [$input, $output]);
  }

  public function loadList($source){
    try {
      $sql = "SELECT * FROM `encode` WHERE `source` = {$source}";
      return $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
      OcunException::printException($e);
      return false;
    }
  }
}






 ?>
