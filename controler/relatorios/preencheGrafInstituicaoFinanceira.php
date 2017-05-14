<?php 

require_once '../../model/investimentoDAO.class.php';
require_once '../../bo/investimentoBO.class.php';

// Percentual por instituicao financeira
$investimentoDAO = new InvestimentoDAO();
$resultSomaSaldo = $investimentoDAO->consultaSaldoLiquidoPorInstituicao($_SESSION['ID_PESSOA']);
$listaInvestimentoPorInstituicao = array();
while ($linha = mysqli_fetch_array($resultSomaSaldo,MYSQLI_ASSOC)) {
	$investimentoBO = new investimentoBO();
	$investimentoBO->setNomeInstituicao($linha['NOME_INST_FINANCEIRA']);
	$investimentoBO->setSomaSaldoLiquido($linha['SOMA_SALDO_LIQUIDO']);
	$listaInvestimentoPorInstituicao[] = $investimentoBO;
}

?>