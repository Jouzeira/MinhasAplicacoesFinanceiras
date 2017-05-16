<?php
	
	session_start(); //usar sempre como o primeiro comando 

	require_once('model/db.class.php');
	require_once 'model/investimentoDAO.class.php';
	
	$email = $_POST['usuario'];
	$senha = md5($_POST['senha']);

	$sql = " SELECT NOME_PESSOA,EMAIL_PESSOA, ID_PESSOA FROM maf.tb_pessoa WHERE EMAIL_PESSOA = '$email' AND SENHA = '$senha' ";

	$objDB = new db();
	$link = $objDB->getlink();
	
	//executar a query => a função mysqli_query() espera 2 parâmetros: conexão e a query
	$resultado_id = (mysqli_query($link,$sql)); //Retorna false caso exista um erro na consulta ou um resource
	
	if($resultado_id){
		$dados_usuario = mysqli_fetch_array($resultado_id);	
		//var_dump($dados_usuario);

		if(isset($dados_usuario['NOME_PESSOA'])){
			//echo "usuário existe";
			
			$posicao = strpos($dados_usuario['NOME_PESSOA'], ' ');
			
			$_SESSION['NOME_PESSOA'] 	= ($posicao==null||$posicao==0||$posicao=="")?$dados_usuario['NOME_PESSOA']:substr($dados_usuario['NOME_PESSOA'], 0, $posicao);
			$_SESSION['EMAIL_PESSOA'] 	= $dados_usuario['EMAIL_PESSOA'];
			$_SESSION['ID_PESSOA'] 		= $dados_usuario['ID_PESSOA'];
			
			$investimentoDAO = new InvestimentoDAO();
			$resultInvestimento = $investimentoDAO->consultaListaInvestimento($dados_usuario['ID_PESSOA']);
			
			if (mysqli_fetch_array($resultInvestimento)) {
				$_SESSION['POSSUI_INVESTIMENTO'] = 1;
				header('Location: /MinhasAplicacoesFinanceiras/visao/home/home.php');
			}else {
				$_SESSION['POSSUI_INVESTIMENTO'] = 0;
				header('Location: /MinhasAplicacoesFinanceiras/visao/home/passoapasso.php');
			}

		} else {
			//echo 'usuário não existe';
			header('Location: index.php?erro=1');
		}

	} else {
		echo 'Erro na execução da consulta, favor entrar em contato com o admin.';
	}

	//update => retorna true/false
	//insert => retorna true/false
	//select => false/resource
	//delete => retorna true/false
	
?>
