<h1>Consulta SQL</h1>
<form action="?page=SQLQuery" method="post">
  <div class="form-field">
    <input type="text" name="query">
    <input type="submit" name="submit" value="Enviar">
  </div>
</form>
<br>
<br>
<?php if(isset($result)): ?>
  <table style="border-style: solid; border-width: thin; padding: 10px; width: 100%;">
    <tr>
      <?php foreach(array_keys($result[0]) as $k): ?>
        <th><?=$k?></th>
      <?php endforeach;?>
    </tr>
    <?php foreach($result as $r): ?>
      <tr>
        <?php foreach($r as $d): ?>
          <td><?=$d?></td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach;?>
  </table>
<?php endif;?>
