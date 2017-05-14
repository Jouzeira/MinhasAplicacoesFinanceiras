<?php

session_start();
if(!isset($_SESSION['NOME_PESSOA'])){
	header('Location: index.php?erro=1');
}
require_once '../../controler/relatorios/preencheGrafCapitalSaldoLiquido.php';

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
		    		<div id="capitalSaldoLiquido"></div>
				</div>
				<div class="clearfix"></div>
				<br />
		    </div>
		</div><!-- /container -->


		<script src="../../utils/bootstrap/js/bootstrap.min.js"></script>
		<!-- 		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
		<script>
		Highcharts.chart('capitalSaldoLiquido', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Capital Aplicado x Saldo Líquido Atual'
			},
			xAxis: {
				categories: [
							        <?php foreach ($listaCapitalSaldo as $investimentoBO) {?>
						            '<?=$investimentoBO->getNomeInvestimento()?>',
						            <?php }?>
						        ],
						        crosshair: true
						    },
						    yAxis: {
						        min: 0,
						        title: {
						            text: 'Valor (R$)'
						        }
						    },
						    tooltip: {
						        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
						        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						            '<td style="padding:0"><b>R$ {point.y:.2f} </b></td></tr>',
						        footerFormat: '</table>',
						        shared: true,
						        useHTML: true
						    },
						    plotOptions: {
						        column: {
						            pointPadding: 0.2,
						            borderWidth: 0
						        }
						    },
						    series: [{
						        name: 'Capital Aplicado',
						        data: [
									<?php foreach ($listaCapitalSaldo as $investimentoBO) {?>
										<?=$investimentoBO->getValorAplicacao()?>,
									<?php }?>
							        ]
		
						    }, {
						        name: 'Saldo Líquido',
						        data: [
						        	<?php foreach ($listaCapitalSaldo as $investimentoBO) {?>
										<?=$investimentoBO->getValorSaldoLiquido()?>,
									<?php }?>
							        ]
		
						    }]
						});
		</script>	
	</body>
</html>

























