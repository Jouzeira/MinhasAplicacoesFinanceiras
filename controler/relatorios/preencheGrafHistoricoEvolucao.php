<?php 

require_once '../../model/historicoInvestimentoDAO.class.php';
require_once '../../bo/relHistoricoInvestimentoBO.class.php';

//Evolução do Saldo Líquido das Aplicações.
$historicoInvestimentoDAO = new HistoricoInvestimentoDAO();
$resultHistorico = $historicoInvestimentoDAO->consultarRelHistoricoInvestimento($_SESSION['ID_PESSOA']);


$codigoInvestimento = 0;
$listaRelHistoricoInvestimentoBO = array();
$listaDaLista = array();

while ($linha = mysqli_fetch_array($resultHistorico,MYSQLI_ASSOC)){
	
	if ($codigoInvestimento == 0 ) {
		$codigoInvestimento = $linha['ID_INVESTIMENTO'];
	}
	
	$relHistoricoInvestimentoBO = new RelHistoricoInvestimentoBO();
	$relHistoricoInvestimentoBO->setIdInvestimento($linha['ID_INVESTIMENTO']);
	$relHistoricoInvestimentoBO->setData($linha['DATA_1']);
	$relHistoricoInvestimentoBO->setValor($linha['VALOR']);
	$relHistoricoInvestimentoBO->setNome($linha['NOME']);
	
	if ($linha['ID_INVESTIMENTO'] == $codigoInvestimento) {
		$listaRelHistoricoInvestimentoBO[]= $relHistoricoInvestimentoBO;
	}else {
		$listaDaLista[]=$listaRelHistoricoInvestimentoBO;
		unset($listaRelHistoricoInvestimentoBO);
		$codigoInvestimento = $linha['ID_INVESTIMENTO'];
		$listaRelHistoricoInvestimentoBO[]= $relHistoricoInvestimentoBO;
	}
}
$listaDaLista[]=$listaRelHistoricoInvestimentoBO;

?>