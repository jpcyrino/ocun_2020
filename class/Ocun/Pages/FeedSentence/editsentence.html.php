<h1>Editar Frase</h1>
<button style="width: 200px;" onclick='window.location.href="?page=FeedSentence&id=<?=$id?>"'>Voltar</button>
<br>
<br>
<form action="index.php?page=FeedSentence&id=<?=$id?>&sid=<?=$_GET['eid']?>" method="post">
  <div class="form-field"><p>Dado Original: </p><input id="ioriginal" onkeyup="validateFeed()" type='etext' name='eoriginal' value='<?=$original?>' required></div>
  <div class="form-field"><p>Glosa: </p><input id="igloss" type='text' onkeyup="validateFeed()" name='egloss' value='<?=$gloss?>' required></div>
  <div class="form-field"><p>Tradução </p><input id="itranslation" type='text' name='etranslation' value='<?=$translation?>' required></div>
  <div class="form-field">
    <input id="isend" type="submit" value="Salvar" disabled>
  </div>
</form>
<br>
<button style="width: 200px; background-color: red; float: right;" onclick='window.location.href="?page=FeedSentence&id=<?=$id?>&delete=<?=$_GET['eid']?>"'>Apagar Dado!</button>
<script>
validateFeed();

var encode = JSON.parse('<?=json_encode($encode)?>');

var separators = "<?=$separators?>".replace(",", "|");

</script>
