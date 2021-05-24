function inserisci_recensione(event){
event.preventDefault();
const i=document.forms['invia'].querySelector('#intestazione');
const t=document.forms['invia'].querySelector('#testo');
const f=document.forms['invia'].querySelector("#file");
console.log(f.files[0]);

var formData=new FormData();
formData.append('intestazione',i.value);
formData.append('testo',t.value);
formData.append('file',f.files[0]);
console.log(formData);

fetch('carica_recensione.php',{method:'POST',body: formData}).then(onResponse).then(onJson);


}


function onJson(json){
console.log(json);
if(json.errore){
    document.querySelector('#errore').classList.remove('hidden');
}else{
    document.querySelector('#errore').classList.add('hidden');
    document.querySelector('#modale').classList.add('hidden');
    document.body.classList.remove('no-scroll');

}
const principale=document.querySelector("#principale");
const recensione=document.createElement('div');
recensione.dataset.id=json.id_rec;
recensione.classList.add('rec');
principale.appendChild(recensione);
const div1=document.createElement('div');
div1.classList.add('div1');
recensione.appendChild(div1);
const utente=document.createElement('img');
utente.src="utente.jpg";
utente.classList.add('utente');
div1.appendChild(utente);
const info1=document.createElement('h1');
info1.textContent=json.recensione.nome +' ' + json.recensione.cognome;
info1.classList.add('nome');
div1.appendChild(info1);
const div2=document.createElement('div');
const utente1=document.createElement("h1");
utente1.textContent= '@' +json.recensione.nome_utente;
utente1.classList.add("h1");
div2.appendChild(utente1);
div2.classList.add("div2");
recensione.appendChild(div2);

if(json.recensione.type=='png'||json.recensione.type=='jpg'){
const blocco=document.createElement('div');
blocco.classList.add('blocco');
const img=document.createElement('img');
img.src=json.recensione.file;
img.classList.add('img');
blocco.appendChild(img);
recensione.appendChild(blocco);
}
const intestazione = document.createElement('h1');
 intestazione.textContent = json.recensione.intestazione;
 intestazione.classList.add('intestazione'); 
recensione.appendChild(intestazione);

const testo=document.createElement('p');
testo.textContent=json.recensione.testo;
testo.classList.add('testo');
recensione.appendChild(testo);

        const like = document.createElement('a');
        like.classList.add('like');
        recensione.appendChild(like);
        const num_likes = document.createElement('a');
        num_likes.textContent = json.num_likes;
        num_likes.classList.add('numero');
        const immagine = document.createElement('img');
        immagine.src = 'mi_piace.jpg';
        immagine.classList.add("miPiace");
        immagine.addEventListener("click",mettiLike);
        like.appendChild(num_likes);
        like.appendChild(immagine);
       
        const commento = document.createElement('div');
        commento.classList.add('commento');
        const input = document.createElement('input');
        input.type ="text";
        input.placeholder ="Scrivi un commento";
        input.id = "text";
        const submit = document.createElement('img');
        submit.src ='invio.png';
        commento.appendChild(input);
        commento.appendChild(submit);
        recensione.appendChild(commento)

}

//aggiungo una recensione nuova
const botton = document.querySelector('.nuova_recensione');
botton.addEventListener('click', Nuova_recensione);
botton.classList.add('nuovaRecensione');
const annulla=document.querySelector('#annulla_recensione');
annulla.addEventListener('click', chiudiModale);
 
