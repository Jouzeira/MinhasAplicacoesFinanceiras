<?php

	require_once '../../model/investimentoDAO.class.php';
	require_once '../../bo/investimentoBO.class.php';
	
	$investimentoDAO = new InvestimentoDAO();
	$resultado = $investimentoDAO->consultaListaInvestimentoPersonalizado($_SESSION['ID_PESSOA']);
	
	
	$listaInvestimentoBO = array();
	$totalAplicado = 0;
	$totalLiquido = 0;
	while ($linha = mysqli_fetch_array($resultado,MYSQLI_ASSOC)) {
		$investimentoBO = new investimentoBO();
		$investimentoBO->setId($linha['ID_INVESTIMENTO']);
		$investimentoBO->setIdTipo($linha["NOME_TIPO_INVESTIMENTO"]);
		$investimentoBO->setIdPessoa($linha['ID_PESSOA']);
		$investimentoBO->setIdTipoRenda($linha["NOME_TIPO_RENDA"]);
// 		$investimentoBO->setIdTipoCategoria(mysqli_fetch_array($tipoCategoriaDAO->consultaPorId($linha['ID_TIPO_CATEGORIA']),MYSQLI_ASSOC)['NOME_TIPO_CATEGORIA']);
		$investimentoBO->setIdInstFinanceira($linha["NOME_INST_FINANCEIRA"]);
		$investimentoBO->setNomeInvestimento($linha['NOME_INVESTIMENTO']);
		$investimentoBO->setDataAplicacao($linha['DT_APLICACAO_INVESTIMENTO']);
		$investimentoBO->setDataMinimaResgate($linha['DT_MINIMA_RESGATE_INVESTIMENTO']);
		$investimentoBO->setDataVencimento($linha['DT_VENCIMENTO_INVESTIMENTO']);
		$investimentoBO->setValorAplicacao($linha['VL_APLICACAO_INVESTIMENTO']);
		$investimentoBO->setTaxaContratada($linha['TX_CONTRATADA_INVESTIMENTO']);
		$investimentoBO->setTaxaCorretagem($linha['TX_CORRETAGEM_INVESTIMENTO']);
		$investimentoBO->setValorSaldoLiquido($linha['VL_SALDO_LIQUIDO_INVESTIMENTO']);
		$investimentoBO->setPossuiAtualizcoes($linha["POSSUI_ATUALIZACOES"]==0?0:1);
		$totalAplicado += $linha['VL_APLICACAO_INVESTIMENTO'];
		$totalLiquido += $linha['VL_SALDO_LIQUIDO_INVESTIMENTO'];
		$listaInvestimentoBO[]=$investimentoBO;
	}

?>