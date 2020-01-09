<?php
class OcunDataBase{
  // Variável de conexão PDO
  private $connection;

  // Instanciar OcunDataBase já abre uma conexão com o banco de Dados
  final public function __construct(){
    $this->connect();
  }

  // Conecta ao Banco de Dados
  final private function connect(){
    try{
      include __DIR__ . '/../conf/server.php';
      $connection = new PDO("mysql:host=localhost;dbname=" . $this->$ocunDBName, $this->username, $this->password);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // Enventualmente adicionar um log
    }
    catch(PDOException $e){
      OcunException::printException($e);
    }
  }

  // Insere os dados no DB, retornando V no sucesso e F no fracasso
  final private function insert($sql, $listOfFields) {
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

  // Retorna o vetor associativo (FETCH_ASSOC) com a consulta realizada
  final public function query($sql) {
    try {
      return $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e){
      OcunException::printException($e);
    }
  }




}



 ?>
