<?php

	session_start();
	require_once '../../controler/home/preencheHome.php';
	if(!isset($_SESSION['NOME_PESSOA'])){
		header('Location: ../../index.php?erro=1');
	}

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">	

		<title>M.A.F</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		
		<!-- highcharts - link cdn -->
		<script src="../../utils/highcharts/code/highcharts.js"></script>
		<script src="../../utils/highcharts/code/modules/exporting.js"></script>
<!-- 		<script src="https://code.highcharts.com/highcharts.js"></script> -->
<!-- 		<script src="https://code.highcharts.com/modules/exporting.js"></script> -->

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="../../utils/bootstrap/css/bootstrap.min.css">
<!-- 		<link rel="stylesheet" href="../../utils/bootstrap/css/bootstrap.min.css"><!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
	
	</head>

	<body>

		<!-- Static navbar -->
	    <?php include 'navegacao.php';?>


	    <div class="container">
	    	
				<div class="row">
			    	<div class="col-md-6">
			    		<div id="grafPizzaTipoInvestimento" ></div>
			    	</div>
			    	<div class="col-md-6">
			    		<div id="grafPizzaInstituicao" ></div>
			    	</div>
				</div>
				<br>
				<div class="row">
			    	<div class="col-md-12">
			    		<div id="capitalSaldoLiquido"></div>
			    	</div>
				</div> 
				<div class="clearfix"></div>
				<br />
		</div><!-- /container -->


		<script src="../../utils/bootstrap/js/bootstrap.min.js"></script>
		<!-- 		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
			<script>
				Radialize the colors
				Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
				    return {
				        radialGradient: {
				            cx: 0.5,
				            cy: 0.3,
				            r: 0.7
				        },
				        stops: [
				            [0, color],
				            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
				        ]
				    };
				});
	</script>	
				
<!-- monta gráfico pizza highcharts do tipo investimento -->
		<?php require_once '../../visao/relatorios/grafTipoInvestimento.php';?>

<!-- Percentual por Instituição Financeira -->
		<?php require_once '../../visao/relatorios/grafInstituicaoFinanceira.php';?>
				
<!-- Capital Aplicado x Saldo Líquido Atual --> 
		<?php require_once '../../visao/relatorios/grafCapitalSaldoLiquido.php';?>
	
	</body>
</html>