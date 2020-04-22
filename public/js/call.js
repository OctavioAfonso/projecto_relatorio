function teste()
	{
		fetch("gerarPDF.php?fich="+nomeFicheiro.value+"&url="+urlReport.value+"&id="+idEvaluation.value+"&idavaliad="+idAvaliado.value+"&idavaliadoo="+idAvaliador.value)
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
