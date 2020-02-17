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
      'morpheme' => $muMorpheme->getPlotLyObject('histogramLogP', null, 0.5,'blue'),
      'meaning' => $muMeaning->getPlotLyObject('histogramLogP', null, 0.5, 'red'),
      'form' => $muForm->getPlotLyObject('histogramLogP', null, 0.5, 'green')
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
      'morpheme' => $muMorpheme->getPlotLyObject('histogramP', null, 0.5,'blue'),
      'meaning' => $muMeaning->getPlotLyObject('histogramP', null,  0.5, 'red'),
      'form' => $muForm->getPlotLyObject('histogramP',null, 0.5, 'green')
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

  public static function ajax_sentenceLogP(){
    $ml = new Sentence;
    $muMorpheme = new MorphemeUnigram($ml->morphemeList($_GET['id']), 'morpheme');
    $muMeaning = new MorphemeUnigram($ml->morphemeList($_GET['id']), 'meaning');
    $muForm = new MorphemeUnigram($ml->morphemeList($_GET['id']), 'form');
    $chain = $ml->morphemeListbySentence($_GET['id'], $_GET['st']);
    echo json_encode([
      'window' => 'window-'.$_GET['st'],
      'data' => [
          'title' => 'Complexidade -logP(n)',
          'labelx' => 'n',
          'labely' => '-logP',
          'morpheme' => $muMorpheme->getPlotLyObject('sentenceLogP', $chain),
          'meaning' => $muMeaning->getPlotLyObject('sentenceLogP', $chain),
          'form' => $muForm->getPlotLyObject('sentenceLogP', $chain)
      ]]);
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
        'title' => 'Análise -logP(n|n-1)',
        'labelx' => 'n|n-1',
        'labely' => '-logP',
        'morpheme' => $mbMorpheme->getPlotLyObject('sentenceBar', $chain),
        'meaning' => $mbMeaning->getPlotLyObject('sentenceBar', $chain),
        'form' => $mbForm->getPlotLyObject('sentenceBar', $chain)
    ]]);
}

public static function ajax_inverseSentenceBar(){
  $ml = new Sentence;
  $mbMorpheme = new MorphemeBigram($ml->morphemeList($_GET['id']), 'morpheme');
  $mbMeaning = new MorphemeBigram($ml->morphemeList($_GET['id']), 'meaning');
  $mbForm = new MorphemeBigram($ml->morphemeList($_GET['id']), 'form');
  $chain = $ml->morphemeListbySentence($_GET['id'], $_GET['st']);
  echo json_encode([
    'window' => 'window-'.$_GET['st'],
    'data' => [
        'title' => 'Análise -logP(n-1|n)',
        'labelx' => 'n-1|n',
        'labely' => '-logP',
        'morpheme' => $mbMorpheme->getPlotLyObject('inverseSentenceBar', $chain),
        'meaning' => $mbMeaning->getPlotLyObject('inverseSentenceBar', $chain),
        'form' => $mbForm->getPlotLyObject('inverseSentenceBar', $chain)
    ]]);
}

public static function ajax_mutualMeaning(){
  $ml = new Sentence;
  $mb = new MorphemeBigram($ml->morphemeList($_GET['id']), 'meaning');
  $chain = $ml->morphemeListbySentence($_GET['id'], $_GET['st']);
  echo json_encode([
    'window' => 'window-'.$_GET['st'],
    'data' => [
        'title' => 'Análise de Complexidade Mútua por Significado',
        'labelx' => 'n-1|n vs n|n-1',
        'labely' => '-logP',
        'plotBA' => $mb->getPlotLyObject('SentenceBar', $chain),
        'plotAB' => $mb->getPlotLyObject('inverseSentenceBar', $chain),
    ]]);
}

public static function ajax_mutualForm(){
  $ml = new Sentence;
  $mb = new MorphemeBigram($ml->morphemeList($_GET['id']), 'form');
  $chain = $ml->morphemeListbySentence($_GET['id'], $_GET['st']);
  echo json_encode([
    'window' => 'window-'.$_GET['st'],
    'data' => [
        'title' => 'Análise de Complexidade Mútua por Forma',
        'labelx' => 'n-1|n vs n|n-1',
        'labely' => '-logP',
        'plotBA' => $mb->getPlotLyObject('SentenceBar', $chain),
        'plotAB' => $mb->getPlotLyObject('inverseSentenceBar', $chain),
    ]]);
}

public static function ajax_mutualMorpheme(){
  $ml = new Sentence;
  $mb = new MorphemeBigram($ml->morphemeList($_GET['id']), 'morpheme');
  $chain = $ml->morphemeListbySentence($_GET['id'], $_GET['st']);
  echo json_encode([
    'window' => 'window-'.$_GET['st'],
    'data' => [
        'title' => 'Análise de Complexidade Mútua por Morfema',
        'labelx' => 'n-1|n vs n|n-1',
        'labely' => '-logP',
        'plotBA' => $mb->getPlotLyObject('SentenceBar', $chain),
        'plotAB' => $mb->getPlotLyObject('inverseSentenceBar', $chain),
    ]]);
}

public static function ajax_nBAMeaning(){
  $ml = new Sentence;
  $mu = new MorphemeUnigram($ml->morphemeList($_GET['id']), 'meaning');
  $mb = new MorphemeBigram($ml->morphemeList($_GET['id']), 'meaning');
  $chain = $ml->morphemeListbySentence($_GET['id'], $_GET['st']);
  echo json_encode([
    'window' => 'window-'.$_GET['st'],
    'data' => [
        'title' => 'Significado logP(n) vs logP(n|n-1)',
        'labelx' => 'n vs n|n-1',
        'labely' => '-logP',
        'n' => $mu->getPlotLyObject('sentenceLogP', $chain),
        'nGivenNMinusOne' => $mb->getPlotLyObject('SentenceBar', $chain),
    ]]);
}

public static function ajax_nBAForm(){
  $ml = new Sentence;
  $mu = new MorphemeUnigram($ml->morphemeList($_GET['id']), 'form');
  $mb = new MorphemeBigram($ml->morphemeList($_GET['id']), 'form');
  $chain = $ml->morphemeListbySentence($_GET['id'], $_GET['st']);
  echo json_encode([
    'window' => 'window-'.$_GET['st'],
    'data' => [
        'title' => 'Forma logP(n) vs logP(n|n-1)',
        'labelx' => 'n vs n|n-1',
        'labely' => '-logP',
        'n' => $mu->getPlotLyObject('sentenceLogP', $chain),
        'nGivenNMinusOne' => $mb->getPlotLyObject('SentenceBar', $chain),
    ]]);
}

public static function ajax_nBAMorpheme(){
  $ml = new Sentence;
  $mu = new MorphemeUnigram($ml->morphemeList($_GET['id']), 'morpheme');
  $mb = new MorphemeBigram($ml->morphemeList($_GET['id']), 'morpheme');
  $chain = $ml->morphemeListbySentence($_GET['id'], $_GET['st']);
  echo json_encode([
    'window' => 'window-'.$_GET['st'],
    'data' => [
        'title' => 'Morfema logP(n) vs logP(n|n-1)',
        'labelx' => 'n vs n|n-1',
        'labely' => '-logP',
        'n' => $mu->getPlotLyObject('sentenceLogP', $chain),
        'nGivenNMinusOne' => $mb->getPlotLyObject('SentenceBar', $chain),
    ]]);
}

}



 ?>
