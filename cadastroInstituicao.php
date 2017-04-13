<?php

session_start();

if(!isset($_SESSION['NOME_PESSOA'])){
	header('Location: index.php?erro=1');
}

$erro_cnpj		= isset($_GET['erro_cpf'])		? $_GET['erro_cpf'] 	: 0;
$erro_email 	= isset($_GET['erro_email'])	? $_GET['erro_email']	: 0;
$erro_senha 	= isset($_GET['erro_senha']) 	? $_GET['erro_senha']	: 0;

$cnpj			= isset($_GET['cpf'])			? $_GET['cpf']			: "";
$nomeInstituicao = isset($_GET['nome'])			? $_GET['nome']			: "";
$codigo			= isset($_GET['email'])			? $_GET['email']			: "";
$nuAgencia		= isset($_GET['dtNascimento'])	? $_GET['dtNascimento']		: "";
$nuConta		= isset($_GET['dtNascimento'])	? $_GET['dtNascimento']		: "";
$vlTaxa			= isset($_GET['dtNascimento'])	? $_GET['dtNascimento']		: "";

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
	
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	           <img src="imagens/cifrao.png" height="40"/>
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li class="active"><a href="sair.php">Instituições Financeiras</a></li>
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


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
								value="<?= $cnpj ?>"/>
						
						<?php 
						
							if ($erro_cnpj){ // 1 é true e 0 é false
								echo '<font style="color:#FF0000"> CNPJ já existe</font>';
							}
						
						?>
						
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Instituição" required="requiored"
						value="<?= $nomeInstituicao ?>" maxlength="100">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código da Instituição" required="requiored"
						value="<?= $codigo?>" maxlength="10">
						
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nuAgencia" name="nuAgencia" placeholder="Número da Agência" required="requiored"
						value="<?= $nuAgencia?>">
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" id="nuConta" name="nuConta" placeholder="Número da Conta" required="requiored" maxlength="32"
						value="<?=$nuConta?>">
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" id="vlTaxa" name="vlTaxa" placeholder="Valor da taxa" required="requiored" maxlength="32"
						value="<?=$vlTaxa?>">
					
					</div>
					
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
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
