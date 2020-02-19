<h1>Morfema #<?=$morphemeData['morpheme']['id']?> <div class="morpheme"><?=$morphemeData['morpheme']['form']?><br><?=$morphemeData['morpheme']['meaning']?></div></h1>
<h2>Dados probabilísticos</h2>
<br>
<table style="border-style: solid; border-width: thin; padding: 10px;">
  <tr>
    <th style="padding-left: 20px;"></th>
    <th style="padding-left: 20px;">Contagem</th>
    <th style="padding-left: 20px;">Probabilidade(P)</th>
    <th style="padding-left: 20px;">Complexidade(-logP)</th>
  </tr>
  <tr>
    <td style="padding-left: 20px;"><b>Morfema</b></td>
    <td style="padding-left: 20px;"><?=$unigram['morpheme']['count']?></td>
    <td style="padding-left: 20px;"><?=$unigram['morpheme']['P']?></td>
    <td style="padding-left: 20px;"><?=$unigram['morpheme']['logP']?></td>
  </tr>
  <tr>
    <td style="padding-left: 20px;"><b>Significado</b></td>
    <td style="padding-left: 20px;"><?=$unigram['meaning']['count']?></td>
    <td style="padding-left: 20px;"><?=$unigram['meaning']['P']?></td>
    <td style="padding-left: 20px;"><?=$unigram['meaning']['logP']?></td>
  </tr>
  <tr>
    <td style="padding-left: 20px;"><b>Forma</b></td>
    <td style="padding-left: 20px;"><?=$unigram['form']['count']?></td>
    <td style="padding-left: 20px;"><?=$unigram['form']['P']?></td>
    <td style="padding-left: 20px;"><?=$unigram['form']['logP']?></td>
  </tr>
</table>
<br>
<br>
<h2>Significados</h2>
<br>
<table style="border-style: solid; border-width: thin; padding: 10px;">
  <tr>
    <th style="padding-left: 20px;">Abreviatura</th>
    <th style="padding-left: 20px;">Significado</th>
    <th style="padding-left: 20px;">Classificação</th>
  </tr>
  <?php foreach($meanings as $m):?>
    <tr>
      <td style="padding-left: 20px;"><?=$m['meaning']?></td>
      <td style="padding-left: 20px;"><?=($m['explanation'] != NULL) ? $m['explanation'] : "não fornecido"?></td>
      <td style="padding-left: 20px;"><?=($m['classification'] != NULL) ? $m['classification'] : "não fornecido"?></td>
    </tr>
  <?php endforeach;?>
</table>
<br>
<br>
<?php if(count($morphemeData['allomorphs']) > 1): ?>
  <h2>Alomorfes</h2>
  <br>
  <p>
  <?php foreach($morphemeData['allomorphs'] as $al): ?>
    <div onclick="window.open('?page=MorphemeInfo&id=<?=$al['id']?>', '_blank')" class='morpheme'><?=$al['form']?><br><?=$al['meaning']?></div>
  <?php endforeach;?>
  </p>
  <br>
  <br>
<?php endif;?>
<?php if(count($morphemeData['homonyms']) > 1): ?>
  <h2>Homônimos</h2>
  <br>
  <p>
  <?php foreach($morphemeData['homonyms'] as $al): ?>
    <div onclick="window.open('?page=MorphemeInfo&id=<?=$al['id']?>', '_blank')" class='morpheme'><?=$al['form']?><br><?=$al['meaning']?></div>
  <?php endforeach;?>
  </p>
  <br>
  <br>
<?php endif;?>
<h2>Significados prefixais</h2>
<br>
<p>
<?php foreach($bigram['prefix'] as $p): ?>
  <div class="morpheme"><?=$p['meaning-A']?><br><?=$p['count']?><br><?=$p['logP A|B']?></div>
<?php endforeach; ?>
</p>
<br>
<br>
<h2>Significados sufixais</h2>
<br>
<p>
<?php foreach($bigram['suffix'] as $s): ?>
  <div class="morpheme"><?=$s['meaning-B']?><br><?=$s['count']?><br><?=$s['logP B|A']?></div>
<?php endforeach; ?>
<br>
<br>
