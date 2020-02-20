
<?php if(isset($_GET['id'])):?>
  <h1>Editar Língua</h1>
  <form action="index.php?page=AddLanguage&id=<?=$_GET['id']?>" method="post">
    <div class="form-field"><p>Nome da Língua: </p><input type="text" name="name" value="<?=$language['name']?>" required></div>
    <div class="form-field"><p>Informações: </p><textarea name="info"><?=$language['information']?></textarea></p></div>
    <div class="form-field"><input type="submit" value="Adicionar"></div>
  </form>

<?php else: ?>
  <h1>Adicionar Língua</h1>
  <form action="index.php?page=AddLanguage" method="post">
    <div class="form-field"><p>Nome da Língua: </p><input type="text" name="name" required></div>
    <div class="form-field"><p>Informações: </p><textarea name="info"></textarea></p></div>
    <div class="form-field"><input type="submit" value="Adicionar"></div>
  </form>
<?php endif;?>
