<?php
require_once 'Autenticazione.php';
header('Content-Type:application/json');
if(!$nome_utente=Autenticazione()) exit;

$conn = mysqli_connect($configurazione_database['host'], $configurazione_database['utente'], $configurazione_database['password'], $configurazione_database['nome_database']) or die(mysqli_error($conn));
$nome_utente=mysqli_real_escape_string($conn,$nome_utente);

$query="SELECT*from segue";
$res2=mysqli_query($conn,$query2)or die(mysqli_error($conn));
$post_array=array();
while($entry=mysqli_fetch_assoc($res2)){
//controllo il risultato delle righe del db
$postArray[]=array('id_r'=>$entry['id_r'],'nome_ristorante'=>$entry['nome_ristorante'],'immagine'=>$entry['immagine']);
}
echo json_encode($postArray);

exit;


mysqli_close($conn);
?>