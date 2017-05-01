<script>
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
		        <?php foreach ($listaInvestimentoPorTipo as $investimentoBO){?>
	            { name: '<?=$investimentoBO->getNomeTipoInvestimento()?>',
		          y: <?=$investimentoBO->getSomaSaldoLiquido()?> },
	            <?php }?>
	        ]
	    }]
	});

</script>