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
    $nome_utente = mysqli_real_escape_string($conn, $nome_utente);
    $id_comm = $_GET['q'];
    $commento = $_GET['commento'];
    $query = "INSERT INTO commenti(nome_utente, testo, id_rec) values('$nome_utente', '$commento', '$id_comm')";
    $res = mysqli_query($conn, $query);
    $query2 = "SELECT * FROM cliente where nome_utente = '$nome_utente'";
    $res2 = mysqli_query($conn, $query2);
    $entry = mysqli_fetch_assoc($res2);
    $postArray = array('nome' => $entry['nome'], 'cognome' => $entry['cognome'], 'Testo' => $commento);


     echo json_encode($postArray);

?>