<?php
class OcunDataBase{
  // Variáveis para conexão no DB. Alterar no servidor vs local
  private $ocunDBName = "ocun_0_3";
  private $username = "username";
  private $password = "password";
  // Variável de conexão PDO
  private $connection;

  // Instanciar OcunDataBase já abre uma conexão com o banco de Dados
  public function __construct(){
    $this->connect();
  }

  // Conecta ao Banco de Dados
  private function connect(){
    try{
      $connection = new PDO("mysql:host=localhost;dbname=" . $this->$ocunDBName, $this->username, $this->password);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // Enventualmente adicionar um log
    }
    catch(PDOException $e){
      OcunException::printException($e);
    }
  }

  // Insere os dados no DB, retornando V no sucesso e F no fracasso
  public function insert($sql, $listOfFields) {
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
        OcunException::printException($e)
        return false;
      }
    }
  }




}



 ?>
