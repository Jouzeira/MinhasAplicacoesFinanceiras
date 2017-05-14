<?php

session_start();
if(!isset($_SESSION['NOME_PESSOA'])){
	header('Location: index.php?erro=1');
}

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>M.A.F</title>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="../../utils/bootstrap/css/bootstrap.min.css">
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --> 
	
		<!-- 	CSS styles jTable  -->
	    <link href="../../utils/jTable/themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
		<link href="../../utils/jTable/scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
		<!-- jTable script file -->
<!-- 		<script src="../../utils/jTable/scripts/jquery-1.11.3.min.js" type="text/javascript"></script> -->
		<script src="../../utils/jTable/scripts/jquery-1.6.4.min.js" type="text/javascript"></script> 
	    <script src="../../utils/jTable/scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	    <script src="../../utils/jTable/scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
	
	</head>

	<body>

		<!-- Static navbar -->
	    <?php include '../home/navegacao.php';?>

	    <div class="container">
		    <div class="row">
		    	<div class="col-md-12">
		    		<div id="consolidadoJTable"></div>
				</div>
				<div class="clearfix"></div>
				<br />
		    </div>
		</div><!-- /container -->


		<script src="../../utils/bootstrap/js/bootstrap.min.js"></script>
		<!-- 		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
		<script type="text/javascript">

			$(document).ready(function () {
	
			    //Prepare jTable
				$('#consolidadoJTable').jtable({
					title: 'Consolidado de Rentabilidade Mensal',
					paging: true,
					pageSize: 10,
					sorting: true,
					defaultSorting: 'ID_INVESTIMENTO ASC',
					actions: {
						listAction:   '../../controler/relatorios/controleConsolidadoJTable.php?action=list'
					},
					fields: {
						ID_INVESTIMENTO: {
							title: 'Código',
							key: true,
							visibility: "hidden"
						},
						ANO_MES: {
							title: 'Mês/Ano',
							width: '10%',
							create: false,
							edit: false
						},
						NOME_INVESTIMENTO: {
							title: 'Nome',
							width: '35%'
						},
						VL_APLICACAO_INVESTIMENTO: {
							title: 'Valor Aplicado',
							width: '15%'
						},
						VL_SALDO_LIQUIDO_INVESTIMENTO: {
							title: 'Média Rendimento Mensal',
							width: '25%'
						},
						VL_RENDIMENTO_MENSAL: {
							title: 'Média Saldo Líquido',
							width: '15%'
						}
					},
	
					messages: {
						serverCommunicationError: 'Erro de comunicação com o servidor.',
						loadingMessage: 'Buscando Registros...',
						noDataAvailable: 'Nenhum dado encontrado!',
						addNewRecord: 'Adicionar ',
						editRecord: 'Editar ',
						areYouSure: 'Tem certeza?',
						deleteConfirmation: 'Tem certeza que deseja excluir?',
						save: 'Salvar',
						saving: 'Salvando',
						cancel: 'Cancelar',
						deleteText: 'Excluir',
						deleting: 'Excluindo',
						error: 'Erro',
						close: 'Fechar',
						cannotLoadOptionsFor: 'Can not load options for field {0}',
						pagingInfo: 'Mostrando {0}-{1} de {2}',
						pageSizeChangeLabel: 'Quantidade de linhas por página',
						gotoPageLabel: 'Ir para a página',
						canNotDeletedRecords: 'Can not deleted {0} of {1} records!',
						deleteProggress: 'Deleted {0} of {1} records, processing...'
					}
	
					
				});
	
		        //Re-load records when user click 'load records' button.
// 		        $('#btFiltro').click(function (e) {
// 		            e.preventDefault();
// 					var valorOrigem 	= $('#origem').val();
// 					var valorData 		= $('#data').val();
// 					//alert(valorData);
// 					//document.write(valorOrigem); 	
// 					console.log(valorOrigem + " " + valorData);
// 		            $('#PeopleTableContainer').jtable('load', {
// 			            origem: 	valorOrigem,
// 			            data:		valorData
// 			         });
// 		        });
		 
		        //Load all records when page is first shown
// 		        $('#btFiltro').click();

				//Load person list from server
				$('#consolidadoJTable').jtable('load');
				
			});

	</script>

	</body>
</html>

























