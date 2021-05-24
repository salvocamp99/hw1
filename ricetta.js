function cerca(event){
content={};
const form_data=new FormData(document.querySelector("section form"));
content.type=form_data.get('type');
fetch("cerca_ricetta.php?type="+content.type+"&q="+encodeURIComponent(form_data.get('cerca'))).then(onResponse).then(onJson);
document.getElementById('barra_ricerca').blur();

const contenitore=document.getElementById('lista');
contenitore.innerHTML='';
const caricamento=document.createElement('img');
caricamento.src="caricamento.svg";
caricamento.classList.add('caricamento');
contenitore.appendChild(caricamento);
event.preventDefault();
}
function NessunRisultato(){
    const contenitore=document.getElementById('lista');
    contenitore.innerHTML='';
    const no_ris=document.createElement('div');
    no_ris.classList.add('caricamento');
    no_ris.textContent="Nessun Risultato per questa ricerca";
    contenitore.appendChild(no_ris);

}
function onResponse(response){
    console.log(response);
    return response.json();
}
function onJson(json){
console.log(json);
if (json.length==0){
NessunRisultato();
return;

}
switch(content.type){
case 'Birre':jsonBirre(json,'Birre');break;
case 'Cibo':jsonCibi(json,'Cibo');break;
}

}
  
function jsonBirre(json){
console.log(json);
const contenitore=document.querySelector('#lista');
contenitore.innerHTML="";
for(let i=0;i<json.length;i++){
    const doc=json[i];
    const id=doc.id;
    const img=doc.image_url;
    const title=doc.name;
    const tipo_malto=doc.ingredients.malt;
    const tipo_luppolo=doc.ingredients.hops;

const div=document.createElement('div');
div.classList.add('birra');
div.dataset.id=id;
const immagine=document.createElement('img');
immagine.src=img;
immagine.classList.add('immagine');
immagine.addEventListener("click",Modale);
const nome=document.createElement('h1');
nome.textContent=title;
nome.classList.add('testo1');
div.appendChild(immagine);
div.appendChild(nome);
contenitore.appendChild(div);
const tipo_di_malto=document.createElement('p');
    tipo_di_malto.textContent='Tipi di malto per la preparazione:';
    tipo_di_malto.classList.add('ingredienti');
    div.appendChild(tipo_di_malto);

    for(malto of tipo_malto){
        const ingrediente1=malto.name;
        const ingrediente2=malto.amount.value;
        const ingrediente3=malto.amount.unit;
        
        const i1=document.createElement('p');
        i1.textContent=ingrediente1 + '(' +ingrediente2 + ingrediente3 + ')';
        i1.classList.add('paragrafo');
        div.appendChild(i1);
        }

    const tipo_di_luppolo=document.createElement('p');
    tipo_di_luppolo.textContent='Tipi di luppolo per la preparazione:';
    tipo_di_luppolo.classList.add('ingredienti');
    div.appendChild(tipo_di_luppolo);

        for(luppolo of tipo_luppolo){
            const ingrediente4=luppolo.name;
            const ingrediente5=luppolo.amount.value;
            const ingrediente6=luppolo.amount.unit;
            
            const i4=document.createElement('p');
            i4.textContent=ingrediente4 + '(' +ingrediente5 + ingrediente6 + ')';
            i4.classList.add('paragrafo');
            div.appendChild(i4);
            }
        
            

}
}


function jsonCibi(json){
console.log(json);
}

const bottone=document.forms['cerca'];
bottone.addEventListener("submit",cerca);

function Modale(event){
    const immagine=document.createElement('img');
    immagine.src=event.currentTarget.src;
    const modale=document.querySelector('#modale');
    modale.appendChild(immagine);
    modale.classList.remove('hidden');
    document.body.classList.add('no-scroll');
   }
   const mod=document.querySelector('#modale');
   mod.addEventListener('click',chiudiModale);
   
   function chiudiModale(event){
   document.body.classList.remove('no-scroll');
   mod.classList.add('hidden');
   mod.innerHTML="";
    }
    function aggiungiPreferiti(event){ 
    event.currentTarget.parentNode.dataset.id;
    event.currentTarget.remove();
    fetch("ricette_preferite.php",{method:'POST',body:formData}).then(onResponse).then(onJson2);
    }
    function onJson2(json){
    console.log(json);
    }