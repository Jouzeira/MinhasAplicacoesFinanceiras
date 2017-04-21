<?php

require_once('model/db.class.php');

	$cpf = $_POST['cpf'];
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$dtNascimento = $_POST['dtNascimento'];
	$senha = md5($_POST['senha']);	
	$confirmSenha= md5($_POST['confirmSenha']);	

	$verificar = array(".", "-");
	$substituir   = array("", "");
	$cpfSemMascara = str_replace($verificar, $substituir, $cpf);

	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	$cpf_existe = false;
	$email_existe = false;
	$senha_confirmada = false;
	
	//verifica confirmação de senha
	if ($senha != $confirmSenha){
		$senha_confirmada = true;
	}
	
	//verificar se o CPF já existe
	$sql = " SELECT * FROM maf.tb_pessoa WHERE cpf_pessoa = '$cpfSemMascara' ";
	if($resultado_id = mysqli_query($link, $sql)){
		
		$dados_usuario = mysqli_fetch_array($resultado_id);
		
		if (isset($dados_usuario['CPF_PESSOA'])){
			//echo 'Usuário já cadastrado';
			$cpf_existe= true;	
		}
		
	} else {
		echo 'Erro ao tentar localizar o registro de CPF';
	}
	
	//verificar se o email já existe
	$sql = " SELECT * FROM maf.tb_pessoa WHERE email_pessoa = '$email' ";
	if($resultado_id = mysqli_query($link, $sql)){
		
		$dados_usuario = mysqli_fetch_array($resultado_id);
		
		if (isset($dados_usuario['EMAIL_PESSOA'])){
			//echo 'E-mail já cadastrado';
			$email_existe = true;
		}
		
	} else {
		echo 'Erro ao tentar localizar o registro de e-mail';
	}
	if($cpf_existe|| $email_existe || $senha_confirmada) {
		
		$retorno_get = 'cpf='.$cpf.'&nome='.$nome.'&email='.$email.'&dtNascimento='.$dtNascimento.'&';
		
		if($cpf_existe){
			$retorno_get.= "erro_cpf=1&";
		}
		
		if($email_existe){
			$retorno_get.= "erro_email=1&";	
		}
		if ($senha_confirmada){
			$retorno_get.= "erro_senha=1&";
		}
		
		header('Location: inscrevase.php?'.$retorno_get);
		die(); //interrompe a execução do script
	}
	
	
	$sql = " INSERT INTO maf.tb_pessoa
				(
				CPF_PESSOA,
				NOME_PESSOA,
				EMAIL_PESSOA,
				DT_NAS_PESSOA,
				SENHA)
				VALUES
				(
				'$cpfSemMascara',
				'$nome',
				'$email',
				'$dtNascimento',
				'$senha')";

	//executar a query => a função mysqli_query() espera 2 parâmetros: conexão e a query
	if (mysqli_query($link,$sql)){
		echo 'Usuário registrado com sucesso';
	} else {
		echo 'Erro ao registrar o usuário';
	}

?>
