<?php 

	require_once '../../model/investimentoDAO.class.php';
	require_once '../../bo/investimentoBO.class.php';
	require_once '../../model/tipoInvestimentoDAO.class.php';
	require_once '../../model/tipoRendaDAO.class.php';
	require_once '../../model/tipoCategoriaDAO.class.php';
	require_once '../../model/instituicaoFinanceiraDAO.class.php';
	require_once '../../model/historicoInvestimentoDAO.class.php';
	require_once '../../bo/historicoInvestimentoBO.class.php';
	
	$tipoInvestimentoDAO = new TipoInvestimentoDAO();
	$tipoRendaDAO = new TipoRendaDAO();
	$tipoCategoriaDAO = new TipoCategoriaDAO();
	$instituicaoFinanceiraDAO = new InstituicaoFinanceiraDAO();
	$investimentoDAO = new InvestimentoDAO();
	
	$resultInvestimento = $investimentoDAO->consultarPorId($_GET['valor']);
	$investimentoBO = new investimentoBO();
	$investimentoBO->setId($resultInvestimento['ID_INVESTIMENTO']);
	$investimentoBO->setIdTipo(mysqli_fetch_array($tipoInvestimentoDAO->consultaPorId($resultInvestimento['ID_TIPO_INVESTIMENTO']),MYSQLI_ASSOC)['NOME_TIPO_INVESTIMENTO']);
	$investimentoBO->setIdPessoa($resultInvestimento['ID_PESSOA']);
	$investimentoBO->setIdTipoRenda(mysqli_fetch_array($tipoRendaDAO->consultaPorId($resultInvestimento['ID_TIPO_RENDA']),MYSQLI_ASSOC)['NOME_TIPO_RENDA']);
	$investimentoBO->setIdTipoCategoria(mysqli_fetch_array($tipoCategoriaDAO->consultaPorId($resultInvestimento['ID_TIPO_CATEGORIA']),MYSQLI_ASSOC)['NOME_TIPO_CATEGORIA']);
	$investimentoBO->setIdInstFinanceira(mysqli_fetch_array($instituicaoFinanceiraDAO->consultaPorId($resultInvestimento['ID_INST_FINANCEIRA']),MYSQLI_ASSOC)['NOME_INST_FINANCEIRA']);
	$investimentoBO->setNomeInvestimento($resultInvestimento['NOME_INVESTIMENTO']);
	$investimentoBO->setDataAplicacao($resultInvestimento['DT_APLICACAO_INVESTIMENTO']);
	$investimentoBO->setDataMinimaResgate($resultInvestimento['DT_MINIMA_RESGATE_INVESTIMENTO']);
	$investimentoBO->setDataVencimento($resultInvestimento['DT_VENCIMENTO_INVESTIMENTO']);
	$investimentoBO->setValorAplicacao($resultInvestimento['VL_APLICACAO_INVESTIMENTO']);
	$investimentoBO->setTaxaContratada($resultInvestimento['TX_CONTRATADA_INVESTIMENTO']);
	$investimentoBO->setTaxaCorretagem($resultInvestimento['TX_CORRETAGEM_INVESTIMENTO']);
	
	$historicoInvestimentoDAO = new HistoricoInvestimentoDAO();
	$valorLiquido = mysqli_fetch_array($historicoInvestimentoDAO->consultarSaldoUltimaAtualizacao($_GET['valor']),MYSQLI_ASSOC)['VLLIQUIDO_HISTINVESTIMENTO'];
	if ($valorLiquido == null || $valorLiquido=="") {
		$valorLiquido=$investimentoBO->getValorAplicacaoFormatado();
	}

?>