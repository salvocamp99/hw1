<?php
require_once 'Autenticazione.php';
if(!$nome_utente=Autenticazione()){
header("Location:accesso.php");

exit;
}
if(isset($_POST["ristorante"])){
$_SESSION["ristorante"]=$_POST["ristorante"];
header("Location:Recensioni.php");
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
    <link rel="stylesheet" href="ristoranti.css">
    <script src="ristoranti.js"defer="true"></script>
  </head>
  <body>                                     
      <article>
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
    </header>
    <section>
    <h1>Segui il tuo ristorante</h1>
    <h3 id="testo1"class="hidden">Ristoranti seguiti</h3>
    <div id="ristoranti_seguiti" class="hidden">
    </div>
    <div id="listaRistoranti">
    <h3 class=testo>Tutti i ristoranti</h3>
    <label>cerca</label><input type='text'id="ricerca">
    </div>
    <div id="choice"class="ristoranti">
    </div>
    </section>
    </article>
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
 