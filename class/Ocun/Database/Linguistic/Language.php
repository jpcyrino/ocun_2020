<?php
namespace Ocun\Database\Linguistic;
use Ocun\Database\ConnectionUpdatable;
use PDO;
use PDOException;

Class Language extends ConnectionUpdatable{

  public function store($array){

    $sql = "INSERT IGNORE INTO `language` SET `name` = :name, `information` = :info
    ON DUPLICATE KEY UPDATE `name` = :name, `information` = :info";
    return $this->execute($sql, [$array[0], $array[1], $array[0], $array[1]]);
  }

  public function loadInfo($id){
    $sql = "SELECT * FROM `language` WHERE `id` = {$id}";
    return $this->query($sql);
  }

  public function loadList(){
    try {
      $sql = "SELECT * FROM `language` ORDER BY `name` ASC";
      return $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
      OcunException::printException($e);
      return false;
    }
  }

}
