<?php

	session_start();
	require_once 'controler/home/preencheHome.php';
	if(!isset($_SESSION['NOME_PESSOA'])){
		header('Location: index.php?erro=1');
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
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
	</head>

	<body>

		<!-- Static navbar -->
	    <?php include 'navegacao.php';?>


	    <div class="container">
	    	
			<div class="row">
		    	<div class="col-md-6">
		    		<div id="grafPizzaTipoInvestimento" ></div>
		    	</div>
		    	<div class="col-md-6"></div>
			</div>
			<div class="row">
		    	<div class="col-md-4"></div>
		    	<div class="col-md-4">
		    		Usuário autenticado!
		    		<br />
		    		<?= $_SESSION['ID_PESSOA'] ?>
		    		<br />
		    		<?= $_SESSION['NOME_PESSOA'] ?>
		    		<br />
		    		<?= $_SESSION['EMAIL_PESSOA'] ?>
	
				</div>
				<div class="col-md-4"></div>
			</div>

			<div class="clearfix"></div>
			<br />
			
		</div><!-- /container -->


	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
		<!-- monta gráfico pizza highcharts do tipo investimento -->
			<script>
				// Radialize the colors
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
				
				// Build the chart
				Highcharts.chart('grafPizzaTipoInvestimento', {
				    chart: {
				        plotBackgroundColor: null,
				        plotBorderWidth: null,
				        plotShadow: false,
				        type: 'pie'
				    },
				    title: {
				        text: 'Percentual por Tipo de Investimento'
				    },
				    tooltip: {
				        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br/> Valor: <b>R$ {point.y:.1f}</b>'
				    },
				    plotOptions: {
				        pie: {
				            allowPointSelect: true,
				            cursor: 'pointer',
				            dataLabels: {
				                enabled: true,
				                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
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
					        <?php foreach ($listaInvestimentoPorTipo as $investimentoBO){?>
				            { name: '<?=$investimentoBO->getNomeTipoInvestimento()?>',
					          y: <?=$investimentoBO->getSomaSaldoLiquido()?> },
				            <?php }?>
				        ]
				    }]
				});
	
	</script>	
	</body>
</html>