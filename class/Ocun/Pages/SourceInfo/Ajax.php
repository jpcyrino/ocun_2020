<?php

namespace Ocun\Pages\SourceInfo;
use Ocun\Database\User\Session;
use Ocun\Database\Linguistic\Sentence;
use Ocun\Database\Linguistic\Source;
use Ocun\Statistics\Probability\MorphemeUnigram;
use Ocun\Statistics\Probability\MorphemeBigram;

Class Ajax {


// Unigram methods

    public static function ajax_tableMorpheme(){
      self::ajaxTable("Frequência dos Morfemas", 'morpheme', 'Morfema');
    }

    public static function ajax_tableMeaning(){
      self::ajaxTable("Frequência dos Significados", 'meaning', 'Significado');
    }

    public static function ajax_tableForm(){
      self::ajaxTable("Frequência das Formas", 'form', 'Forma');
    }

  public static function ajax_hLogP(){
    $ml = new Sentence;
    $muMorpheme = new MorphemeUnigram($ml->morphemeList($_GET['id']), 'morpheme');
    $muMeaning = new MorphemeUnigram($ml->morphemeList($_GET['id']), 'meaning');
    $muForm = new MorphemeUnigram($ml->morphemeList($_GET['id']), 'form');
    echo json_encode([
      'title' => 'Complexidade dos Morfemas',
      'labelx' => '-logP',
      'labely' => 'Quantidade',
      'morpheme' => $muMorpheme->getPlotLyObject('histogramLogP',0.5,'blue'),
      'meaning' => $muMeaning->getPlotLyObject('histogramLogP', 0.5, 'red'),
      'form' => $muForm->getPlotLyObject('histogramLogP', 0.5, 'green')
    ]);
  }

  public static function ajax_hP(){
    $ml = new Sentence;
    $muMorpheme = new MorphemeUnigram($ml->morphemeList($_GET['id']), 'morpheme');
    $muMeaning = new MorphemeUnigram($ml->morphemeList($_GET['id']), 'meaning');
    $muForm = new MorphemeUnigram($ml->morphemeList($_GET['id']), 'form');
    echo json_encode([
      'title' => 'Probabilidade dos Morfemas',
      'labelx' => 'P',
      'labely' => 'Quantidade/1000',
      'morpheme' => $muMorpheme->getPlotLyObject('histogramP',0.5,'blue'),
      'meaning' => $muMeaning->getPlotLyObject('histogramP', 0.5, 'red'),
      'form' => $muForm->getPlotLyObject('histogramP', 0.5, 'green')
    ]);
  }

  private static function ajaxTable($title, $object, $objectTitle){
    $ml = new Sentence;
    $muMorpheme = new MorphemeUnigram($ml->morphemeList($_GET['id']), $object);
    echo json_encode([
      'title' => $title,
      'morpheme' => [
        'type' => 'table',
        'header' => [
            'values' => $object == 'morpheme' ? [["<b>Forma</br>"],["<b>Significado</br>"], ['<b>Quantidade</b>'], ['<b>Probabilidade</b>'], ['<b>-logP</b>']] : [["<b>{$objectTitle}</br>"], ['<b>Quantidade</b>'], ['<b>Probabilidade</b>'], ['<b>-logP</b>']],
            'align' => 'center'
          ],
        'cells' => [
            'values' => $muMorpheme->getTable(),
            'align' => 'center'
        ]
      ]
    ]);
  }

//Bigram methods
public static function ajax_sentenceBar(){
  $ml = new Sentence;
  $mbMorpheme = new MorphemeBigram($ml->morphemeList($_GET['id']), 'morpheme');
  $mbMeaning = new MorphemeBigram($ml->morphemeList($_GET['id']), 'meaning');
  $mbForm = new MorphemeBigram($ml->morphemeList($_GET['id']), 'form');
  $chain = $ml->morphemeListbySentence($_GET['id'], $_GET['st']);
  echo json_encode([
    'window' => 'window-'.$_GET['st'],
    'data' => [
        'title' => 'Complexidade dos Bígramos na Frase',
        'labelx' => 'Morfema',
        'labely' => '-logP',
        'morpheme' => $mbMorpheme->getPlotLyObject('sentenceBar', $chain),
        'meaning' => $mbMeaning->getPlotLyObject('sentenceBar', $chain),
        'form' => $mbForm->getPlotLyObject('sentenceBar', $chain)
    ]]);
}

}



 ?>
