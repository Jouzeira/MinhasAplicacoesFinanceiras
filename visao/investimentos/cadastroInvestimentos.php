<?php

session_start();
include '../../controler/investimento/preencheFormInvestimento.php';

if(!isset($_SESSION['NOME_PESSOA'])){
	header('Location: index.php?erro=1');
}

$erro_cnpj		= isset($_GET['erro_cnpj'])		? $_GET['erro_cnpj'] 	: 0;

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Minhas Aplicações Financeiras</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	
	</head>

	<body>

		<!-- Static navbar -->
	    <?php include '../../navegacao.php';?>


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-2"></div>
	    	<div class="col-md-8">
	    		<div class="col-md-12">
	    		<h3>Investimento</h3>
	    		</div>
	    		<br />
				<form method="post" action="../../controler/investimento/controleInvestimento.php" id="formCadastroInvestimento">
					<div class="form-group col-md-4">
						<select class="form-control" name="tipoCategoria" id="tipoCategoria" data-toggle="tooltip" data-placement="top" title="Tipo Categoria" required="required">
						
	  							<option value="">Tipo Categoria</option>
							<?php foreach ($listTipoCategoria as $tipoCategoria) {?>
	  							<option value="<?= $tipoCategoria->getId()?>"><?= $tipoCategoria->getNomeTipoCategoria()?></option>
	  						<?php }?>
						</select>
						
					</div>
					<div class="form-group col-md-4">
						<select class="form-control" name="tipoRenda" id="tipoRenda" data-toggle="tooltip" data-placement="top" title="Tipo Renda" required="required">
						
	  							<option value="">Tipo Renda</option>
							<?php foreach ($listTipoRenda as $tipoRenda) {?>
	  							<option value="<?= $tipoRenda->getId()?>"><?= $tipoRenda->getNomeTipoRenda()?></option>
	  						<?php }?>
						</select>
						
					</div>
					<div class="form-group col-md-4">
						<select class="form-control" name="tipoInvestimento" id="tipoInvestimento" data-toggle="tooltip" data-placement="top" title="Tipo Investimento" required="required">
						
	  							<option value="">Tipo Investimento</option>
							<?php foreach ($listTipoInvestimento as $tipoInvestimento) {?>
	  							<option value="<?= $tipoInvestimento->getId()?>"><?= $tipoInvestimento->getNomeTipoInvestimento()?></option>
	  						<?php }?>
						</select>
						
					</div>
					<div class="form-group col-md-12">
						<select class="form-control" name="instituicao" id="instituicao"  data-toggle="tooltip" data-placement="top" title="Instituição Financeira" required="required">
						
	  							<option value="">Instituição Financeira</option>
							<?php foreach ($listInstFinanceira as $instituicao) {?>
	  							<option value="<?= $instituicao->getId()?>"><?= $instituicao->getNome()?></option>
	  						<?php }?>
						</select>
						
					</div>

					<div class="form-group col-md-12">
						<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Investimento Financeira" required="required"
						value="" maxlength="100" data-toggle="tooltip" data-placement="top" title="Nome do Investimento Financeira">
					</div>
					<div class="form-group col-md-4">
						<input type="date" class="form-control" id="dataAplicacao" name="dataAplicacao" placeholder="Data Aplicação" required="required"
						value="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Data Aplicação">
					</div>
					<div class="form-group col-md-4">
						<input type="date" class="form-control" id="dataResgate" name="dataResgate" placeholder="Data Min. Resgate" 
						value="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Data Min. Resgate">
					</div>
					<div class="form-group col-md-4">
						<input type="date" class="form-control" id="dataVencimento" name="dataVencimento" placeholder="Data Vencimento"  
						value="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Data Vencimento"> 
					</div>
					<div class="form-group col-md-12">
						<div class="input-group">
						<div class="input-group-addon">R$</div>
						<input type="text" class="form-control" id="valorAplicado" name="valorAplicado" placeholder="Valor aplicado" required="required" 
						value="" maxlength="15" pattern="[0-9]{1,9},[0-9]{2}$" data-toggle="tooltip" data-placement="top" title="Valor aplicado">
						<div class="input-group-addon">0,00</div>
						</div>
					</div>
					<div class="form-group col-md-6">
						<div class="input-group">
						<div class="input-group-addon">R$</div>
						<input type="text" class="form-control" id="taxaContratada" name="taxaContratada" placeholder="Taxa Contratada"  
						value="" maxlength="6" pattern="[0-9]{1,9},[0-9]{2}$" data-toggle="tooltip" data-placement="top" title="Taxa Contratada">
						<div class="input-group-addon">0,00</div>
						</div>
					</div>
					<div class="form-group col-md-6">
						<div class="input-group">
						<div class="input-group-addon">R$</div>
						<input type="text" class="form-control" id="taxaCorretagem" name="taxaCorretagem" placeholder="Taxa Corretagem"  
						value="" maxlength="6" pattern="[0-9]{1,9},[0-9]{2}$" data-toggle="tooltip" data-placement="top" title="Taxa Corretagem">
						<div class="input-group-addon">0,00</div>
						</div>
					</div>
					<div class="form-group col-md-12">
					<button type="submit" class="btn btn-primary form-control">Cadastrar</button>
					</div>
				</form>
			</div>
			<div class="col-md-2"></div>

			<div class="clearfix"></div>
			<br />
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>

		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script>  function formatar(mascara, documento){   
					var i = documento.value.length;   
					var saida = mascara.substring(0,1);   
					var texto = mascara.substring(i)     
					if (texto.substring(0,1) != saida){    
						documento.value += texto.substring(0,1);   
					}    
				}

		$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			})
		</script>
	
	</body>
</html>
