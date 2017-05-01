<?php

	require_once 'model/investimentoDAO.class.php';
	require_once 'bo/investimentoBO.class.php';
	
	$investimentoDAO = new InvestimentoDAO();
	$resultSomaSaldo = $investimentoDAO->consultaSaldoLiquidoPorTipoInvestimento($_SESSION['ID_PESSOA']);
	$listaInvestimentoPorTipo = array();
	while ($linha = mysqli_fetch_array($resultSomaSaldo,MYSQLI_ASSOC)) {
		$investimentoBO = new investimentoBO();
		$investimentoBO->setNomeTipoInvestimento($linha['NOME_TIPO_INVESTIMENTO']);
		$investimentoBO->setSomaSaldoLiquido($linha['SOMA_SALDO_LIQUIDO']);
		$listaInvestimentoPorTipo[] = $investimentoBO;
	}

	$resultSomaSaldo = $investimentoDAO->consultaSaldoLiquidoPorInstituicao($_SESSION['ID_PESSOA']);
	$listaInvestimentoPorInstituicao = array();
	while ($linha = mysqli_fetch_array($resultSomaSaldo,MYSQLI_ASSOC)) {
		$investimentoBO = new investimentoBO();
		$investimentoBO->setNomeInstituicao($linha['NOME_INST_FINANCEIRA']);
		$investimentoBO->setSomaSaldoLiquido($linha['SOMA_SALDO_LIQUIDO']);
		$listaInvestimentoPorInstituicao[] = $investimentoBO;
	}

	$resultCapitalSaldo = $investimentoDAO->consultaCapitalSaldoLiquidoPorPessoa($_SESSION['ID_PESSOA']);
	$listaCapitalSaldo = array();
	while ($linha = mysqli_fetch_array($resultCapitalSaldo,MYSQLI_ASSOC)) {
		$investimentoBO = new investimentoBO();
		$investimentoBO->setNomeInvestimento($linha['NOME_INVESTIMENTO']);
		$investimentoBO->setValorAplicacao($linha['VL_APLICACAO_INVESTIMENTO']);
		$investimentoBO->setValorSaldoLiquido($linha['VL_SALDO_LIQUIDO_INVESTIMENTO']);
		$listaCapitalSaldo[] = $investimentoBO;
	}
	

?>