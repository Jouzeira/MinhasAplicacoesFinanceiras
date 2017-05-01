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
					        <?php foreach ($listaInvestimentoPorInstituicao as $investimentoBO){?>
				            { name: '<?=$investimentoBO->getNomeInstituicao()?>',
					          y: <?=$investimentoBO->getSomaSaldoLiquido()?> },
				            <?php }?>
				        ]
				    }]
				});
</script>