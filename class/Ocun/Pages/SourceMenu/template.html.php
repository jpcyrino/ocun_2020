<h1>Fontes de Dados</h1>
<p>Abaixo estão relacionadas as fontes de dados a que se pode ter acesso no momento. Você também pode <a href="?page=AddSource"><b>criar uma fonte</b></a>.</p>
<br>

<br>
<br>
<table style="border-style: solid; border-width: thin; padding: 10px;">
  <tr>
    <th>Nome</th>
    <th>Autor, Ano</th>
    <th colspan="4">Ações</th>
  </tr>
  <?php foreach($sources as $source): ?>
    <tr>
      <td style="padding-right: 20px;"><?=$source['name']?></td>
      <td style="padding-left: 20px; padding-right: 20px;"><?=$source['author']?>,<?=$source['year']?></td>
      <td><button onclick="window.location.href = '?page=FeedSentence&id=<?=$source['id']?>'"><i class="material-icons">create</i>Dados</button></td>
      <td><button onclick="window.location.href = '?page=SourcePreferences&id=<?=$source['id']?>'"><i class="material-icons">build</i>Preferências</button></td>
      <td><button onclick="window.location.href = '?page=AddLanguage&id=<?=$source['language']?>'"><i class="material-icons">font_download</i>Língua</i></button></td>
    </tr>
  <?php endforeach;?>
  <tr>
    <td><button onclick="window.location.href = '?page=AddSource'"><i class="material-icons">create_new_folder</i>Nova fonte...</button></td>
  </tr>
</table>
