<?php

	session_start();

	if(!isset($_SESSION['NOME_PESSOA'])){
		header('Location: index.php?erro=1');
	}
	include 'consultaInstFinanceiras.php';
	
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
		<link rel="stylesheet" href="utils/bootstrap/css/bootstrap.min.css"><!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
	
	</head>

	<body>

		<!-- Static navbar -->
	    <?php include '/visao/home/navegacao.php';?>


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-2">
	    		<br />
	    		<br />
	    		<div>
	    		<a class="btn btn-primary" href="cadastroInstituicao.php?menuInst=1&" role="button">Nova Instituição</a>
	    		</div>
	    	</div>
	    	<div class="col-md-8">
	    	<?php 
	    	if ($msgIncluir) {
	    	?>
	    		<div class="alert alert-success alert-dismissible fade in" role="alert"> 
	    			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    				<span aria-hidden="true">×</span>
	    			</button> 
	    			<strong>Instituição Financeira incluída com Sucesso!</strong> 
	    		</div>
	    	<?php 
	    	}elseif ($msgAlterar) {
	    	?>
	    		<div class="alert alert-warning alert-dismissible fade in" role="alert"> 
	    			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    				<span aria-hidden="true">×</span>
	    			</button> 
	    			<strong>Instituição Financeira alterada com Sucesso!</strong> 
	    		</div>
	    	<?php 
	    	}elseif ($msgExcluir) {
	    	?>
	    		<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
	    			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    				<span aria-hidden="true">×</span>
	    			</button> 
	    			<strong>Instituição Financeira excluída com Sucesso!</strong> 
	    		</div>
	    	<?php 
	    	}
	    	?>
				<table class="table table-striped table-bordered table-hover table-responsive"> 
					<caption>Instituições Financeiras.</caption> 
					<thead> 
						<tr> 
							<th>CNPJ</th> 
							<th>Nome Instituição</th> 
							<th>Agência</th> 
							<th>Conta</th> 
							<th></th> 
						</tr> 
					</thead> 
					<tbody> 
					<?php while ($linha = mysqli_fetch_array($resultado_id,MYSQLI_ASSOC)){?>
						<tr> 
							<th scope="row"><?= substr($linha['CNPJ_INST_FINANCEIRA'], 0,2).".".substr($linha['CNPJ_INST_FINANCEIRA'], 2,3).".".substr($linha['CNPJ_INST_FINANCEIRA'], 5,3)."/".substr($linha['CNPJ_INST_FINANCEIRA'], 8,4)."-".substr($linha['CNPJ_INST_FINANCEIRA'], -2)?></th> 
							<td><?= $linha['NOME_INST_FINANCEIRA']?></td> 
							<td><?= $linha['AGENCIA_INST_FINANCEIRA']?></td> 
							<td><?= $linha['CONTA_INST_FINANCEIRA']?></td> 
							<td>
								<a href="consultaInstFinanceiras.php?menuInst=1&codInst=<?= $linha['ID_INST_FINANCEIRA']?>">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</a>
								<button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal" data-whatever="<?= $linha['ID_INST_FINANCEIRA']."|".$linha['NOME_INST_FINANCEIRA']?>">
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
			        Ao excluir esta instituição não poderá ser mais recuperada.
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			        <a class="btn btn-primary" id="btnExcluir" href="#" role="button">Excluir</a>
			      </div>
			    </div>
			  </div>
			</div>
	    	
	    	
			</div>
			<div class="col-md-2"></div>

			<div class="clearfix"></div>
			<br />
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>

		</div>

		<script src="utils/bootstrap/js/bootstrap.min.js">
		</script><!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --></script>
		<script type="text/javascript">

		$('#myModal').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget) // Button that triggered the modal
			  var recipient =  button.data('whatever') 
			  var resultado = recipient.split("|") // Extract info from data-* attributes
			  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			  var modal = $(this)
			  modal.find('.modal-title').text('Excluir a instituição ' + resultado[1] +"?")
			  document.getElementById("btnExcluir").href="excluirInstituicao.php?excluir=" + resultado[0]
// 			  modal.find('.modal-footer a').href="cadastroInstituicao.php?menuInst=1&"
			})

		</script>
	
	</body>
</html>