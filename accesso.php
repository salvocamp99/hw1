<?php
        // Verifica che l'utente abbia fatto il login e va alla home
        include 'Autenticazione.php';
        if (Autenticazione()) {
            header('Location: homepage.php');
            exit;
        }
    
    if (!empty($_POST["nome_utente"]) && !empty($_POST["password"]))
    {
        // Se abbiamo inviato i dati ci colleghiamo al database
        $conn = mysqli_connect($configurazione_database['host'], $configurazione_database['utente'], $configurazione_database['password'], $configurazione_database['nome_database']) or die(mysqli_error($conn));
        $nome_utente = mysqli_real_escape_string($conn, $_POST['nome_utente']);
        //$password = mysqli_real_escape_string($conn, $_POST['password']);
        $query = "SELECT*FROM cliente WHERE nome_utente = '$nome_utente'";
        $res= mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);
           if(password_verify($_POST['password'],$entry['password'])){

        
               
                //sessione utente
                $_SESSION["nome_utente"] = $_POST["nome_utente"];
                header("Location: homepage.php");
                //mysqli_free_result($risultato);
                mysqli_close($conn);
                exit;
            }
        }
    
        // Se sbagliamo nome utente e password
        $errore = "Nome utente e password sbagliati";
    
    }
    else if (isset($_POST["nome_utente"]) || isset($_POST["password"])) {
        // Se abbiamo o solo nome utente o solo la password
        $errore = "Inserisci nome utente e password.";
    }

  

?>


<html>
    <head>
        <link rel='stylesheet' href='register.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FoodItaly</title>
    </head>
    <body>
        <article class="accesso">
        <section class="parte_sx">
        <div>
        <img src="immagine.jpg"/>
        </div>
        </section>
        <section class="parte_dx">
            <h1>Ciao fooder</h1>
            
            <form name='accesso' method='post'>
                <div class="nome_utente">
                    <div><label for='nome_utente'>Nome utente</label></div>
                    <div><input type='text' name='nome_utente' <?php if(isset($_POST["nome_utente"])){echo "value=".$_POST["nome_utente"];} ?>></div>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                </div>
                </div>
                <div>
                    <input type='submit' value="Accedi">
                </div>
            </form>
</br>
<?php
                // Verifica la presenza di errori
                if (isset($errore)) {
                    echo "<span class='non_valido'>$errore</span>";
                }
                
            ?>
            <div class="registrazione">Non sei ancora un fooder? <a href="registrati.php">Registrati</a>
        </section>
        </article>
    </body>
</html>