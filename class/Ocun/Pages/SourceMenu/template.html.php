<h1>Fontes de Dados</h1>
<p>Abaixo estão relacionadas as fontes de dados a que se pode ter acesso no momento. Você também pode <a href="?page=AddSource">criar uma fonte</a>.</p>
<br>
<br>
<table style="border-style: solid; border-width: thin; padding: 10px;">
  <tr>
    <th>Nome</th>
    <th>Autor, Ano</th>
  </tr>
  <?php foreach($sources as $source): ?>
    <tr>
      <td style="padding-right: 20px;"><b><?=$source['name']?></b></td>
      <td style="padding-left: 20px; padding-right: 20px;"><?=$source['author']?>,<?=$source['year']?></td>
      <td><a href="?page=FeedSentence%id=<?=$source['id']?>"><i class="material-icons">add_box</i>Adicionar Dados</a></td>
      <td><a href="?page=SourcePreferences&id=<?=$source['id']?>"><i class="material-icons">build</i>Preferências</a></td>
    </tr>
  <?php endforeach;?>
  <tr>
    <td><a href="?page=AddSource"><i class="material-icons">create_new_folder</i>Nova fonte...</a></td>
  </tr>
</table>
