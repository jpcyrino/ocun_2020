<?php
namespace Ocun\Database\Linguistic;
use Ocun\Database\ConnectionUpdatable;

class DataFeeder extends ConnectionUpdatable{

  private $source;

  private function storeMorpheme($morpheme){
    $sql = "INSERT IGNORE INTO `morpheme` SET `source` = :source, `form` = :form, `meaning` = :meaning";
    $this->execute($sql, [$this->source, $morpheme['form'], $morpheme['meaning']]);
    return $this->query("SELECT `id` FROM `morpheme` WHERE `source` = {$this->source}
      AND `form` = '{$morpheme['form']}' AND `meaning` = '{$morpheme['meaning']}'")['id'];
  }

  private function storeMorphemes($morphemes){
    $morphemeIdChain = [];
    foreach($morphemes as $morpheme){
      $morphemeIdChain[] = $this->storeMorpheme($morpheme);
    }
    return $morphemeIdChain;
  }

  private function storeSentence($languageData, $translation){
    $sql = "INSERT IGNORE INTO `sentence` SET `source` = :source, `original` = :original, `translation` = :translation";
    $this->execute($sql, [$this->source, $languageData, $translation]);
    return $this->query("SELECT `id` FROM `sentence` WHERE `source` = {$this->source}
      AND `original` = '{$languageData}' AND `translation` = '{$translation}'")['id'];
  }

  private function storeChain($chain, $sentenceId){
    foreach($chain as $i => $morpheme){
      $sql = "INSERT IGNORE INTO `chain` SET `sentence` = :sentence, `position` = :position, `morpheme` = :morpheme";
      $this->execute($sql, [$sentenceId, $i, $morpheme]);
    }
  }

  public function __construct(int $source){
    $this->source = $source;
    $this->connect();
  }

  public function feed(string $languageData, string $glossData, string $translation){
    $morphemes = DataSplitter::parse($languageData, $glossData);
    if ($morphemes){
      $this->storeChain($this->storeMorphemes($morphemes),$this->storeSentence($languageData, $translation));
    }
    // adicionar condição else para jogar exceção... 
  }


}




 ?>
