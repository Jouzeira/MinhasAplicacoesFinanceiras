<?php

session_start();
include '../../controler/historicoInvestimento/preencheAtualizaHistoricoInvest.php';

if(!isset($_SESSION['NOME_PESSOA'])){
	header('Location: index.php?erro=1');
}

$msgErroValorMenor= isset($_GET['msgErroValorMenor'])		? $_GET['msgErroValorMenor'] 	: 0;
$msgErroData= isset($_GET['msgErroData'])		? $_GET['msgErroData'] 	: 0;

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
	    <div class="col-md-12 page-header">
	    	<div class="col-md-12">
	    		<h3><?=$investimentoBO->getNomeInvestimento()?></h3>
	    	</div>
	    	<div class="col-md-3">
	    		<label class="control-label " for="">Instituição Financeira</label>
	    		<h5><?=$investimentoBO->getIdInstFinanceira()?></h5>
	    	</div>
	    	<div class="col-md-3">
	    		<label class="control-label " for="">Tipo Investimento</label>
	    	<h5><?=$investimentoBO->getIdTipo()?></h5></div>
	    	<div class="col-md-2">
	    		<label class="control-label " for="">Data da Aplicação</label>
	    	<h5><?=$investimentoBO->getDataAplicacaoFormatada()?></h5></div>
	    	<div class="col-md-2">
	    		<label class="control-label " for="">Valor Aplicado</label>
	    	<h5><?=$investimentoBO->getValorAplicacaoFormatado()?></h5></div>
	    	<div class="col-md-2">
	    		<label class="control-label " for="">Saldo Líquido</label>
	    	<h5><?=$investimentoBO->getValorSaldoLiquidoFormatado()?></h5></div>
		</div>
	    <div class="col-md-12 page-header">
	    	<?php 
	    	if ($msgErroValorMenor) {
	    	?>
	    		<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
	    			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    				<span aria-hidden="true">×</span>
	    			</button> 
	    			<strong>O Valor líquido atual não pode ser menor que o valor do Saldo Líquido!</strong> 
	    		</div>
	    	<?php 
	    	}
	    	?>
	    	<?php 
	    	if ($msgErroData) {
	    	?>
	    		<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
	    			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    				<span aria-hidden="true">×</span>
	    			</button> 
	    			<strong>Já existe atualização para a data informada!</strong> 
	    		</div>
	    	<?php 
	    	}
	    	?>
	    		<div class="col-md-12">
	    		
	    		<h3>Atualizar Saldo Líquido</h3>
	    		</div>
				<form method="post" action="../../controler/historicoInvestimento/controleHistoricoInvest.php?acao=cadastrar" id="formCadastroInvestimento">

					<div class="form-group col-md-3">
			    		<label class="control-label " for="dtAtualizacao">Data Atualização</label>
						<input type="date" class="form-control" id="dtAtualizacao" name="dtAtualizacao" placeholder="Data Atualização" required="required"
						value="" maxlength="10" >
					</div>
					<div class="form-group col-md-4">
			    		<label class="control-label " for="valorLiquido">Valor líquido atual</label>
						<div class="input-group">
						<div class="input-group-addon">R$</div>
						<input type="text" class="form-control" id="valorLiquido" name="valorLiquido" placeholder="Valor líquido" required="required" 
						value="" maxlength="15" pattern="[0-9]{1,9},[0-9]{2}$" >
						<div class="input-group-addon">0,00</div>
						</div>
					</div>
					<input type="hidden" id="idInvestimento" name="idInvestimento" value="<?=$investimentoBO->getId()?>"/>
					<input type="hidden" id="saldoLiquido" name="saldoLiquido" value="<?=$investimentoBO->getValorSaldoLiquidoPadraoTela()?>"/>
					<div class="form-group col-md-3">
			    		<label class="control-label " for="botao"></label>
						<button type="submit" class="btn btn-primary form-control">Registrar</button>
					</div>
					<div class="form-group col-md-2">
					</div>
				</form>
		</div>
			<div class="col-md-12">
				<div class="col-md-12">
					<table class="table table-striped table-bordered table-hover table-responsive"> 
						<caption><h3>Histórico</h3></caption> 
						<thead> 
							<tr> 
								<th>Data Atualização</th> 
								<th>Valor líquido</th> 
							</tr> 
						</thead> 
						<tbody> 
						<?php foreach ($listaHistorico as $historicoInvestimentoBO) {?>
							<tr> 
								<td><?=$historicoInvestimentoBO->getDtAtualizacaoFormatado()?></td> 
								<td><?=$historicoInvestimentoBO->getValorLiquidoFormatado()?></td> 
							</tr> 
						<?php }?>
						</tbody> 
					</table>
				</div>
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
