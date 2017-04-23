<?php

session_start();

if(!isset($_SESSION['NOME_PESSOA'])){
	header('Location: index.php?erro=1');
}
require_once '../../controler/investimento/preencheListaInvestimentos.php';

$msgIncluir = isset($_GET['msgIncluir'])		? $_GET['msgIncluir'] 	: 0;
$msgAlterar = isset($_GET['msgAlterar'])		? $_GET['msgAlterar'] 	: 0;
$msgExcluir = isset($_GET['msgExcluir'])		? $_GET['msgExcluir'] 	: 0;

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>M.A.F</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
	</head>

	<body>

		<!-- Static navbar -->
	    <?php include '../../navegacao.php';?>


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-2">
	    		<br />
	    		<?= $_SESSION['NOME_PESSOA'] ?>
	    		<br />
	    		<div>
	    		<a class="btn btn-primary" href="cadastroInvestimentos.php?menuInvest=1&" role="button">Novo Investimento</a>
<!-- 	    		<a class="btn btn-primary" href="cadastroInvestimentos.php?menuInvest=1&" role="button">Novo Investimento</a> -->
	    		</div>
	    	</div>
	    	<div class="col-md-10">
	    	<?php 
	    	if ($msgIncluir) {
	    	?>
	    		<div class="alert alert-success alert-dismissible fade in" role="alert"> 
	    			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    				<span aria-hidden="true">×</span>
	    			</button> 
	    			<strong>Investimento incluído com Sucesso!</strong> 
	    		</div>
	    	<?php 
	    	}elseif ($msgAlterar) {
	    	?>
	    		<div class="alert alert-warning alert-dismissible fade in" role="alert"> 
	    			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    				<span aria-hidden="true">×</span>
	    			</button> 
	    			<strong>Investimento alterado com Sucesso!</strong> 
	    		</div>
	    	<?php 
	    	}elseif ($msgExcluir) {
	    	?>
	    		<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
	    			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    				<span aria-hidden="true">×</span>
	    			</button> 
	    			<strong>Investimento excluído com Sucesso!</strong> 
	    		</div>
	    	<?php 
	    	}
	    	?>
				<table class="table table-striped table-bordered table-hover table-responsive"> 
					<caption>Investimentos</caption> 
					<thead> 
						<tr> 
							<th>Renda</th> 
							<th>Tipo Invest.</th> 
							<th>Instituição</th> 
							<th>Nome Invest.</th> 
							<th>Dt. Aplicação</th> 
							<th>Valor Aplicado</th> 
							<th></th> 
						</tr> 
					</thead> 
					<tbody> 
					<?php foreach ($listaInvestimentoBO as $investimentoBO) {?>
						<tr> 
							<td><?=$investimentoBO->getIdTipoRenda()?></td> 
							<td><?=$investimentoBO->getIdTipo()?></td> 
							<td><?=$investimentoBO->getIdInstFinanceira()?></td> 
							<td><?=$investimentoBO->getNomeInvestimento()?></td> 
							<td><?=$investimentoBO->getDataAplicacao()?></td> 
							<td><?=$investimentoBO->getValorAplicacao()?></td> 
							<td>
								<a href="consultaInstFinanceiras.php?menuInst=1&codInst=<?= $linha['ID_INST_FINANCEIRA']?>">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</a>
								<button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal" data-whatever="<?=$investimentoBO->getId()."|".$investimentoBO->getNomeInvestimento()?>">
								<span class="glyphicon glyphicon-trash" ></span>
								</button>
							</td> 
						</tr> 
					<?php }?>
					</tbody> 
				</table>
	    	
	    	<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel"></h4>
			      </div>
			      <div class="modal-body">
			        Ao excluir este investimento não poderá ser mais recuperado.
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			        <a class="btn btn-primary" id="btnExcluir" href="#" role="button">Excluir</a>
			      </div>
			    </div>
			  </div>
			</div>
	    	
	    	
			</div>

			<div class="clearfix"></div>
			<br />
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>

		</div>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script type="text/javascript">

		$('#myModal').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget) // Button that triggered the modal
			  var recipient =  button.data('whatever') 
			  var resultado = recipient.split("|") // Extract info from data-* attributes
			  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			  var modal = $(this)
			  modal.find('.modal-title').text('Excluir o investimento ' + resultado[1] +"?")
			  document.getElementById("btnExcluir").href="excluirInvestimento.php?excluir=" + resultado[0]
// 			  modal.find('.modal-footer a').href="cadastroInstituicao.php?menuInst=1&"
			})

		</script>
	
	</body>
</html>