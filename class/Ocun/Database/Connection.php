<?php
namespace Ocun\Database;
use Ocun\Exception\OcunException;
use PDO;
use PDOException;


class Connection{
  // Variável de conexão PDO
  protected $connection;

  // Instanciar OcunDataBase já abre uma conexão com o banco de Dados
  public function __construct(){
    $this->connect();
  }

  // Conecta ao Banco de Dados
  final protected function connect(){
    try{
      include __DIR__ . '/../../../conf/server.php';
      $this->connection = new PDO("mysql:host=localhost;dbname={$ocunDBName};charset=utf8", $username, $password);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // Enventualmente adicionar um log
    }
    catch(PDOException $e){
      OcunException::printException($e);
    }
  }

  // Retorna o vetor associativo (FETCH_ASSOC) com a consulta realizada
  final protected function query($sql) {
    try {
      return $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e){
      OcunException::printException($e);
    }
  }

}



 ?>
