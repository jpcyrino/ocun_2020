<head>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/topbar.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
