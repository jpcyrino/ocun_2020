<?php
namespace Ocun\Database\Linguistic;
use Ocun\Database\ConnectionUpdatable;
use PDO;
use PDOException;

Class Source extends ConnectionUpdatable{

  public function store($array){
    $sql = "INSERT IGNORE INTO `source` SET `language` = :language, `name` = :name, `author` = :author, `year` = :year, `publisher` = :publisher";
    return $this->execute($sql, $array);
  }

  public function updateLicense($id, $license, $url){
    $sql = "UPDATE `source` SET `license` = :license, `url` = :url WHERE `id` = {$id}";
    return $this->execute($sql, [$license, $url]);
  }

  public function updateSeparators($id, $separators){
    $sql = "UPDATE `source` SET `separators` = :separators WHERE `id` = {$id}";
    return $this->execute($sql, [$separators]);
  }

  public function loadList(){
    try {
      $sql = "SELECT * FROM `source`";
      return $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
      OcunException::printException($e);
      return false;
    }
  }

}
