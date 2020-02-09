<h1>Gerenciar Abreviaturas</h1>
<br>
<button onclick="window.location.href = '?page=SourcePreferences&id=<?=$id?>'">Voltar</button>
<br>
<br>
<form>
  <h2>Fonte:</h2>
  <p><b>Nome: </b><?=$source?></p>
  <p><b>Língua: </b><?=$language?></p>
</form>

<br>
<br>

<h2>Adicionar abreviatura</h2>
<form action="index.php?page=Abbreviations&id=<?=$id?>&language=<?=$language?>&source=<?=$source?>" method="post">
  <div class="form-field">
    <p>
      <input style="width: 120px;" type="text" name="abbreviation" placeholder="abreviatura">
      <input style="width: 400px;" type="text" name="meaning" placeholder="significado">
      <input type="submit" name="submit" value="Salvar">
    </p>
  </div>
</form>

<br>
<br>

<?php if(count($abbvs) > 0): ?>
  <h2>Editar abreviaturas</h2>
  <br>
  <form action="index.php?page=Abbreviations&id=<?=$id?>&language=<?=$language?>&source=<?=$source?>" method="post">
  <?php foreach($abbvs as $row): ?>
      <div class="form-field">
        <p>
          Id:
          <input style="width: 50px;" type="text" name="abid[]" value="<?=$row['id']?>" readonly>
          Abreviatura:
          <input style="width: 120px;" type="text" name="eabbreviation[]" value="<?=$row['abbreviation']?>" placeholder="abreviatura">
          Significado:
          <input style="width: 400px;" type="text" name="emeaning[]" value="<?=$row['meaning']?>" placeholder="significado">
          <input type="submit" name="submit" value="Atualizar">
        </p>
      </div>
  <?php endforeach;?>
  </form>
<?php endif;?>

<br>
<br>

<h2>Adicionar abreviatura</h2>
<form action="index.php?page=Abbreviations&id=<?=$id?>&language=<?=$language?>&source=<?=$source?>" method="post">
  <div class="form-field">
    <p>
      <input style="width: 120px;" type="text" name="abbreviation" placeholder="abreviatura">
      <input style="width: 400px;" type="text" name="meaning" placeholder="significado">
      <input type="submit" name="submit" value="Salvar">
    </p>
  </div>
</form>
