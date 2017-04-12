<?php 

$erro_cpf		= isset($_GET['erro_cpf'])		? $_GET['erro_cpf'] 	: 0;
$erro_email 	= isset($_GET['erro_email'])	? $_GET['erro_email']	: 0;
$erro_senha 	= isset($_GET['erro_senha']) 	? $_GET['erro_senha']	: 0;

$cpf 			= isset($_GET['cpf'])			? $_GET['cpf']			: "";
$nome 			= isset($_GET['nome'])			? $_GET['nome']			: "";
$email 			= isset($_GET['email'])			? $_GET['email']			: "";
$dtNascimento	= isset($_GET['dtNascimento'])	? $_GET['dtNascimento']		: "";

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
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
	            <li><a href="index.php">Voltar para Home</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-4"></div>
	    	<div class="col-md-4">
	    		<h3>Cadastre-se.</h3>
	    		<br />
				<form method="post" action="registra_usuario.php" id="formCadastrarse">
					<div class="form-group">
						<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" 
								maxlength="14" required="requiored" onkeypress="formatar('###.###.###-##', this);" 
								value="<?= $cpf ?>">
						
						<?php 
						
							if ($erro_cpf){ // 1 é true e 0 é false
								echo '<font style="color:#FF0000"> CPF já existe</font>';
							}
						
						?>
						
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required="requiored"
						value="<?= $nome ?>" maxlength="60">
					</div>

					<div class="form-group">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required="requiored"
						value="<?= $email?>" maxlength="60">
						
						<?php 
						
						if ($erro_email){ // 1 é true e 0 é false
							echo '<font style="color:#FF0000"> Email já existe</font>';
							}
						
						?>
						
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="dtNascimento" name="dtNascimento" placeholder="Data de Nascimento" required="requiored"
						value="<?= $dtNascimento?>">
					</div>
					
					<div class="form-group">
						<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required="requiored" maxlength="32">
					</div>
					
					<div class="form-group">
						<input type="password" class="form-control" id="confirmSenha" name="confirmSenha" placeholder="Confirme a Senha" required="requiored" maxlength="32">
					
						<?php 
						
						if ($erro_senha){ // 1 é true e 0 é false
							echo '<font style="color:#FF0000"> Confirmação de senha não confere</font>';
							}
						
						?>
					
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
