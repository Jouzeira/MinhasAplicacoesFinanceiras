<?php

require_once('model/db.class.php');
	session_start();

	$cnpj= $_POST['cnpj'];
	$nomeInst= $_POST['nomeInst'];
	$codigo= $_POST['codigo'];
	$nuAgencia= $_POST['nuAgencia'];
	$nuVerifAgencia= $_POST['nuVerifAgencia'];
	$nuConta= $_POST['nuConta'];
	$nuVerifConta= $_POST['nuVerifConta'];
	$vlTaxa= $_POST['vlTaxa'];
	$seqInst=$_POST['seqInst'];

	$verificar = array(".","/","-");
	$substituir   = array("", "", "");
	$cnpjSemMascara = str_replace($verificar, $substituir, $cnpj);

	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	$nuVerifAgencia = !is_null($nuVerifAgencia) && $nuVerifAgencia != ""? $nuVerifAgencia : null;
	$nuVerifConta = !is_null($nuVerifConta) && $nuVerifConta != ""? $nuVerifConta: null;
	$vlTaxa = !is_null($vlTaxa) && $vlTaxa != ""? $vlTaxa:0;
	
	if (!is_null($seqInst) && $seqInst != "" && $seqInst!=0){
		$sql = " UPDATE maf.tb_instituicao_financeira
		SET
		NOME_INST_FINANCEIRA = '$nomeInst',
		COD_INST_FINANCEIRA = $codigo,
		AGENCIA_INST_FINANCEIRA = $nuAgencia,
		CONTA_INST_FINANCEIRA = $nuConta,
		TXMANUT_INST_FINANCEIRA = $vlTaxa";
		if (!is_null($nuVerifAgencia)) {
			$sql.=",COD_VERIF_AGEN_INST_FINANCEIRA = $nuVerifAgencia";
		}
		if (!is_null($nuVerifConta)) {
			$sql.=",COD_VERIF_CONTA_INST_FINANCEIRA = $nuVerifConta";
		}
		$sql.=" WHERE `ID_INST_FINANCEIRA` = $seqInst";
		
		if (mysqli_query($link,$sql)){
			header('Location: instituicoesFinanceiras.php?menuInst=1&msgAlterar=1&');
			die(); //interrompe a execução do script
		} else {
			echo $sql;
			echo '<br/> Erro ao registrar a instituição';
			die(); //interrompe a execução do script
		}
	}
	
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
		
		header('Location: cadastroInstituicao.php?menuInst=1&'.$retorno_get);
		die(); //interrompe a execução do script
	}
	
	$ID_PESSOA = $_SESSION['ID_PESSOA'];
	
	echo $nuVerifAgencia."agencia <br/>";
	
	$sql = " INSERT INTO maf.tb_instituicao_financeira
			(ID_PESSOA,
			NOME_INST_FINANCEIRA,
			CNPJ_INST_FINANCEIRA,
			COD_INST_FINANCEIRA,
			AGENCIA_INST_FINANCEIRA,
			CONTA_INST_FINANCEIRA,
			TXMANUT_INST_FINANCEIRA";
			
			if (!is_null($nuVerifAgencia)) {
				$sql.=",COD_VERIF_AGEN_INST_FINANCEIRA";
			}
			if (!is_null($nuVerifConta)) {
				$sql.=",COD_VERIF_CONTA_INST_FINANCEIRA";
			}
			
			$sql.=")
			VALUES
			($ID_PESSOA,
			'$nomeInst',
			'$cnpjSemMascara',
			$codigo,
			$nuAgencia,
			$nuConta,
			$vlTaxa";
			
			if (!is_null($nuVerifAgencia)) {
				$sql.=",$nuVerifAgencia";
			}
			if (!is_null($nuVerifConta)) {
				$sql.=",$nuVerifConta";
			}
			
			$sql.=")";
			

	//executar a query => a função mysqli_query() espera 2 parâmetros: conexão e a query
	if (mysqli_query($link,$sql)){
		header('Location: instituicoesFinanceiras.php?menuInst=1&msgIncluir=1&');
		die(); 
	} else {
		echo $sql;
		echo '<br/> Erro ao registrar a instituição';
	}

?>
