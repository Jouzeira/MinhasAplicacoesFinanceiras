<?php

session_start();

if(!isset($_SESSION['NOME_PESSOA'])){
	header('Location: index.php?erro=1');
}

$erro_cnpj		= isset($_GET['erro_cnpj'])		? $_GET['erro_cnpj'] 	: 0;

$cnpj			= isset($_GET['cnpj'])			? $_GET['cnpj']				: "";
$nomeInst		= isset($_GET['nomeInst'])		? $_GET['nomeInst']			: "";
$codigo			= isset($_GET['codigo'])		? $_GET['codigo']			: "";
$nuAgencia		= isset($_GET['nuAgencia'])		? $_GET['nuAgencia']		: "";
$nuConta		= isset($_GET['nuConta'])		? $_GET['nuConta']			: "";
$vlTaxa			= isset($_GET['vlTaxa'])		? $_GET['vlTaxa']			: "";
$nuVerifAgencia	= isset($_GET['nuVerifAgencia'])	? $_GET['nuVerifAgencia']	: "";
$nuVerifConta	= isset($_GET['nuVerifConta'])	? $_GET['nuVerifConta']		: "";
$seqInst		= isset($_GET['seqInst'])		? $_GET['seqInst']			: 0;

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Minhas Aplicações Financeiras</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="utils/bootstrap/css/bootstrap.min.css">
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
	
	</head>

	<body>

		<!-- Static navbar -->
	    <?php include 'visao/home/navegacao.php';?>


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-4"></div>
	    	<div class="col-md-4">
	    		<h3>Instituição Financeira</h3>
	    		<br />
				<form method="post" action="registraInstituicao.php" id="formCadastroInstituicao">
					<div class="form-group">
						<input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" 
								maxlength="18" required="requiored" onkeypress="formatar('##.###.###/####-##', this);" 
								value="<?= $cnpj ?>" <?= $seqInst==0?"":" disabled"?>/>
						
						<?php 
						
							if ($erro_cnpj){ // 1 é true e 0 é false
								echo '<font style="color:#FF0000"> CNPJ já existe</font>';
							}
						
						?>
						
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nomeInst" name="nomeInst" placeholder="Nome da Instituição" required="requiored"
						value="<?= $nomeInst?>" maxlength="100">
					</div>

					<div class="form-group">
						<input type="number" class="form-control" id="codigo" name="codigo" placeholder="Código do Banco/Instituição" required="requiored"
						value="<?= $codigo?>" maxlength="10">
						
					</div>
					<div class="form-group col-md-9">
						<input type="number" class="form-control" id="nuAgencia" name="nuAgencia" placeholder="Número da Agência" required="requiored"
						value="<?= $nuAgencia?>" maxlength="11">
					</div>
					<div class="form-group col-md-3">
						<input type="number" class="form-control" id="nuVerifAgencia" name="nuVerifAgencia" placeholder="Núm Verificador Agência" 
						value="<?= $nuVerifAgencia?>" maxlength="2">
					</div>
					
					<div class="form-group col-md-9">
						<input type="number" class="form-control" id="nuConta" name="nuConta" placeholder="Número da Conta" required="requiored" maxlength="11"
						value="<?=$nuConta?>"> 
					</div>
					<div class="form-group col-md-3">
						<input type="number" class="form-control" id="nuVerifConta" name="nuVerifConta" placeholder="Núm Verificador Conta" 
						value="<?= $nuVerifConta?>" maxlength="2">
					</div>
					<div class="form-group">
						<input type="number" class="form-control" id="vlTaxa" name="vlTaxa" placeholder="Valor da taxa" maxlength="6"
						value="<?=$vlTaxa?>">
					
					</div>
						<input type="hidden" id=seqInst name="seqInst" value="<?=$seqInst?>">
					
					<button type="submit" class="btn btn-primary form-control">Cadastrar</button>
				</form>
			</div>
			<div class="col-md-4"></div>

			<div class="clearfix"></div>
			<br />
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>

		</div>


	    </div>
	
		<script src="utils/bootstrap/js/bootstrap.min.js">
		</script><!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --></script>
		<script>  function formatar(mascara, documento){   
					var i = documento.value.length;   
					var saida = mascara.substring(0,1);   
					var texto = mascara.substring(i)     
					if (texto.substring(0,1) != saida){    
						documento.value += texto.substring(0,1);   
					}    
				}
		</script>
	
	</body>
</html>
