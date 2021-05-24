<?php
    include 'configurazione_database.php';

    // Distruggo la sessione esistente
    session_start();
    session_destroy();

    header('Location: accesso.php');
?>