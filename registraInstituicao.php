<?php

	require_once('db.class.php');
	session_start();

	$cnpj= $_POST['cnpj'];
	$nomeInst= $_POST['nomeInst'];
	$codigo= $_POST['codigo'];
	$nuAgencia= $_POST['nuAgencia'];
	$nuVerifAgencia= $_POST['nuVerifAgencia'];
	$nuConta= $_POST['nuConta'];
	$nuVerifConta= $_POST['nuVerifConta'];
	$vlTaxa= $_POST['vlTaxa'];

	$verificar = array(".","/","-");
	$substituir   = array("", "", "");
	$cnpjSemMascara = str_replace($verificar, $substituir, $cnpj);

	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	$cnpj_existe = false;
	
	//verificar se o CNPJ já existe
	$sql = " SELECT * FROM maf.tb_instituicao_financeira where CNPJ_INST_FINANCEIRA = '$cnpjSemMascara' ";
	if($resultado_id = mysqli_query($link, $sql)){
		
		$dados_usuario = mysqli_fetch_array($resultado_id);
		
		if (isset($dados_usuario['CNPJ_INST_FINANCEIRA'])){
			//echo 'Usuário já cadastrado';
			$cnpj_existe= true;	
		}
		
	} else {
		echo 'Erro ao tentar localizar o registro do CNPJ';
	}
	
	if($cnpj_existe) {
		
		$retorno_get = 'cnpj='.$cnpj
		.'&nomeInst='.$nomeInst
		.'&codigo='.$codigo
		.'&nuAgencia='.$nuAgencia
		.'&nuVerifAgencia='.$nuVerifAgencia
		.'&nuConta='.$nuConta
		.'&nuVerifConta='.$nuVerifConta
		.'&vlTaxa='.$vlTaxa
		.'&';
		
		if($cnpj_existe){
			$retorno_get.= "erro_cnpj=1&";
		}
		
		header('Location: cadastroInstituicao.php?'.$retorno_get);
		die(); //interrompe a execução do script
	}
	
	$ID_PESSOA = $_SESSION['ID_PESSOA'];
	$nuVerifAgencia = !is_null($nuVerifAgencia) && $nuVerifAgencia != ""? $nuVerifAgencia : 0;
	$nuVerifConta = !is_null($nuVerifConta) && $nuVerifConta != ""? $nuVerifConta: 0;
	
	echo $nuVerifAgencia."agencia <br/>";
	
	$sql = " INSERT INTO maf.tb_instituicao_financeira
			(ID_PESSOA,
			NOME_INST_FINANCEIRA,
			CNPJ_INST_FINANCEIRA,
			COD_INST_FINANCEIRA,
			AGENCIA_INST_FINANCEIRA,
			CONTA_INST_FINANCEIRA,
			TXMANUT_INST_FINANCEIRA,
			COD_VERIF_AGEN_INST_FINANCEIRA,
			COD_VERIF_CONTA_INST_FINANCEIRA)
			VALUES
			($ID_PESSOA,
			'$nomeInst',
			'$cnpjSemMascara',
			$codigo,
			$nuAgencia,
			$nuConta,
			$vlTaxa,
			$nuVerifAgencia,
			$nuVerifConta)";

	//executar a query => a função mysqli_query() espera 2 parâmetros: conexão e a query
	if (mysqli_query($link,$sql)){
		echo 'Instituição registrado com sucesso';
	} else {
		echo $sql;
		echo '<br/> Erro ao registrar a instituição';
	}

?>
