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
      <td style="padding-left: 20px;"><?=($m['explanation'] != NULL) ? $m['explanation'] : (($m['classification'] != NULL) && ($m['classification'] != 'f') ? "raiz" : "não fornecido")?></td>
      <td style="padding-left: 20px;"><?=($m['classification'] != NULL) ? $m['classification'] : "não fornecido"?></td>
    </tr>
  <?php endforeach;?>
</table>
<br>
<br>
<?php if($morphemeUpdatable): ?>
  <h2>Atualizar Morfema</h2>
  <div class="form-field">
    <form action="?page=MorphemeInfo&id=<?=$_GET['id']?>" method="post">
      <p>Fonte: <input type="text" style="width: 100px;" name="source" value="<?=$morphemeData['morpheme']['source']?>" readonly>
      <p>Forma: <input type="text" style="width: 100px;" name="old_form" value="<?=$morphemeData['morpheme']['form']?>" readonly><input type="text" style="width: 100px;" name="form"></p>
      <p>Significado: <input type="text" style="width: 100px;" name="old_meaning" value="<?=$morphemeData['morpheme']['meaning']?>" readonly><input type="text" style="width: 100px;" name="meaning"></p>
      <p><input type="submit" value="Salvar"></p>
    </form>
  </div>
  <br>
  <br>
<?php endif;?>
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
<h2>Morfemas antecedentes</h2>
<br>
<p>
<?php foreach($bigram['prefix'] as $p): ?>
  <div class="morpheme">
    <table>
      <tr>
        <td><b>Forma: </b></td>
        <td></b><?=explode(" ", $p['morpheme-A'])[0]?></td>
      </tr>
      <tr>
        <td><b>Significado: </b></td>
        <td></b><?=explode(" ", $p['morpheme-A'])[1]?></td>
      </tr>
      <tr>
        <td><b>Contagem: </b></td>
        <td><?=$p['count']?></td>
      </tr>
      <tr>
        <td><b>-logP A|B: </b></td>
        <td><?=$p['logP A|B']?></td>
      </tr>
      <tr>
        <td><b>npmi:</b></td>
        <td><?=($unigram['morpheme']['logP'] - $p['logP A|B'])/$p['logP']?></td>
      </tr>
    </table>
  </div>
<?php endforeach; ?>
</p>
<br>
<br>
<h2>Morfemas sucessores</h2>
<br>
<p>
<?php foreach($bigram['suffix'] as $s): ?>
  <div class="morpheme">
    <table>
      <tr>
        <td><b>Forma: </b></td>
        <td></b><?=explode(" ", $s['morpheme-B'])[0]?></td>
      </tr>
      <tr>
        <td><b>Significado: </b></td>
        <td></b><?=explode(" ", $s['morpheme-B'])[1]?></td>
      </tr>
      <tr>
        <td><b>Contagem: </b></td>
        <td><?=$s['count']?></td>
      </tr>
      <tr>
        <td><b>-logP B|A: </b></td>
        <td><?=$s['logP B|A']?></td>
      </tr>
      <tr>
        <td><b>npmi:</b></td>
        <td><?=($unigram['morpheme']['logP'] - $s['logP B|A'])/$s['logP']?></td>
      </tr>
    </table>
  </div>
<?php endforeach; ?>
<br>
<br>
<h2>Frases com o Morfema</h2>
<p>Número de frases: <b><?=count($sentences)?></b></p>
<br>
<div style="height: 80vh; overflow: scroll;">
<?php foreach($sentences as $sent): ?>
  <div style="border-style: solid; border-width: thin; border-color: #0892d0; padding: 15px;">
  <p>
  <?php foreach($sent as $m): ?>
    <?php if($m['form'] == '_' && $m['meaning'] == "_"): ?>
      <div style="display: inline-block;">&nbsp;</div>
    <?php else:?>
      <div onclick="window.open('?page=MorphemeInfo&id=<?=$m['id']?>', '_blank')" class="morpheme" ><?=$m['form']?><br><?=$m['meaning']?></div>
    <?php endif;?>
  <?php endforeach;?>
  <br>
  <?php if(isset($sent[0])): ?>
    <p><?="\"". $sent[0]['translation'] . "\""?></p>
  <!--  <button onclick="Ajax('?page=SourceInfo&id=<?=$_GET['id']?>&ajax=sentenceBar&st=<?=$sent[0]['sentence']?>', sentenceBar)">Complexidade dos Bígramos</button> -->
  <?php endif;?>
  </p>
  </div>
  <div id="window-<?=$sent[0]['sentence']?>" style="display: none; border-style: solid; border-color: #0892d0; border-width: thin; padding: 10px;"></div>
<br>
<?php endforeach;?>
</div>
