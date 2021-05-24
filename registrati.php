<?php
    require_once 'Autenticazione.php';
    if (Autenticazione()) {
        header("Location: homepage.php");
        exit;

    }   

    // Verifico che i dati POST esistano e non siano vuoti
    if (!empty($_POST["nome_utente"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["nome"]) && 
        !empty($_POST["cognome"]) && !empty($_POST["conferma_password"]))
    {
        $errore = array();
        $conn = mysqli_connect($configurazione_database['host'], $configurazione_database['utente'], $configurazione_database['password'], $configurazione_database['nome_database']) or die(mysqli_error($conn));

        
      
        //Verifico che il nome utente contenga lettere maiuscole,minuscole, numeri e che sia lungo max 20 caratteri
        if(!preg_match('/^[a-zA-Z0-9_]{1,20}$/', $_POST['nome_utente'])) {
            $errore[] = "Nome utente non valido";
        } else {
            $nome_utente = mysqli_real_escape_string($conn, $_POST['nome_utente']);
            // Controllo che il nome utente sia disponibile,in caso contrario visualizza l'errore
            $query = "SELECT nome_utente FROM cliente WHERE nome_utente = '$nome_utente'";
            $risultato = mysqli_query($conn, $query);
            if (mysqli_num_rows($risultato) > 0) {
                $errore[] = "Nome utente non disponibile";
            }
        }
        //Verifico la lunghezza della password
        if (strlen($_POST["password"]) < 8) {
            $errore[] = "Password troppo corta";
        } 
    //Faccio lo stesso con la conferma di quest'ultima
        if (strcmp($_POST["password"], $_POST["conferma_password"]) != 0) {
            $errore[] = "Password non uguali";
        }
        //Verifico che l'email contenga lettere minuscole,numeri e caratteri speciali come(@._ %)
        if (!preg_match('/^[a-z0-9._%-]+@[a-z0-9.-]+\.[a-z]{2,4}$/',($_POST['email']))) {
            $errore[] = "Email non valida";
            //controlliamo che l'email non sia gia stata usata altrimenti visualizza errore
        } else {
            $email = mysqli_real_escape_string($conn,($_POST['email']));
            $risultato = mysqli_query($conn, "SELECT email FROM cliente WHERE email = '$email'");
            if (mysqli_num_rows($risultato) > 0) {
                $errore[] = "Email già utilizzata";
            }
        }


        //inseriamo nel database i dati della registrazione
            if (count($errore) == 0) {
            $nome = mysqli_real_escape_string($conn, $_POST['nome']);
            $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT); 

            $query = "INSERT INTO cliente(nome_utente, password, nome, cognome, email) VALUES('$nome_utente', '$password', '$nome', '$cognome', '$email')";
            //Sessione dell'utente
            if (mysqli_query($conn, $query)) {
                $_SESSION["nome_utente"] = $_POST["nome_utente"];
                header("Location: homepage.php");
                mysqli_close($conn);
                exit;
            } else {
                $errore[] = "Errore di connessione";
            }
        }
        mysqli_close($conn);
    }

?>


<html>
    <head>
        <link rel='stylesheet' href='register.css'>
        <script src='registrati.js' defer></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i|Open+Sans:400,700" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title>FoodItaly</title>
    </head>
    <body>
        <article>
        <section class="parte_sx">
            <div>
        <img src="immagine.jpg"/>
</div>
        </section>
        <section class="parte_dx">
            <h1>Diventa un fooder</h1>
            <form name='registrazione' method='post'>
                <div class="testo">
                    <div class="nome">
                        <div><label for='nome'>Nome</label></div>
                     
                        <div><input type='text' name='nome' <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?> ></div>
                        <span>Inserisci nome</span>
                    </div>
                    <div class="cognome">
                        <div><label for='cognome'>Cognome</label></div>
                        <div><input type='text' name='cognome' <?php if(isset($_POST["cognome"])){echo "value=".$_POST["cognome"];} ?> ></div>
                        <span>Inserisci cognome</span>
                    </div>
                </div>
                <div class="nome_utente">
                    <div><label for='nome_utente'>Nome utente</label></div>
                    <div><input type='text' name='nome_utente' <?php if(isset($_POST["nome_utente"])){echo "value=".$_POST["nome_utente"];} ?>></div>
                    <span>Nome utente non disponibile</span>
                </div>
                <div class="email">
                    <div><label for='email'>Email</label></div>
                    <div><input type='text' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>></div>
                    <span>Indirizzo email non valido</span>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                    <span>Password troppo corta</span>
                </div>
                <div class="conferma_password">
                    <div><label for='conferma_password'>Conferma Password</label></div>
                    <div><input type='password' name='conferma_password' <?php if(isset($_POST["conferma_password"])){echo "value=".$_POST["conferma_password"];} ?>></div>
                    <span>Ops,controlla meglio la password</span>
                </div>
                <div class="submit">
                    <input type='submit' value="Registrati" id="submit" disabled>
                </div>
            </form>
            <div class="registrazione">Sei già un fooder? <a href="accesso.php">Accedi</a>
        </section>
        </article>
    </body>
</html>