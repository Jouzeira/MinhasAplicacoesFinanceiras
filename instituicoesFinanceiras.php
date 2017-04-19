<?php

	session_start();

	if(!isset($_SESSION['NOME_PESSOA'])){
		header('Location: index.php?erro=1');
	}
	include 'consultaInstFinanceiras.php';

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
	    <?php include 'navegacao.php';?>


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-2">
	    		Instituições Financeiras!!
	    		<br />
	    		<?= $_SESSION['NOME_PESSOA'] ?>
	    		<br />
	    		<?= $_SESSION['EMAIL_PESSOA'] ?>
	    		<div>
	    		<a class="btn btn-primary" href="cadastroInstituicao.php?menuInst=1&" role="button">Nova Instituição</a>
	    		</div>
	    	</div>
	    	<div class="col-md-8">
	    	
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
								<span class="glyphicon glyphicon-trash" ></span>
							</td> 
						</tr> 
					<?php }?>
					</tbody> 
				</table>
	    	
	    	
	    	
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
	
	</body>
</html>