function Nuova_recensione(event){
 document.querySelector('#modale').classList.remove('hidden');
 document.body.classList.add('no-scroll');
 document.forms['invia'].addEventListener("submit", inserisci_recensione);
    }
   
    function chiudiModale(event) {
    
        modale.classList.add('hidden');
    
        document.body.classList.remove('no-scroll');
        
    }
    function onResponse(response){
        return response.json();
        }
    
    fetch('ricarica_pagina_recensioni.php').then(onResponse).then(onJson2);

    function onJson2(json){
    console.log(json);
    for(jsonElem of json){
        const principale=document.querySelector("#principale");
        const recensione=document.createElement('div');
        recensione.dataset.id=jsonElem.id_rec;
        recensione.classList.add('rec');
        principale.appendChild(recensione);
        const div1=document.createElement('div');
        div1.classList.add('div1');
        recensione.appendChild(div1);
        const utente=document.createElement('img');
        utente.src="utente.jpg";
        utente.classList.add('utente');
        div1.appendChild(utente);
        const info1=document.createElement('h1');
        info1.textContent=jsonElem.nome +' ' + jsonElem.cognome;
        info1.classList.add('nome');
        div1.appendChild(info1);
        const div2=document.createElement('div');
        const utente1=document.createElement('h1');
        utente1.classList.add("h1");
        utente1.textContent='@' + jsonElem.nome_utente;
        div2.appendChild(utente1);
        div2.classList.add("div2");
        recensione.appendChild(div2);
        
        if(jsonElem.recensione.type=='png'||jsonElem.recensione.type=='jpg'){
        const blocco=document.createElement('div');
        blocco.classList.add('blocco');
        const img=document.createElement('img');
        img.src=jsonElem.recensione.file;
        img.classList.add('img');
        blocco.appendChild(img);
        recensione.appendChild(blocco);
        }
        const intestazione = document.createElement('h1');
        intestazione.textContent = jsonElem.recensione.intestazione;
        intestazione.classList.add('intestazione'); 
        recensione.appendChild(intestazione);
        
        const testo=document.createElement('p');
        testo.textContent=jsonElem.recensione.testo;
        testo.classList.add('testo');
        recensione.appendChild(testo);
        const like = document.createElement('a');
        like.classList.add('like');
        recensione.appendChild(like);
        const num_likes = document.createElement('a');
        num_likes.textContent = jsonElem.num_likes;
        num_likes.classList.add('numero');
        const immagine = document.createElement('img');
        immagine.classList.add("miPiace");
        like.appendChild(num_likes);
        like.appendChild(immagine);
        if(jsonElem.mi_piace===false){
        immagine.src='mi_piace.jpg';
        immagine.addEventListener("click",mettiLike);
        }
        else{
            immagine.src='mi_piace.jpg';
            immagine.addEventListener("click",Rimuovi_mi_piace);
        }
        const commento = document.createElement('div');
        commento.classList.add('commento');
        const input = document.createElement('input');
        input.type ="text";
        input.placeholder ="Scrivi un commento";
        input.id = "text";
        const submit = document.createElement('img');
        submit.src ='invio.png';
        submit.addEventListener("click",aggiungiCommento);
        const tutti_i_commenti=document.createElement('div');
        tutti_i_commenti.classList.add('commenti');
       
        for(comment of jsonElem.commenti){
        const div3=document.createElement('div');
        div3.classList.add('divElem');
        const autore_commento=document.createElement('div');
        autore_commento.textContent=comment.nome + ' '+ comment.cognome;
        autore_commento.classList.add('h1_1');
        const text=document.createElement('div');
        text.textContent=comment.Testo;
        text.classList.add('p');
        div3.appendChild(autore_commento);
        div3.appendChild(text);
        tutti_i_commenti.appendChild(div3);
        }
        commento.appendChild(input);
        commento.appendChild(submit);
        recensione.appendChild(tutti_i_commenti);
        recensione.appendChild(commento);
        


    }
    }
    
    function mettiLike(event){
    const like=event.currentTarget;
    event.currentTarget.removeEventListener("click",mettiLike);
    event.currentTarget.src='mi_piace.jpg';
    event.currentTarget.addEventListener("click",Rimuovi_mi_piace);
    fetch("metti_like.php?q="+encodeURIComponent(event.currentTarget.parentNode.parentNode.dataset.id)).then(onResponse).then(function(json){
    return json3(json,like);
    });
    }
    function json3(json,like){
        console.log(json);
        like.parentNode.querySelector('a').textContent = json.num_likes;
    }
   
    function json4(json, dislike){
        console.log(json);
        dislike.parentNode.querySelector('a').textContent = json.num_likes;
    }
    
    function Rimuovi_mi_piace(event){
        const dislike = event.currentTarget;
        event.currentTarget.removeEventListener("click", Rimuovi_mi_piace);
        event.currentTarget.src = 'mi_piace.jpg';
    
        const rimuovi_like = event.currentTarget.addEventListener("click",mettiLike);
        fetch("rimuovi_like.php?q="+encodeURIComponent(event.currentTarget.parentNode.parentNode.dataset.id)).then(onResponse).then(function (json){ 
            return json4(json, dislike); 
        });
    }
    function aggiungiCommento(event){
        const botton = event.currentTarget;
        fetch("commenti.php?q="+encodeURIComponent(botton.parentNode.parentNode.dataset.id)+"&commento="+encodeURIComponent(botton.parentNode.querySelector('input').value)).then(onResponse)
        .then( function (json){ return json5(json, botton); });
    }
    function json5(json,botton){
    console.log(json);
    const commenti= botton.parentNode.parentNode.querySelector('.commenti');
    const div = document.createElement('div');
    div.classList.add('div_commento');
    const autore_commento = document.createElement('div');
    autore_commento.textContent = json.nome + ' ' + json.cognome;
    autore_commento.classList.add('h1_1')
    const testo = document.createElement('div');
    testo.classList.add('p');
    testo.textContent = json.Testo;
    div.appendChild(autore_commento);
    div.appendChild(testo);
    commenti.appendChild(div);
    
}


    