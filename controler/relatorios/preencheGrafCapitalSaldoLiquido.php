<?php
require_once '../../model/investimentoDAO.class.php';
require_once '../../bo/investimentoBO.class.php';

// Capital aplicado x Saldo Líquido Atual
$investimentoDAO = new InvestimentoDAO();
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