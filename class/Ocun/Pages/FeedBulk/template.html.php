
<h1>Adicionar Dados em Massa</h1>
<form action="index.php?page=FeedBulk" method="post">
  <div class="form-field">
    <p>Selecione a fonte:
    <select style="width: 400px;"name="source" required>
      <?php foreach($sources as $source): ?>
        <option value="<?=$source['id']?>"><?=$source['name']?></option>
      <?php endforeach; ?>
    </select>
    <input style="margin-left: 10px; max-width: 10px;" type='checkbox' name="confirm" value="ok" required>
    <label for="confirm">Confirmo escolha da fonte</label>
  </p>
  </div>
  <div class="form-field"><p>Cole os dados: </p><textarea id="bulk-box" name="bulk" required></textarea></div>
  <div class="form-field"><p>Preparar texto:</p><input type="button" onclick="separatorEqual()" value="'=' como separador"></div>
  <div class="form-field"><p>Adicionar dados ao banco:</p> <input type="submit" value="Concluir"></div>
</form>
<?php if($status != ""): ?>
  <br>
  <br>
  <div class="status"><?=$status?></div>
<?php endif;?>
