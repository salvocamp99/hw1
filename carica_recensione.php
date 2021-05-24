<?php 
require_once 'Autenticazione.php';
header('Content-Type: application/json');
if (!$nome_utente = Autenticazione()) {
    header("Location: accesso.php");
    exit;
}
$conn = mysqli_connect($configurazione_database['host'], $configurazione_database['utente'], $configurazione_database['password'], $configurazione_database['nome_database']) or die(mysqli_error($conn));
$nome_utente=mysqli_real_escape_string($conn,$nome_utente);
$ristorante= mysqli_real_escape_string($conn,$_SESSION['ristorante']);
$query = "SELECT *from cliente WHERE nome_utente='$nome_utente';";
$res = mysqli_query($conn, $query); 
$userinfo = mysqli_fetch_assoc($res);
$int=mysqli_real_escape_string($conn,$_POST['intestazione']);
$testo=mysqli_real_escape_string($conn,$_POST['testo']);
if($int!=''&& $testo!=''){

$int=mysqli_real_escape_string($conn,$_POST['intestazione']);
$testo=mysqli_real_escape_string($conn,$_POST['testo']);

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $type = exif_imagetype($file['tmp_name']);
    $allowedExt = array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg');
    if (isset($allowedExt[$type])) {
        if ($file['error'] === 0) {
            $fileNameNew = uniqid('', true).".".$allowedExt[$type];
            $fileDestination = 'immagini/'.$fileNameNew;
            $res=move_uploaded_file($file['tmp_name'], $fileDestination);


            $postArray = array("nome" => $userinfo['nome'], "cognome" => $userinfo['cognome'],"nome_utente"=>$userinfo['nome_utente'],"intestazione"=>$int ,"testo" => $testo, "file" => $fileDestination, "type" => $allowedExt[$type] );
            $content = json_encode(array("intestazione"=>$int, "testo" => $testo, "file" => $fileDestination, "type" => $allowedExt[$type]));
            
            $query2 = "INSERT into recensione(id_r, nome_utente, content) values($ristorante, '$nome_utente', '$content')";

            $res2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
            $query3 = "SELECT id_rec, num_likes FROM recensione where id_r =$ristorante and nome_utente = '$nome_utente' and content ='$content';"; 
            $res3 = mysqli_query($conn, $query3);
            $postinfo = mysqli_fetch_assoc($res3);

            echo json_encode( array('recensione' => $postArray, 'id_rec' => $postinfo['id_rec'], 'num_likes' => $postinfo['num_likes']));
            exit;
        }
    }
  
}
else{ json_encode(array("errore"=>"manca il file"));
}
} else{
    json_encode(array("errore"=>"Manca il testo e l'intestazione"));
    exit;
}



     

?>