<?php 

require_once '../../model/investimentoDAO.class.php';
require_once '../../bo/investimentoBO.class.php';

// Percentual por tipo de investimento
$investimentoDAO = new InvestimentoDAO();
$resultSomaSaldo = $investimentoDAO->consultaSaldoLiquidoPorTipoInvestimento($_SESSION['ID_PESSOA']);
$listaInvestimentoPorTipo = array();
while ($linha = mysqli_fetch_array($resultSomaSaldo,MYSQLI_ASSOC)) {
	$investimentoBO = new investimentoBO();
	$investimentoBO->setNomeTipoInvestimento($linha['NOME_TIPO_INVESTIMENTO']);
	$investimentoBO->setSomaSaldoLiquido($linha['SOMA_SALDO_LIQUIDO']);
	$listaInvestimentoPorTipo[] = $investimentoBO;
}

?>