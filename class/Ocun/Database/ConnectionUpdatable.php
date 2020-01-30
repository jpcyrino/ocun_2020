<?php
namespace Ocun\Database;
use Ocun\Exception\OcunException;

class ConnectionUpdatable extends Connection {

  // Insere os dados no DB, retornando V no sucesso e F no fracasso
  final protected function execute($sql, $listOfFields) {
    preg_match_all('/:[a-zA-z]+/', $sql, $matches);
    if (sizeof($matches[0]) != sizeof($listOfFields)){
      return false;
    } else {
      try {
        $stmt = $this->connection->prepare($sql);
        for($i = 0; $i < sizeof($listOfFields); $i++){
          $stmt->bindValue($matches[0][$i], $listOfFields[$i]);
        }
        $stmt->execute();
        return true;
      }
      catch (PDOException $e){
        OcunException::printException($e);
        return false;
      }
    }
  }

}



 ?>
