<?php

// session_start();

require_once '../../model/tipoInvestimentoDAO.class.php';
require_once '../../bo/tipoInvestimentoBO.class.php';
require_once '../../model/tipoRendaDAO.class.php';
require_once '../../bo/tipoRendaBO.class.php';
require_once '../../model/tipoCategoriaDAO.class.php';
require_once '../../bo/tipoCategoriaBO.class.php';
require_once '../../model/instituicaoFinanceiraDAO.class.php';
require_once '../../bo/instituicaoFinanceiraBO.class.php';
require_once '../../model/investimentoDAO.class.php';
require_once '../../bo/investimentoBO.class.php';

$tipoInvestimentoDAO= new TipoInvestimentoDAO();
$resultTipoInvestimento= $tipoInvestimentoDAO->consultaListaTipoInvestimento();

$listTipoInvestimento = array();
while ($linha = mysqli_fetch_array($resultTipoInvestimento,MYSQLI_ASSOC)){
	$tipoInvestimento = new tipoInvestimentoBO();
	$tipoInvestimento->setId($linha['ID_TIPO_INVESTIMENTO']);
	$tipoInvestimento->setNomeTipoInvestimento($linha['NOME_TIPO_INVESTIMENTO']);
	$tipoInvestimento->setIdTipoRenda($linha['ID_TIPO_RENDA']);
	$listTipoInvestimento[] = $tipoInvestimento;
}


$tipoRendaDAO = new TipoRendaDAO();
$resultTipoRenda = $tipoRendaDAO->consultaListaTipoRenda();

$listTipoRenda = array();
while ($linha = mysqli_fetch_array($resultTipoRenda,MYSQLI_ASSOC)) {
	$tipoRenda = new TipoRendaBO();
	$tipoRenda->setId($linha['ID_TIPO_RENDA']);
	$tipoRenda->setNomeTipoRenda($linha['NOME_TIPO_RENDA']);
	$listTipoRenda[] = $tipoRenda;
}


$tipoCategoriaDAO = new TipoCategoriaDAO();
$resultTipoCategoria = $tipoCategoriaDAO->consultaListaTipoCategoria();

$listTipoCategoria = array();
while ($linha = mysqli_fetch_array($resultTipoCategoria,MYSQLI_ASSOC)) {
	$tipoCategoria = new TipoCategoriaBO();
	$tipoCategoria->setId($linha['ID_TIPO_CATEGORIA']);
	$tipoCategoria->setNomeTipoCategoria($linha['NOME_TIPO_CATEGORIA']);
	$listTipoCategoria[] = $tipoCategoria;
}


$instFinanceiraDAO = new InstituicaoFinanceiraDAO();
$resultInstFinanceira = $instFinanceiraDAO->consultaInstituicaoFinanceira($_SESSION['ID_PESSOA']);

$listInstFinanceira = array();
while ($linha = mysqli_fetch_array($resultInstFinanceira,MYSQLI_ASSOC)) {
	$instFinanceira = new InstituicaoFinanceiraBO();
	$instFinanceira->setId($linha['ID_INST_FINANCEIRA']);
	$instFinanceira->setIdPessoa($linha['ID_PESSOA']);
	$instFinanceira->setNome($linha['NOME_INST_FINANCEIRA']);
	$instFinanceira->setCnpj($linha['CNPJ_INST_FINANCEIRA']);
	$instFinanceira->setCodigo($linha['COD_INST_FINANCEIRA']);
	$instFinanceira->setAgencia($linha['AGENCIA_INST_FINANCEIRA']);
	$instFinanceira->setConta($linha['CONTA_INST_FINANCEIRA']);
	$instFinanceira->setTaxaManutencao($linha['TXMANUT_INST_FINANCEIRA']);
	$instFinanceira->setCodVerifAgencia($linha['COD_VERIF_AGEN_INST_FINANCEIRA']);
	$instFinanceira->setCodVerifConta($linha['COD_VERIF_CONTA_INST_FINANCEIRA']);
	$listInstFinanceira[]=$instFinanceira;
}

	$investimentoBO = new investimentoBO();
if (isset($_GET['valor'])) {
	$investimentoDAO = new InvestimentoDAO();
	$resultInvestimento = $investimentoDAO->consultarPorId($_GET['valor']);
	$investimentoBO->setId($resultInvestimento['ID_INVESTIMENTO']);
	$investimentoBO->setIdTipo($resultInvestimento['ID_TIPO_INVESTIMENTO']);
	$investimentoBO->setIdPessoa($resultInvestimento['ID_PESSOA']);
	$investimentoBO->setIdTipoRenda($resultInvestimento['ID_TIPO_RENDA']);
	$investimentoBO->setIdTipoCategoria($resultInvestimento['ID_TIPO_CATEGORIA']);
	$investimentoBO->setIdInstFinanceira($resultInvestimento['ID_INST_FINANCEIRA']);
	$investimentoBO->setNomeInvestimento($resultInvestimento['NOME_INVESTIMENTO']);
	$investimentoBO->setDataAplicacao($resultInvestimento['DT_APLICACAO_INVESTIMENTO']);
	$investimentoBO->setDataMinimaResgate($resultInvestimento['DT_MINIMA_RESGATE_INVESTIMENTO']);
	$investimentoBO->setDataVencimento($resultInvestimento['DT_VENCIMENTO_INVESTIMENTO']);
	$investimentoBO->setValorAplicacao($resultInvestimento['VL_APLICACAO_INVESTIMENTO']);
	$investimentoBO->setTaxaContratada($resultInvestimento['TX_CONTRATADA_INVESTIMENTO']);
	$investimentoBO->setTaxaCorretagem($resultInvestimento['TX_CORRETAGEM_INVESTIMENTO']);
	
}

?>