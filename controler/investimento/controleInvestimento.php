<?php

session_start();

require_once '../../bo/investimentoBO.class.php';
require_once '../../model/investimentoDAO.class.php';

$investimentoBO = new investimentoBO();
$investimentoBO->setIdTipoCategoria($_POST['tipoCategoria']);
$investimentoBO->setIdTipoRenda($_POST['tipoRenda']);
$investimentoBO->setIdTipo($_POST['tipoInvestimento']);
$investimentoBO->setIdInstFinanceira($_POST['instituicao']);
$investimentoBO->setNomeInvestimento($_POST['nome']);
$investimentoBO->setDataAplicacao($_POST['dataAplicacao']);
$investimentoBO->setDataMinimaResgate($_POST['dataResgate']);
$investimentoBO->setDataVencimento($_POST['dataVencimento']);
$investimentoBO->setValorAplicacao($_POST['valorAplicado']);
$investimentoBO->setTaxaContratada($_POST['taxaContratada']);
$investimentoBO->setTaxaCorretagem($_POST['taxaCorretagem']);
$investimentoBO->setIdPessoa($_SESSION['ID_PESSOA']);

$investimentoDAO = new InvestimentoDAO();

if ($investimentoDAO->cadastrarInvestimento($investimentoBO)) {
	echo "cadastrado com sucesso!";
}else {
	echo "Erro ao cadastrar o Investimento.";
}


?>
