<?php

	$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
	//echo $erro;

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
	
		<script>
			// código javascript - validação de preenchimento campos usuário e senha	

			$(document).ready(function (){
				//verificar se os campos de usuário e senha foram devidamente preenchidos
				$('#btn_login').click(function(){

					var campo_vazio = false;

					//alert('Botão entrar foi clicado');
					if($('#campo_usuario').val() == ''){
						//alert ('Campo usuário está vazio');
						$('#campo_usuario').css({'border-color':'#A94442'})
						campo_vazio = true;
					} else {
						$('#campo_usuario').css({'border-color':'#CCC'})
					}

					if($('#campo_senha').val() == ''){
						//alert ('Campo senha está vazio');
						$('#campo_senha').css({'border-color':'#A94442'})
						campo_vazio = true;
					} else {
						$('#campo_senha').css({'border-color':'#CCC'})
					}

					if(campo_vazio) return false;

				});
			});
			

		</script>
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
	            <li><a href="inscrevase.php">Inscrever-se</a></li>
	            <li class="<?= $erro == 1 ? 'open' : '' ?>">
	            	<a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entrar</a>
					<ul class="dropdown-menu" aria-labelledby="entrar"  style="width: 300px;">
						<div class="col-md-12">
				    		<p>Você possui uma conta?</h3>
				    		<br />
							<form method="post" action="validar_acesso.php" id="formLogin">
								<div class="form-group">
									<input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="E-mail" required maxlength="60"/>
								</div>
								
								<div class="form-group">
									<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" maxlength="32"/>
								</div>
								
								<button type="buttom" class="btn btn-primary" id="btn_login">Entrar</button>

								<br /><br />
								
							</form>

							<?php
								if ($erro == 1){
									echo '<font color="#FF0000"> E-mail ou senha inválido(s)</font>';
								}
							?>

						<!--</form>-->
						</div>
				  	</ul>
	            </li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">

	      <!-- Main component for a primary marketing message or call to action -->
	      <div class="jumbotron">
	        <h1>Bem vindo ao Minhas Aplicações Financeiras</h1>
	        <p>Que tal gerenciar os seus invetimentos?</p>
	      </div>

	      <div class="clearfix"></div>
		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>