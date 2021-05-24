<?php
require_once 'Autenticazione.php';
if(!Autenticazione())exit;

header('Content-Type: application/json');

switch($_GET['type']){
case'Birre':ricetta_birre();break;
case'Cibo':ricetta_cibi();break;

default:break;
}

function ricetta_birre(){

$query=urlencode($_GET['q']);
$url='https://api.punkapi.com/v2/beers?beer_name='.$query.'&per_page=6';
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
$data=curl_exec($ch);
$json=json_decode($data,true);
curl_close($ch);

echo($data);
}
function ricetta_cibi(){
    $id='10a96d23';
    $key='7c84EA8D37B610AB46e1c543038454B5';


    $query=urlencode($_GET['q']);
    $url='https://api.edamam.com/search?q='.$query. '&app_id='.$id. '&app_key='.$key. 'per_page=6';
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
    $data=curl_exec($ch);
    $json=json_decode($data,true);
    curl_close($ch);

    echo ($data);
    
}

?>