<?php
require_once 'Autenticazione.php';
header('Content-Type:application/json');
if(!$nome_utente=Autenticazione())exit;

$id_r=$_GET['q'];

$conn=mysqli_connect($configurazione_database['host'], $configurazione_database['utente'], $configurazione_database['password'], $configurazione_database['nome_database']) or die(mysqli_error($conn));
$nome_utente=mysqli_real_escape_string($conn,$nome_utente);
$query="DELETE from segue where nome_utente='$nome_utente' AND id_r='$id_r'";
$res=mysqli_query($conn,$query)or die(mysqli_error($conn));
echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false,'id_r'=>$id_r));
exit;

mysqli_close($conn);

?>