<?php

require_once 'Autenticazione.php';
header('Content-Type:application/json');
if(!$nome_utente=Autenticazione()) exit;

$conn= mysqli_connect($configurazione_database['host'], $configurazione_database['utente'], $configurazione_database['password'], $configurazione_database['nome_database']) or die(mysqli_error($conn));
$nome_utente=mysqli_real_escape_string($conn,$nome_utente);

$query="SELECT * FROM ristoranti r";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn)); 
$post_array=array();
while($entry= mysqli_fetch_assoc($res)){
    $id_r=$entry['id_r'];
    $query2="SELECT*from segue WHERE nome_utente='$nome_utente'and id_r='$id_r'";
    $res2=mysqli_query($conn,$query2);
$post_array[]=array('id_r'=>$entry['id_r'],'nome_ristorante'=>$entry['nome_ristorante'],'immagine'=>$entry['immagine'],'descrizione'=>$entry['descrizione'],'isFollowed'=>mysqli_num_rows($res2)>0?true:false);

}
echo json_encode($post_array);

exit;
mysqli_close($conn);
?>
