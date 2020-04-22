<?php


#$troca = 0;

if(isset($_GET['fich']) && $_GET['fich'] != "" && $_GET['id']){	

	$exec = shell_exec("teste.bat ".$_GET['fich']." ".$_GET['url']." ".$_GET['id']." ".$_GET['evaluee_id']);
	
}

?>