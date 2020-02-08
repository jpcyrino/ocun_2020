<h1>Fontes de Dados</h1>
<p>Abaixo estão relacionadas as fontes de dados a que se pode ter acesso no momento. Você também pode <a href="?page=AddSource"><b>criar uma fonte</b></a>.</p>
<br>
<p><b>Legenda: </b></p>
<ul>
  <li><i class="material-icons">create</i>: Editar dados</p></li>
  <li><i class="material-icons">build</i>: Preferências da fonte</p></li>
</ul>

<br>
<br>
<table style="border-style: solid; border-width: thin; padding: 10px;">
  <tr>
    <th>Nome</th>
    <th>Autor, Ano</th>
    <th colspan="3">Ações</th>
  </tr>
  <?php foreach($sources as $source): ?>
    <tr>
      <td style="padding-right: 20px;"><?=$source['name']?></td>
      <td style="padding-left: 20px; padding-right: 20px;"><?=$source['author']?>,<?=$source['year']?></td>
      <td><button onclick="window.location.href = '?page=FeedSentence&id=<?=$source['id']?>'"><i class="material-icons">create</i></button></td>
      <td><button onclick="window.location.href = '?page=SourcePreferences&id=<?=$source['id']?>'"><i class="material-icons">build</i></button></td>
    </tr>
  <?php endforeach;?>
  <tr>
    <td><button onclick="window.location.href = '?page=AddSource'"><i class="material-icons">create_new_folder</i>Nova fonte...</button></td>
  </tr>
</table>
