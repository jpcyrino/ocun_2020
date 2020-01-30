<?php
namespace Ocun\Bulk;

class BulkParser {

  public static function parse($bulk){
    // Cada linha do string $bulk é um elemento diferente no array;
    $processed = array_diff(explode("\n", $bulk), ["", " "]);
    // Array deve ser múltiplo de 3 (2 linhas de dados, 1 de tradução)
    if ((count($processed) % 3) == 0){
      // Loopar a cada 3 linhas (conjunto de dados)
      for($i=0;$i<count($processed);$i+=3){
        $result[] = [
          'original' => $processed[$i],
          'gloss' => $processed[$i+1],
          'translation' => $processed[$i+2]
        ];
      }
      return $result;
    } else {
      return false; // Retorna falso caso o array não seja multiplo de 3
    }
  }

}

 ?>
