<?php

session_start();
if(!isset($_SESSION['NOME_PESSOA'])){
	header('Location: index.php?erro=1');
}
require_once '../../controler/relatorios/preencheGrafInstituicaoFinanceira.php';

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
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --> 
	
	</head>

	<body>

		<!-- Static navbar -->
	    <?php include '../home/navegacao.php';?>

	    <div class="container">
		    <div class="row">
		    	<div class="col-md-3">
					<?php require_once 'menuRelatorios.php'; ?>
		    	</div>
		    	<div class="col-md-9">
		    		<div id="grafPizzaInstituicao" ></div>
				</div>
				<div class="clearfix"></div>
				<br />
		    </div>
		</div><!-- /container -->


		<script src="../../utils/bootstrap/js/bootstrap.min.js"></script>
		<!-- 		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
		<script>
			Highcharts.chart('grafPizzaInstituicao', {
			    chart: {
			        plotBackgroundColor: null,
			        plotBorderWidth: null,
			        plotShadow: false,
			        type: 'pie'
			    },
			    title: {
			        text: 'Percentual por Instituição Financeira'
			    },
			    tooltip: {
			        pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b><br/> Valor: <b>R$ {point.y:.2f}</b>'
			    },
			    plotOptions: {
			        pie: {
			            allowPointSelect: true,
			            cursor: 'pointer',
			            dataLabels: {
			                enabled: true,
			                format: '<b>{point.name}</b>: {point.percentage:.2f} %',
			                style: {
			                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			                },
			                connectorColor: 'silver'
			            }
			        }
			    },
			    series: [{
			        name: 'Percentual',
			        data: [
				        <?php foreach ($listaInvestimentoPorInstituicao as $investimentoBO){?>
			            { name: '<?=$investimentoBO->getNomeInstituicao()?>',
				          y: <?=$investimentoBO->getSomaSaldoLiquido()?> },
			            <?php }?>
			        ]
			    }]
			});
		</script>

	</body>
</html>
