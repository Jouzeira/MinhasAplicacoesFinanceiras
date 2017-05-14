<?php

session_start();
if(!isset($_SESSION['NOME_PESSOA'])){
	header('Location: index.php?erro=1');
}
require_once '../../controler/relatorios/preencheGrafHistoricoEvolucao.php';

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
		    		<div id="grafHistoricoEvolucao"></div>
				</div>
				<div class="clearfix"></div>
				<br />
		    </div>
		</div><!-- /container -->


		<script src="../../utils/bootstrap/js/bootstrap.min.js"></script>
		<!-- 		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
		<script>
			Highcharts.chart('grafHistoricoEvolucao', {
				chart: {
					type: 'spline'
				},
				title: {
					text: 'Evolução do Saldo Líquido das Aplicações'
				},
				subtitle: {
					text: '...'
				},
				xAxis: {
					type: 'datetime',
					dateTimeLabelFormats: { // don't display the dummy year
						month: '%e. %b',
						year: '%b'
					},
					title: {
						text: 'Período'
					}
				},
				yAxis: {
					title: {
						text: 'Valor (R$)'
					},
					min: 0
				},
				tooltip: {
					headerFormat: '<b>{series.name}</b><br>',
					pointFormat: '{point.x:%e. %b}:  R$ {point.y:.2f}'
				},
				
				plotOptions: {
					spline: {
						marker: {
							enabled: true
						}
					}
				},
				
				series: [
					<?php 
					foreach ($listaDaLista as $listaRelHistoricoInvestimentoBO) {
					?>
						{
							name: <?="'".$listaRelHistoricoInvestimentoBO[0]->getNome()."'"?>,
							data: [
								<?php
								foreach ($listaRelHistoricoInvestimentoBO as $relHistoricoInvestimentoBO) {
								?>
									[Date.UTC(
											<?=date( 'Y', strtotime( $relHistoricoInvestimentoBO->getData()) );?>
											,<?=date( 'm', strtotime( $relHistoricoInvestimentoBO->getData()) )-1;?>
											,<?=date( 'd', strtotime( $relHistoricoInvestimentoBO->getData()) );?>),
											<?=$relHistoricoInvestimentoBO->getValor();?>],
								<?php
								}
								?>
							]
						},
					<?php 
					}
					?>
	
				]
			});
		</script>	
	</body>
</html>


















































<script>
Highcharts.chart('grafHistoricoEvolucao', {
	chart: {
		type: 'spline'
	},
	title: {
		text: 'Evolução do Saldo Líquido das Aplicações'
	},
	subtitle: {
		text: '...'
	},
	xAxis: {
		type: 'datetime',
		dateTimeLabelFormats: { // don't display the dummy year
			month: '%e. %b',
			year: '%b'
		},
		title: {
			text: 'Período'
		}
	},
	yAxis: {
		title: {
			text: 'Valor (R$)'
		},
		min: 0
	},
	tooltip: {
		headerFormat: '<b>{series.name}</b><br>',
		pointFormat: '{point.x:%e. %b}:  R$ {point.y:.2f}'
	},
	
	plotOptions: {
		spline: {
			marker: {
				enabled: true
			}
		}
	},
	
	series: [
		<?php 
		foreach ($listaDaLista as $listaRelHistoricoInvestimentoBO) {
		?>
			{
				name: <?="'".$listaRelHistoricoInvestimentoBO[0]->getNome()."'"?>,
				data: [
					<?php
					foreach ($listaRelHistoricoInvestimentoBO as $relHistoricoInvestimentoBO) {
					?>
						[Date.UTC(
								<?=date( 'Y', strtotime( $relHistoricoInvestimentoBO->getData()) );?>
								,<?=date( 'm', strtotime( $relHistoricoInvestimentoBO->getData()) )-1;?>
								,<?=date( 'd', strtotime( $relHistoricoInvestimentoBO->getData()) );?>),
								<?=$relHistoricoInvestimentoBO->getValor();?>],
					<?php
					}
					?>
				]
			},
		<?php 
		}
		?>

	]
});

</script>