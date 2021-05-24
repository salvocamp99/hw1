fetch("home.php").then(onResponse).then(onJson);

function onResponse(response){
return response.json();
}


function onJson(json){
console.log(json);
for(jsonElem of json){
const main=document.querySelector("#main-conteiner");
let contenitore=document.createElement('div');
let img=document.createElement('img');
img.src=jsonElem.immagine;
contenitore.appendChild(img);
let nome1=document.createElement('h1');
nome1.textContent=jsonElem.nome_ristorante; 
contenitore.appendChild(nome1);
let descrizione=document.createElement("p");
descrizione.textContent=jsonElem.descrizione;
contenitore.appendChild(descrizione);
main.appendChild(contenitore);
}       
}
  
  
    
   
  

   
   
    
    
    



   