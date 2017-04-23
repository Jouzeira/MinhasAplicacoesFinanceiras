<?php

	require_once '../../model/investimentoDAO.class.php';
	require_once '../../bo/investimentoBO.class.php';
	require_once '../../model/tipoInvestimentoDAO.class.php';
	require_once '../../model/tipoRendaDAO.class.php';
// 	require_once '../../model/tipoCategoriaDAO.class.php';
	require_once '../../model/instituicaoFinanceiraDAO.class.php';
	
	$investimentoDAO = new InvestimentoDAO();
	$resultado = $investimentoDAO->consultaListaInvestimento($_SESSION['ID_PESSOA']);
	
	$tipoInvestimentoDAO = new TipoInvestimentoDAO();
	$tipoRendaDAO = new TipoRendaDAO();
// 	$tipoCategoriaDAO = new TipoCategoriaDAO();
	$instituicaoFinanceiraDAO = new InstituicaoFinanceiraDAO();
	
	$listaInvestimentoBO = array();
	$total = 0;
	while ($linha = mysqli_fetch_array($resultado,MYSQLI_ASSOC)) {
		$investimentoBO = new investimentoBO();
		$investimentoBO->setId($linha['ID_INVESTIMENTO']);
		$investimentoBO->setIdTipo(mysqli_fetch_array($tipoInvestimentoDAO->consultaPorId($linha['ID_TIPO_INVESTIMENTO']),MYSQLI_ASSOC)['NOME_TIPO_INVESTIMENTO']);
		$investimentoBO->setIdPessoa($linha['ID_PESSOA']);
		$investimentoBO->setIdTipoRenda(mysqli_fetch_array($tipoRendaDAO->consultaPorId($linha['ID_TIPO_RENDA']),MYSQLI_ASSOC)['NOME_TIPO_RENDA']);
// 		$investimentoBO->setIdTipoCategoria(mysqli_fetch_array($tipoCategoriaDAO->consultaPorId($linha['ID_TIPO_CATEGORIA']),MYSQLI_ASSOC)['NOME_TIPO_CATEGORIA']);
		$investimentoBO->setIdInstFinanceira(mysqli_fetch_array($instituicaoFinanceiraDAO->consultaPorId($linha['ID_INST_FINANCEIRA']),MYSQLI_ASSOC)['NOME_INST_FINANCEIRA']);
		$investimentoBO->setNomeInvestimento($linha['NOME_INVESTIMENTO']);
		$investimentoBO->setDataAplicacao($linha['DT_APLICACAO_INVESTIMENTO']);
		$investimentoBO->setDataMinimaResgate($linha['DT_MINIMA_RESGATE_INVESTIMENTO']);
		$investimentoBO->setDataVencimento($linha['DT_VENCIMENTO_INVESTIMENTO']);
		$investimentoBO->setValorAplicacao($linha['VL_APLICACAO_INVESTIMENTO']);
		$investimentoBO->setTaxaContratada($linha['TX_CONTRATADA_INVESTIMENTO']);
		$investimentoBO->setTaxaCorretagem($linha['TX_CORRETAGEM_INVESTIMENTO']);
		$total += $linha['VL_APLICACAO_INVESTIMENTO'];
		$listaInvestimentoBO[]=$investimentoBO;
	}

?>