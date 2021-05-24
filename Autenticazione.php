<?php
    require_once 'configurazione_database.php';
    session_start();

    function Autenticazione() {
        // Ritorna la sessione già esistente, altrimenti ritorna 0
        if(isset( $_SESSION["nome_utente"])) {
            return $_SESSION["nome_utente"] ;
        } else 
            return 0;
    }
?>