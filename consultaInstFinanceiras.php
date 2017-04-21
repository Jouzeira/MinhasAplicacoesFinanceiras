<?php

require_once('model/db.class.php');

$codInst = isset($_GET['codInst'])		? $_GET['codInst'] 	: 0;

$objDB = new db();
$link = $objDB->conecta_mysql();


if ($codInst != 0) {
	$sql = " SELECT * FROM maf.tb_instituicao_financeira where ID_INST_FINANCEIRA = $codInst";
	$resultado_id= (mysqli_query($link,$sql)); 
	$instituicao= mysqli_fetch_array($resultado_id);
	
		
	$retorno_get = 'cnpj='.substr($instituicao['CNPJ_INST_FINANCEIRA'], 0,2).".".substr($instituicao['CNPJ_INST_FINANCEIRA'], 2,3).".".substr($instituicao['CNPJ_INST_FINANCEIRA'], 5,3)."/".substr($instituicao['CNPJ_INST_FINANCEIRA'], 8,4)."-".substr($instituicao['CNPJ_INST_FINANCEIRA'], -2)
		.'&nomeInst='.$instituicao['NOME_INST_FINANCEIRA']
		.'&codigo='.$instituicao['COD_INST_FINANCEIRA']
		.'&nuAgencia='.$instituicao['AGENCIA_INST_FINANCEIRA']
		.'&nuVerifAgencia='.$instituicao['COD_VERIF_AGEN_INST_FINANCEIRA']
		.'&nuConta='.$instituicao['CONTA_INST_FINANCEIRA']
		.'&nuVerifConta='.$instituicao['COD_VERIF_CONTA_INST_FINANCEIRA']
		.'&vlTaxa='.$instituicao['TXMANUT_INST_FINANCEIRA']
		.'&seqInst='.$instituicao['ID_INST_FINANCEIRA'];
		
		header('Location: cadastroInstituicao.php?menuInst=1&'.$retorno_get);
		die(); //interrompe a execução do script
}

$sql = " SELECT * FROM maf.tb_instituicao_financeira ";


//executar a query => a função mysqli_query() espera 2 parÃ¢metros: conexÃ£o e a query
$resultado_id = (mysqli_query($link,$sql)); //Retorna false caso exista um erro na consulta ou um resource

?>
