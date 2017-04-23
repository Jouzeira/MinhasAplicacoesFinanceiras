<?php
	//session_start();
	
	require_once '../../controler/pessoa/preencheFormPessoa.php';
	
	$id 			= $pessoaBO->getId();
	$cpf 			= $pessoaBO->getCpf();
	$nome 			= $pessoaBO->getNome();
	$email			= $pessoaBO->getEmail();
	$dtNascimento 	= $pessoaBO->getDtNascimento();
	
	$erro_email_outro = isset($_GET['erro_email_outro']) ? $_GET['erro_email_outro'] : 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Altere seus dados</title>
	<meta charset="utf-8">
	<!-- Tag de compatibilidade do HTML5 para IE menor que 9-->
	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
	<![endif]-->
	
	<!-- jquery - link cdn -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

	<!-- bootstrap - link cdn -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
	<script>  function formatar(mascara, documento){   
			var i = documento.value.length;   
			var saida = mascara.substring(0,1);   
			var texto = mascara.substring(i)     
			if (texto.substring(0,1) != saida){    
				documento.value += texto.substring(0,1);   
			}    
		}
	</script>
</head>

<body>
	<!-- Static navbar -->
	 <?php include '../../navegacao.php'; ?>
	
	<div class="container">
		<br><br>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				
				<form method="post" action="../../controler/pessoa/controleAlteracaoPessoa.php">
					<div class="form-group">
						<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" maxlength="14" required onkeypress="formatar('###.###.###-##',this);" 
						value="<?= $pessoaBO->getCPFcomMascara($cpf) ?>" disabled>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" maxlength="60" required value="<?= $nome ?>">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" maxlength="60" required" value="<?= $email ?>">
						<?php 
						if ($erro_email_outro){ // 1 é true e 0 é false
							echo '<font style="color:#FF0000"> E-mail já existente.</font>';
							}
						?>
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="dtNascimento" name="dtNascimento" placeholder="Data de Nascimento" maxlength="60" required value="<?= $dtNascimento ?>">
					</div>
					<button type="submit" class="btn btn-warning form-control">ALTERAR DADOS</button>
				</form>

			</div>	<!--  / col-md-4 -->
			<div class="col-md-4"></div>		
		</div> <!--  / div row -->

		<div class="row">

			<div class="col-md-4"></div>
			<div class="col-md-4">
				<br>
				<form method="post" action="">
					<div class="form-group">
						<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" maxlength="32" required">
					</div>					
					<div class="form-group">
						<input type="password" class="form-control" id="confirmSenha" name="confirmSenha" placeholder="Confirme a Senha" maxlength="32" required">
					</div>
					<button type="submit" class="btn btn-warning form-control">ALTERAR SENHA</button>
				</form>

			</div><!--  / col-md-4 -->
			<div class="col-md-4"></div>
		</div><!--  / div row -->

	</div> <!--  / div container -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>

</html>