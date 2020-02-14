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

  public function storeAccess($language, $name){
    foreach($this->loadList() as $row){
      if($row['language'] == $language && $row['name'] == $name){
        $id = $row['id'];
        break;
      }
    }
    $sql = "INSERT INTO `source_access` SET `source` = {$id}, `user` = {$_SESSION['id']}";
    return $this->execute($sql, []);
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
      $sql = "SELECT * FROM `source` ORDER BY `name` ASC";
      return $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
      OcunException::printException($e);
      return false;
    }
  }

  public function getInfo($id){
    $sql = "SELECT *, `source`.`name` AS `title` FROM `source`, `language` WHERE `language`.`id` = `source`.`language` AND `source`.`id` = {$id}";
    return $this->query($sql);
  }

  public function loadListAccess(){
    if($_SESSION['level'] > 4){
      return $this->loadList();
    } else {
      try {
        $sql = "SELECT * FROM `source` WHERE `id` IN (SELECT `source` FROM `source_access` WHERE `user` = {$_SESSION['id']})";
        return $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e){
        OcunException::printException($e);
        return false;
      }
    }
  }

}
