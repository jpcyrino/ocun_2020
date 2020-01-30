<?php
namespace Ocun\Bulk;
use Ocun\Database\Linguistic\DataFeeder;
use Ocun\Database\Linguistic\DataSplitter;

class BulkFeeder {

  private $log;
  private $dataFeeder;

  private function parse($feed){
    if(!BulkParser::parse($feed)){
      $this->log .= "ERRO: Impossível analisar dados. Número de linhas não é múltiplo de 3. <br>";
      return false;
    } else {
      return BulkParser::parse($feed);
    }
  }

  private function checkMorphemeNumbers($parsedFeed){
    if($parsedFeed){
      foreach($parsedFeed as $i => $datum){
        $this->log .= "Verificando dado {$i}: <br>";
        if(isset($datum['original'],$datum['gloss'],$datum['translation'])){
          $this->log .= "Dado {$i} íntegro. <br>";
          if(DataSplitter::parse($datum['original'], $datum['gloss'])){
            $this->log .= "Dado {$i} coerente. <br><br>";
            // adiciona dado ao array a ser armazenado.
            $result[] = $datum;
          } else {
            $this->log .= "Dado {$i} incoerente, retirado da lista. Verificar: <br>{$datum['original']}<br>{$datum['gloss']}<br>{$datum['translation']}<br><br>";
          }
        } else {
          $this->log .= "Dado {$i} não íntegro, retirado da lista. Verificar: <br>{$datum['original']}<br>{$datum['gloss']}<br>{$datum['translation']}<br><br>";
        }
      }
      return $result;
    } else {
      return false;
    }
  }

  private function storeData($checkedFeed){
    if($checkedFeed){
      $this->log .= "Dados prontos para inserção no banco. <br>";
      foreach($checkedFeed as $i => $datum){
        $this->dataFeeder->feed($datum['original'], $datum['gloss'], $datum['translation']);
        $this->log .= "Dado {$i} inserido. <br>";
      }
      return true;
    } else {
      return false;
    }
  }

  public function __construct(DataFeeder $dataFeeder){
    $this->dataFeeder = $dataFeeder;
  }

  public function feed($bulk){
    $result = $this->storeData($this->checkMorphemeNumbers($this->parse($bulk)));
    if($result){
      return "Sucesso com a inserção de dados! Log abaixo:  <br><br>" . $this->log;
    } else {
      return "Falha na inserção de dados. Conferir o log abaixo: <br><br>" . $this->log;
    }

  }

}




 ?>
