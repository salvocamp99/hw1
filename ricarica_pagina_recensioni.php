<?php 
require_once 'Autenticazione.php';
header('Content-Type: application/json');
if (!$nome_utente = Autenticazione()) {
    header("Location: accesso.php");
    exit;
}

if(!isset($_SESSION["ristorante"])){
    header("location: ristoranti.php");
    exit;
}
   $ristorante = $_SESSION["ristorante"];
   $conn = mysqli_connect($configurazione_database['host'], $configurazione_database['utente'], $configurazione_database['password'], $configurazione_database['nome_database']) or die(mysqli_error($conn));
   $nome_utente= mysqli_real_escape_string($conn, $nome_utente);
   $query = "SELECT r.*, c.* 
            FROM recensione r join cliente c on r.nome_utente = c.nome_utente WHERE r.id_r = $ristorante ";
   $res = mysqli_query($conn, $query);
   $postArray = array();
   while($entry = mysqli_fetch_assoc($res)) {
        $id = $entry['id_rec'];
        $query2 = "SELECT * FROM likes WHERE nome_utente = '$nome_utente' and id_l = $id ";
        $res2 = mysqli_query($conn, $query2);

        $query3 = "SELECT comm.testo, c.nome, c.cognome
                    FROM commenti comm join cliente c on c.nome_utente = comm.nome_utente
                    WHERE id_rec = $id";
        $res3 = mysqli_query($conn, $query3);

        $allComments = array();
        while($commento = mysqli_fetch_assoc($res3)) {
            $allComments[] = array('nome' => $commento['nome'], 'cognome' => $commento['cognome'], 'Testo' => $commento['testo']);

        }
        


        $postArray[] = array('nome' => $entry['nome'], 'cognome' => $entry['cognome'],'nome_utente'=>$entry['nome_utente'],'recensione' => json_decode($entry['content']), 'num_likes'=> $entry['num_likes'], 'id_rec' => $entry['id_rec'], 'mi_piace' => mysqli_num_rows($res2) > 0 ? true : false,
                        'commenti' => $allComments);

    }

    echo json_encode($postArray);
    


    
?>