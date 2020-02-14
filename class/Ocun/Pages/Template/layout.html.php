<head>
  <meta property="og:image" content="img/ocun_tile.png" />
  <meta property="og:title" content="Òcun" />
  <meta property="og:description" content="Plataforma de dados linguísticos" />
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/topbar.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src='https://cdn.plot.ly/plotly-latest.min.js'></script>
  <!-- <script type="text/javascript" src="js/sorttable.js"></script> -->
  <script type="text/javascript" src="js/structural.js"></script>
</head>
<body>
  <header>
    <?php include __DIR__ . "/../Template/topbar.html.php"; ?>
  </header>
  <main>
    <article>
      <?php include __DIR__ . $template; ?>
    </article>
  </main>


</body>
