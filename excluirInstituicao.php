<?php

require_once('comuns/db.class.php');
	session_start();
	
	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	$excluir = $_GET['excluir'];
	
	$sql = "DELETE FROM tb_instituicao_financeira
    WHERE tb_instituicao_financeira.ID_INST_FINANCEIRA = $excluir";
	
	if (mysqli_query($link,$sql)){
		header('Location: instituicoesFinanceiras.php?menuInst=1&msgExcluir=1&');
		die(); //interrompe a execução do script
	} else {
		echo $sql;
		echo '<br/> Erro ao excluir a instituição';
		die(); //interrompe a execução do script
	}

?>