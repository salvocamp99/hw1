
function validazione() {
    //contollo che i campi siano tutti pieni e poi abilito il submit
    document.getElementById('submit').disabled = !document.forms["registrazione"] || 
    Object.keys(form).length !== 6 ;
}

function jsonControlloUtente(json) {
//controllo il campo exist
    if (form.nome_utente = !json.exists) {
        document.querySelector('.nome_utente').classList.remove('errore');
    } else {
        document.querySelector('.nome_utente span').textContent = "Nome utente già utilizzato";
        document.querySelector('.nome_utente').classList.add('errore');
    }
    validazione();
}

function jsonControllaEmail(json) {
    // Controllo il campo exists ritornato dal JSON
    if (form.email = !json.exists) {
        document.querySelector('.email').classList.remove('errore');
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('errore');
    }
    validazione();
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}
//eseguo i vari controlli su nome,cognome,email, nome utente e password
function verificaUtente(event) {
    const input = document.querySelector('.nome_utente input');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        input.parentNode.parentNode.querySelector('span').textContent = "Nome utente non valido";
        input.parentNode.parentNode.classList.add('errore');

        validazione();
    } else {
        fetch("verificaUtente.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonControlloUtente);
    }    
}
function controlloNome(event) {
    const input = event.currentTarget;
    
    if (form[input.nome] = input.value.length > 0) {
        input.parentNode.parentNode.classList.remove('errore');
    } else {
        input.parentNode.parentNode.classList.add('errore');
    }
    
    validazione();
}
function controlloCognome(event) {
    const input = event.currentTarget;
    if (form[input.nome] = input.value.length > 0) {
        input.parentNode.parentNode.classList.remove('errore');
    } else {
        input.parentNode.parentNode.classList.add('errore');
    }
    validazione();
}

function controlloEmail(event) {
    const email = document.querySelector('.email input');
    if(!/^[a-z0-9._%-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(String(email.value))) {
        document.querySelector('.email span').textContent = "Email non valida";
        document.querySelector('.email').classList.add('errore');
        validazione();
    } else {
        fetch("controlloEmail.php?q="+encodeURIComponent(String(email.value))).then(fetchResponse).then(jsonControllaEmail);
    }
}

function controlloPassword(event) {
    const password = document.querySelector('.password input');
    if (form.password = password.value.length >= 8) {
        document.querySelector('.password').classList.remove('errore');
    } else {
        document.querySelector('.password').classList.add('errore');
    }
    validazione();
}

function Conferma(event) {
    const conferma = document.querySelector('.conferma_password input');
    if (form.conferma = conferma.value === document.querySelector('.password input').value) {
        document.querySelector('.conferma_password').classList.remove('errore');
    } else {
        document.querySelector('.conferma_password').classList.add('errore');
    }
    validazione();
}
const form = {'upload': true};
document.querySelector('.nome input').addEventListener('blur', controlloNome);
document.querySelector('.cognome input').addEventListener('blur', controlloCognome);
document.querySelector('.nome_utente input').addEventListener('blur', verificaUtente);
document.querySelector('.email input').addEventListener('blur', controlloEmail);
document.querySelector('.password input').addEventListener('blur', controlloPassword);
document.querySelector('.conferma_password input').addEventListener('blur', Conferma);

if (document.querySelector('.non_valido') !== null) {
    verificaUtente(); controlloPassword(); Conferma(); controlloEmail();
    document.querySelector('.nome input').dispatchEvent(new Event('blur'));
    document.querySelector('.cognome input').dispatchEvent(new Event('blur')); 
}


