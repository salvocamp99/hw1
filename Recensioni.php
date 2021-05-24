<?php
require_once 'Autenticazione.php';
if(!$nome_utente=Autenticazione()){
header("Location:accesso.php");
exit;
}
if(!isset($_SESSION['ristorante'])){
header("Location:ristoranti.php");
exit;
}
$conn = mysqli_connect($configurazione_database['host'], $configurazione_database['utente'], $configurazione_database['password'], $configurazione_database['nome_database']) or die(mysqli_error($conn));
$nome_utente=mysqli_real_escape_string($conn,$nome_utente);
$ristorante=mysqli_real_escape_string($conn,$_SESSION["ristorante"]); 
$query= "SELECT c.nome_utente as nome_utente,c.nome as nome FROM cliente c WHERE nome_utente='$nome_utente'";
$res=mysqli_query($conn,$query);
$userinfo=mysqli_fetch_assoc($res);
$query2="SELECT nome_ristorante FROM ristoranti WHERE id_r='$ristorante' ";
$res2=mysqli_query($conn,$query2);
$userinfo_1=mysqli_fetch_assoc($res2);

?>

<html>
<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>FoodItaly</title>
	    <link rel="stylesheet" href="Recensioni.css">
         
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i|Open+Sans:400,700" rel="stylesheet">
	    <script src="recensione.js" defer></script>
	</head>

    <body>
        <nav>
            <div id ="title">FoodItaly - Recensioni - <?php if (isset($userinfo_1))  echo $userinfo_1['nome_ristorante'];?> </div>
            <div id="barra">
                <a href="homepage.php">Home</a> 
                <a href="ristoranti.php">Tutti i tuoi ristoranti</a>
                <a href="abbandona_pagina.php">Logout</a>
                <a class = "nuova_recensione">Aggiungi recensione</a>
            </div>
            
        </nav>
        <section>
            <h1>
                Ciao <?php
                echo $userinfo['nome']."!";   
                            ?>
                            </h1>
    <div id="principale">
</div> 

        </section>
        <div id="modale" class="hidden">
            <div id="aggiungi_rec">
            <div class="recensione">
            <div>Scrivi una recensione</div>
            <div id="annulla_recensione">Annulla</div>

</div>
                <form method="post" name="invia">
                    <textarea id="intestazione" name="intestazione"cols="80"rows="3"maxlenght="5"placeholder="inserisci intestazione"></textarea>
                    <textarea id="testo" name="testo"cols="80"rows="3"maxlenght="5"placeholder="inserisci testo"></textarea>
                    <div class="recensione">
                    <input type="file" id="file" name ="file" accept=" .jpg,.png"> 
                    <input type="submit" id ="sumbit" value ="Carica recensione">
</div>
<div id="errore"class="hidden">Scrivi qualcosa</div>
                </form>
            </div>
        </div>
        
    </body>




</html>