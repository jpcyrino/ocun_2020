<?php
namespace Ocun\Database\Linguistic;
use Ocun\Database\ConnectionUpdatable;
use PDO;
use PDOException;

Class Language extends ConnectionUpdatable{

  public function store($array){
    $sql = "INSERT IGNORE INTO `language` SET `name` = :name";
    return $this->execute($sql, $array);
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
