<?php 

require_once '../../model/investimentoDAO.class.php';
require_once '../../model/rentabilidadeMensalDAO.class.php';
require_once '../../bo/rentabilidadeMensalBO.class.php';

//Rentabilidade Mensal
$investimentoDAO = new InvestimentoDAO();
$resultListaInvestimentos = $investimentoDAO->consultaListaInvestimento($_SESSION['ID_PESSOA']);
$listaInvestimentos = array();
while ($linha = mysqli_fetch_array($resultListaInvestimentos,MYSQLI_ASSOC)) {
	$listaInvestimentos[] = $linha['ID_INVESTIMENTO'];
}

$rentabilidadeMensalDAO = new RentabilidadeMensalDAO();
$resultListaRentMensal = $rentabilidadeMensalDAO->consultaRentabilidadesPorListaInvestimentos($listaInvestimentos);

$codigoInvestimento = 0;
$anoMesControle = 0;
$rentabilidadeMensalBOControle = new RentabilidadeMensalBO();
$rentabilidadeMensalBO2 = array();
$listaRentMensal= array();
$listaDaListaRentMensal = array();

while ($linha = mysqli_fetch_array($resultListaRentMensal,MYSQLI_ASSOC)) {
	
	if ($codigoInvestimento == 0 ) {
		$codigoInvestimento = $linha['ID_INVESTIMENTO'];
		$anoMesControle = $linha['ANO_MES'];
	}
	if ($anoMesControle == $linha['ANO_MES']) {
		$rentabilidadeMensalBO = new RentabilidadeMensalBO();
		$rentabilidadeMensalBO->setIdInvestimento($linha['ID_INVESTIMENTO']);
		$rentabilidadeMensalBO->setAnoMes($linha['ANO_MES']);
		$rentabilidadeMensalBO->setValorRendimentoMensal($linha['VL_RENDIMENTO_MENSAL']);
		
		if ($linha['ID_INVESTIMENTO'] == $codigoInvestimento) {
			$listaRentMensal[]= $rentabilidadeMensalBO;
			$anoMesControle = aumentaAnoMes($anoMesControle);
			$rentabilidadeMensalBOControle = populaNovoRentabilidadeMensalBO($rentabilidadeMensalBO);
			
		}else {
			$listaDaListaRentMensal[]=$listaRentMensal;
			unset($listaRentMensal);
			$codigoInvestimento = $linha['ID_INVESTIMENTO'];
			$listaRentMensal[]= $rentabilidadeMensalBO;
			$anoMesControle = aumentaAnoMes($rentabilidadeMensalBO->getAnoMes());
			$rentabilidadeMensalBOControle = populaNovoRentabilidadeMensalBO($rentabilidadeMensalBO);
			
		}
	}else {
		$rentabilidadeMensalBO = new RentabilidadeMensalBO();
		$rentabilidadeMensalBO->setIdInvestimento($linha['ID_INVESTIMENTO']);
		$rentabilidadeMensalBO->setAnoMes($linha['ANO_MES']);
		$rentabilidadeMensalBO->setValorRendimentoMensal($linha['VL_RENDIMENTO_MENSAL']);
		if ($linha['ID_INVESTIMENTO'] == $codigoInvestimento) {
			$rentabilidadeMensalBOControle->setValorRendimentoMensal(($rentabilidadeMensalBOControle->getValorRendimentoMensal()+$rentabilidadeMensalBO->getValorRendimentoMensal())/2);
			while ($anoMesControle != $linha['ANO_MES']) {
				$rentabilidadeMensalBOControle->setAnoMes($anoMesControle);
				$listaRentMensal[] = $rentabilidadeMensalBOControle;
				$anoMesControle = aumentaAnoMes($anoMesControle);
			}
			$listaRentMensal[] = $rentabilidadeMensalBO;
			$anoMesControle = aumentaAnoMes($anoMesControle);
			$rentabilidadeMensalBOControle = populaNovoRentabilidadeMensalBO($rentabilidadeMensalBO);
		}else {
			$listaDaListaRentMensal[]=$listaRentMensal;
			unset($listaRentMensal);
			$codigoInvestimento = $linha['ID_INVESTIMENTO'];
			$listaRentMensal[]= $rentabilidadeMensalBO;
			$anoMesControle = aumentaAnoMes($rentabilidadeMensalBO->getAnoMes());
			$rentabilidadeMensalBOControle = populaNovoRentabilidadeMensalBO($rentabilidadeMensalBO);
		}
		
	}
	
}
$listaDaListaRentMensal[]=$listaRentMensal;


function aumentaAnoMes($anoMesControle) {
	if (substr($anoMesControle, -2)==12) {
		$anoMesControle = $anoMesControle+89;
	}else {
		$anoMesControle = $anoMesControle+1;
	};
	return $anoMesControle;
}

function populaNovoRentabilidadeMensalBO($param) {
	$rentabilidadeMensalBO = new RentabilidadeMensalBO();
	$rentabilidadeMensalBO->setIdInvestimento($param->getIdInvestimento());
	$rentabilidadeMensalBO->setAnoMes($param->getAnoMes());
	$rentabilidadeMensalBO->setValorRendimentoMensal($param->getValorRendimentoMensal());
	return $rentabilidadeMensalBO;
}

$listaAnoMes= array();
foreach ($listaDaListaRentMensal as $listaRentMensal){
	foreach ($listaRentMensal as $rentabilidadeMensalBO){
		$listaAnoMes[] = $rentabilidadeMensalBO->getAnoMes();
	}
}
$listaAnoMes = array_unique($listaAnoMes);
asort($listaAnoMes);

foreach ($listaAnoMes as $anoMes) {
	foreach ($listaDaListaRentMensal as $listaRentMensal){
		foreach ($listaRentMensal as $rentabilidadeMensalBO){
			if ($anoMes == $rentabilidadeMensalBO->getAnoMes()) {
				
				
				
				$rentabilidadeMensalBO2 = new RentabilidadeMensalBO();
				$rentabilidadeMensalBO2->setIdInvestimento($rentabilidadeMensalBO->getIdInvestimento());
				$rentabilidadeMensalBO2->setAnoMes($anoMes);
				$rentabilidadeMensalBO2->setValorRendimentoMensal(0);
				$listaRentMensal[] = $rentabilidadeMensalBO2;
			}
		}
	}
}

?>