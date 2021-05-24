<?php
require_once 'configurazione_database.php';
//controlliamo che il nome utente non sia già in uso

header('Content-Type: application/json');

$conn = mysqli_connect($configurazione_database['host'], $configurazione_database['utente'], $configurazione_database['password'], $configurazione_database['nome_database']);

$email = mysqli_real_escape_string($conn, $_GET["q"]);

$query = "SELECT email FROM cliente
            WHERE email = '$email'";

$risultato = mysqli_query($conn, $query) or die(mysqli_error($conn));

echo json_encode(array('exists' => mysqli_num_rows($risultato) > 0 ? true : false));

mysqli_close($conn);
?>