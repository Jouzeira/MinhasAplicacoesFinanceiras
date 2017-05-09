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