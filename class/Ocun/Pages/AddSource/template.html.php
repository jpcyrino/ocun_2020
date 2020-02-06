<h1>Adicionar fonte de dados</h1>
<form action="index.php?page=AddSource" method="post">
  <div class="form-field">
    <p>Selecione a língua da fonte: </p>
    <select name="language" required>
      <?php foreach($languages as $language): ?>
        <option value="<?=$language['id']?>"><?=$language['name']?></option>
      <?php endforeach; ?>
    </select>
    <a href="?page=AddLanguage">Nova língua...</a>
  </div>
  <div class="form-field"><p>Título: </p><input type="text" name="name" required></div>
  <div class="form-field"><p>Autor: </p><input type="text" name="author" required></div>
  <div class="form-field"><p>Ano de Publicação: </p><input type="number" min=1500 name="year" required></div>
  <div class="form-field"><p>Editora: </p><input type="text" name="publisher" required></div>
  <div class="form-field"><input type="submit" value="Adicionar"></div>
</form>
