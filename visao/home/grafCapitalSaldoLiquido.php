
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
