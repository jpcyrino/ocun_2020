<h1>Inserir Frase</h1>
<br>
<button onclick="window.location.href = '?page=SourceMenu'">Voltar</button>
<br>
<br>
<form action="index.php?page=FeedSentence&id=<?=$id?>" method="post">
  <div class="form-field"><p>Dado Original: </p><input id="ioriginal" onkeyup="validateFeed()" type='etext' name='ioriginal' required></div>
  <div class="form-field"><p>Glosa: </p><input id="igloss" type='text' onkeyup="validateFeed()" name='igloss' required></div>
  <div class="form-field"><p>Tradução </p><input id="itranslation" type='text' name='itranslation' required></div>
  <div class="form-field">
    <input id="isend" type="submit" value="Salvar" disabled>
  </div>
</form>
<br>
<br>
<h1>Editar Frase</h1>
<p>Clique em uma das frases abaixo para alterá-la: </p>
<br>
<?php foreach($sentences as $sent): ?>
  <div class="sentence-editable" onclick="window.location.href = '?page=FeedSentence&id=<?=$id?>&eid=<?=$sent[0]['sentence']?>'">
  <p>
  <?php foreach($sent as $m): ?>
    <?php if($m['form'] == '_' && $m['meaning'] == "_"): ?>
      <div style="display: inline-block;">&nbsp;</div>
    <?php else:?>
      <div style="display: inline-block; border-style: solid; border-width: thin; padding: 5px;"><?=$m['form']?><br><?=$m['meaning']?></div>
    <?php endif;?>
  <?php endforeach;?>
  <br>
  <?php if(isset($sent[0])): ?>
    <?="\"". $sent[0]['translation'] . "\""?>
  <?php endif;?>
  </p>
</div>
<br>
<?php endforeach;?>

<script>
validateFeed();

var encode = JSON.parse('<?=json_encode($encode)?>');

var separators = "<?=$separators?>".replace(",", "|");

</script>
