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