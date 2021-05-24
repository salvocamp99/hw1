<?php
require_once 'Autenticazione.php';
header('Content-Type: application/json');
if (!$nome_utente = Autenticazione()) {
    header("Location: accesso.php");
    exit;
}

if(!isset($_SESSION['ristorante'])){
    header("Location:ristoranti.php");
    exit;
    }

    $nome_utente = $_SESSION["nome_utente"];
    $ristorante = $_SESSION["ristorante"];
    $conn = mysqli_connect($configurazione_database['host'], $configurazione_database['utente'], $configurazione_database['password'], $configurazione_database['nome_database']) or die(mysqli_error($conn));
    $nome_utente=mysqli_real_escape_string($conn,$nome_utente);
    $id_l = $_GET['q'];
    $query = "INSERT INTO likes(nome_utente, id_l) values('$nome_utente', '$id_l')";
    $res = mysqli_query($conn, $query);
    $query2 = "SELECT num_likes FROM recensione where id_rec = '$id_l'";
    $res2 = mysqli_query($conn, $query2);
    $entry = mysqli_fetch_assoc($res2);
    $postArray = array('num_likes' => $entry['num_likes']);
 

     echo json_encode($postArray);

?>
    
