
<?php 
    require_once 'Autenticazione.php';
    if (!$nome_utente = Autenticazione()) {
        header("Location: accesso.php");
        exit;
    }

?>








<html>
  <head>
    <meta charset="utf-8">
    <title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Inter:400,400i|Open+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i|Open+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i|Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="ricetta.css">
    <script src="ricetta.js"defer="true"></script>

  </head>
  <body>                                     
    <header>
      <div id="overlay"></div>
      <nav>    
        <div id="flex-conteiner">
          <img src='logo.jpg'>
          <a href='homepage.php'>Home</a>
          <a href='ristoranti.php'>Ristoranti</a>
          <a href='ricetta.php' class="button">Altre info</a>
          <a href="abbandona_pagina.php"class="button">Logout</a>
        
        </div>
		<div id="menu">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </nav>
      <h1>vieni a scoprire la sezione dedicata alle nostre ricette</h1>
    </header>
    <section>
      <h1>Quale ricetta vuoi cercare?</h1>
      <form method="post" name="cerca">
        <label><input type='radio' name='type'value="Birre">Birre</label>
        <label><input type='radio' name='type'value="Cibo">Cibo</label>
        <br><input type="text"name="cerca"id="barra_ricerca"placeholder="Cerca la tua ricetta">
        <input type='submit' value='Cerca'>
        </form>
        <div id="lista">
          </div>
          <div id="modale" class="hidden">
          </div>
    </section>
    <footer>
      <div>
      <img src="logo.jpg"/>
      </div>
      <h1>Università degli studi di Catania</h1>
      <h2>Dieei</h2>
      <p> Created by Campione Salvatore O46002086</p>
    </footer>
  </body>
</html>
