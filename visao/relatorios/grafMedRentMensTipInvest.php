<?php

session_start();
if(!isset($_SESSION['NOME_PESSOA'])){
	header('Location: index.php?erro=1');
}
require_once '../../controler/relatorios/preencheGrafMedRentMensTipInvest.php';

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
		    		<div id="grafMedRentMensTipInvest"></div>
				</div>
				<div class="clearfix"></div>
				<br />
		    </div>
		</div><!-- /container -->


		<script src="../../utils/bootstrap/js/bootstrap.min.js"></script>
		<!-- 		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
		<script>

			Highcharts.chart('grafMedRentMensTipInvest', {
			    chart: {
			        type: 'column'
			    },
			    title: {
			        text: 'Stacked column chart'
			    },
			    xAxis: {
			        categories: [
			        	<?php foreach ($listaAnoMes as $valor ) {?>
						'<?=$valor?>',
						<?php }?>
			            ]
			    },
			    yAxis: {
			        min: 0,
			        title: {
			            text: 'Total fruit consumption'
			        },
			        stackLabels: {
			            enabled: true,
			            style: {
			                fontWeight: 'bold',
			                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
			            }
			        }
			    },
			    legend: {
			        align: 'right',
			        x: -30,
			        verticalAlign: 'top',
			        y: 25,
			        floating: true,
			        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
			        borderColor: '#CCC',
			        borderWidth: 1,
			        shadow: false
			    },
			    tooltip: {
			        headerFormat: '<b>{point.x}</b><br/>',
			        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
			    },
			    plotOptions: {
			        column: {
			            stacking: 'normal',
			            dataLabels: {
			                enabled: true,
			                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
			            }
			        }
			    },
			    series: [
			    	<?php 
			    			foreach ($listaDaListaRentMensal as $listaRentMensal) {
			    			?>
			    	        {
			    	        name: '<?=$listaRentMensal[0]->getIdInvestimento()?>',
			    	        data: [
			    				<?php 
			    				foreach ($listaRentMensal as $rentabilidadeMensalBO) {
			    				?>
			    				<?=$rentabilidadeMensalBO->getValorRendimentoMensal()?>,
			    				<?php 
			    					}
			    				?>
			    				]},
			    			<?php 
			    				}
			    			?>
			    	]
			});
		
		</script>	
	</body>
</html>
