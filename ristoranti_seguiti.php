<?php
require_once 'Autenticazione.php';
header('Content-Type:application/json');
if(!$nome_utente=Autenticazione()) exit;

$id_r=$_GET['q'];

$conn = mysqli_connect($configurazione_database['host'], $configurazione_database['utente'], $configurazione_database['password'], $configurazione_database['nome_database']) or die(mysqli_error($conn));

$nome_utente=mysqli_real_escape_string($conn,$nome_utente);

$query = "INSERT INTO segue(nome_utente,id_r) values('$nome_utente', '$id_r')"; 

$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

$query2="SELECT r.id_r,r.nome_ristorante,r.immagine from ristoranti r JOIN segue s on r.id_r=s.id_r WHERE s.nome_utente='$nome_utente'and s.id_r='$id_r'";

$res2=mysqli_query($conn,$query2)or die(mysqli_error($conn));

$entry=mysqli_fetch_assoc($res2);
$postArray=array('id_r'=>$entry['id_r'],'nome_ristorante'=>$entry['nome_ristorante'],'immagine'=>$entry['immagine']);

echo json_encode($postArray);

exit;


mysqli_close($conn);
?>
