<?php
require_once 'Autenticazione.php';
if(!$nome_utente=Autenticazione()){
  header("Location:accesso.php");
  exit;
}
?>


<html>
  <head>
    <meta charset="utf-8">
    <title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Inter,Roboto,Montserrat:400,400i|Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="homepage.css">
    <script src="homepage.js"defer="true"></script>
  </head>
  <body>
    <header>
      <div id="overlay"></div>
      <nav>    
        <div id="flex-conteiner">
          <img src='logo.jpg'>
          <a href='homepage.php'>Home</a>
          <a href='ristoranti.php'>Ristoranti</a>
          <a href='ricetta.php'>Altre info</a>
          <a href="abbandona_pagina.php"class="button">Logout</a>
        </div>
      </nav>
      <?php if(isset($_SESSION["nome_utente"])){
                    echo "<a>Benvenuto,".$_SESSION["nome_utente"]."!</a>";
                }
                ?>
      <h1>
<strong>Italian food : Il gusto di mangiare cibo italiano.</br>
  Vieni a scoprire i migliori ristoranti di tutt'Italia,che aspetti!
</strong></br></br>
    </header>
    <section>
    </br>
    <h3>Ecco una preview di cosa offriamo</h3>
<div id="main-conteiner">
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
