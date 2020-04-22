<?php 
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;


?>
<html>

<head>

<script>

function teste(){
	
	fetch("gerarPDF.php?fich="+nomeFicheiro.value+"&url="+urlReport.value+"&id="+idEvaluation.value+"&idavaliad="+idAvaliado.value)
	.then(function(res){
		return res.text();
	})
	.then(function(res1){
		console.log(res1);
		document.getElementById("localPDF").src = res1;
	})
	.catch(function(err){
		alert(err);
	});
	
}

</script>

</head>

<body>
	
</body>


</html>








