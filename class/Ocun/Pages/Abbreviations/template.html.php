<h1>Gerenciar Abreviaturas</h1>
<br>
<button onclick="window.location.href = '?page=SourcePreferences&id=<?=$id?>'">Voltar</button>
<br>
<br>
<form>
  <h2>Fonte:</h2>
  <p><b>Nome: </b><?=$source?></p>
  <p><b>Língua: </b><?=$language?></p>
  <p><b><a href="#abrev">Gerenciar Abreviaturas</a>&nbsp;<a href="#classif">Classificar Significados</a></b></p>
</form>

<br>
<br>

<h2 id="abrev">Adicionar abreviatura</h2>
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
<?php endif;?>

<br>
<br>
<h2 id="classif">Classificar Significados da fonte</h2>
<br>
<p> Classificar em funcional, evento, propriedade e entidade.</p>
<br>
<h3>Significados a partir do número:<br>
<?php for($i = 0; $i<count($meanings); $i+=20):?>
  <a href="index.php?page=Abbreviations&id=<?=$id?>&language=<?=$language?>&source=<?=$source?>&tier=<?=$i?>#classif"><?=$i?></a>&nbsp;
<?php endfor;?>
</h3>
<br>
<form action="index.php?page=Abbreviations&id=<?=$id?>&language=<?=$language?>&source=<?=$source?>" method="post">
<?php foreach($meanings as $k => $m):?>
  <?php $tier = isset($_GET['tier']) ? $_GET['tier'] : 0;?>
  <?php if($k >= $tier && $k < $tier+20): ?>
  <div class="form-field">
    <p>
      <b>#<?=$k?></b>&nbsp;
      Significado:
      <input style="width: 100px;" type="text" name="sig[]" value="<?=$m[0]?>" readonly>
      Classificação:
      <select style="width: 400px;"name="classif[]">
        <option value="<?=$m[2]?>" selected><?=$m[1]?></option>
        <option value="f">Funcional</option>
        <option value="e">Evento</option>
        <option value="p">Propriedade</option>
        <option value="t">Entidade</option>
      </select>
      <input type="submit" name="submit" value="Salvar">
    </p>
  </div>
  <?php endif;?>
<?php endforeach;?>
</form>
