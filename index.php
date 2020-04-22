<?php  

//Variavel global para que direciona a URL certa 
$REQUEST_URI = filter_input(INPUT_SERVER, 'REQUEST_URI');
//Verifica se existe na $REQUEST_URI, e vai armazenar na variavel $INITE
$INITE = strpos($REQUEST_URI, '?');

if($INITE):
	$REQUEST_URI = substr($REQUEST_URI, 0, $INITE);
endif;
	$REQUEST_URI = substr($REQUEST_URI, 1);
	$URL = explode('/', $REQUEST_URI);
	$URL [0] = ($URL[0] != '' ? $URL[0] : 'home');

#$verifica = ('testePDF/index.php'. $URL[0]. '.php');

if(file_exists('testePDF/'. $URL[0]. '.php')){
	require ('testePDF/'. $URL[0]. '.php');
}else{
	require('testePDF/404.php');
} 




 

