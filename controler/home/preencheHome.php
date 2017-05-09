<?php

	require_once '../../model/investimentoDAO.class.php';
	require_once '../../bo/investimentoBO.class.php';
	require_once '../../model/historicoInvestimentoDAO.class.php';
	require_once '../../bo/relHistoricoInvestimentoBO.class.php';
	require_once '../../model/rentabilidadeMensalDAO.class.php';
	require_once '../../bo/rentabilidadeMensalBO.class.php';
	
	$investimentoDAO = new InvestimentoDAO();
	$resultSomaSaldo = $investimentoDAO->consultaSaldoLiquidoPorTipoInvestimento($_SESSION['ID_PESSOA']);
	$listaInvestimentoPorTipo = array();
	while ($linha = mysqli_fetch_array($resultSomaSaldo,MYSQLI_ASSOC)) {
		$investimentoBO = new investimentoBO();
		$investimentoBO->setNomeTipoInvestimento($linha['NOME_TIPO_INVESTIMENTO']);
		$investimentoBO->setSomaSaldoLiquido($linha['SOMA_SALDO_LIQUIDO']);
		$listaInvestimentoPorTipo[] = $investimentoBO;
	}

	$resultSomaSaldo = $investimentoDAO->consultaSaldoLiquidoPorInstituicao($_SESSION['ID_PESSOA']);
	$listaInvestimentoPorInstituicao = array();
	while ($linha = mysqli_fetch_array($resultSomaSaldo,MYSQLI_ASSOC)) {
		$investimentoBO = new investimentoBO();
		$investimentoBO->setNomeInstituicao($linha['NOME_INST_FINANCEIRA']);
		$investimentoBO->setSomaSaldoLiquido($linha['SOMA_SALDO_LIQUIDO']);
		$listaInvestimentoPorInstituicao[] = $investimentoBO;
	}

	$resultCapitalSaldo = $investimentoDAO->consultaCapitalSaldoLiquidoPorPessoa($_SESSION['ID_PESSOA']);
	$listaCapitalSaldo = array();
	while ($linha = mysqli_fetch_array($resultCapitalSaldo,MYSQLI_ASSOC)) {
		$investimentoBO = new investimentoBO();
		$investimentoBO->setNomeInvestimento($linha['NOME_INVESTIMENTO']);
		$investimentoBO->setValorAplicacao($linha['VL_APLICACAO_INVESTIMENTO']);
		$investimentoBO->setValorSaldoLiquido($linha['VL_SALDO_LIQUIDO_INVESTIMENTO']);
		$listaCapitalSaldo[] = $investimentoBO;
	}
	
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
	if (count($listaRelHistoricoInvestimentoBO)==1) {
			$listaDaLista[]=$listaRelHistoricoInvestimentoBO;
	}
	
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
		echo $anoMesControle." 1 <br>";
		if ($anoMesControle == $linha['ANO_MES']) {
		echo $anoMesControle." 2 <br>";
			$rentabilidadeMensalBO = new RentabilidadeMensalBO();
			$rentabilidadeMensalBO->setIdInvestimento($linha['ID_INVESTIMENTO']);
			$rentabilidadeMensalBO->setAnoMes($linha['ANO_MES']);
			$rentabilidadeMensalBO->setValorRendimentoMensal($linha['VL_RENDIMENTO_MENSAL']);
			
			if ($linha['ID_INVESTIMENTO'] == $codigoInvestimento) {
				echo $anoMesControle." 3 <br>";
				$listaRentMensal[]= $rentabilidadeMensalBO;
				$anoMesControle = aumentaAnoMes($anoMesControle);
				$rentabilidadeMensalBOControle = $rentabilidadeMensalBO;
				
			}else {
				echo $anoMesControle." 4 <br>";
				$listaDaListaRentMensal[]=$listaRentMensal;
				unset($listaRentMensal);
				$codigoInvestimento = $linha['ID_INVESTIMENTO'];
				$listaRentMensal[]= $rentabilidadeMensalBO;
				$anoMesControle = aumentaAnoMes($rentabilidadeMensalBO->getAnoMes());
				$rentabilidadeMensalBOControle = $rentabilidadeMensalBO;
				
			}
		}else {
			echo $anoMesControle." 5 <br>";
			$rentabilidadeMensalBO = new RentabilidadeMensalBO();
			$rentabilidadeMensalBO->setIdInvestimento($linha['ID_INVESTIMENTO']);
			$rentabilidadeMensalBO->setAnoMes($linha['ANO_MES']);
			$rentabilidadeMensalBO->setValorRendimentoMensal($linha['VL_RENDIMENTO_MENSAL']);
			if ($linha['ID_INVESTIMENTO'] == $codigoInvestimento) {
				echo $anoMesControle." 6 <br>";
				$rentabilidadeMensalBOControle->setValorRendimentoMensal(($rentabilidadeMensalBOControle->getValorRendimentoMensal()+$rentabilidadeMensalBO->getValorRendimentoMensal())/2);
				while ($anoMesControle != $linha['ANO_MES']) {
					echo $anoMesControle." 7 <br>";
					echo $linha['ANO_MES']." 77 <br>";
					$rentabilidadeMensalBOControle->setAnoMes($anoMesControle);
					$listaRentMensal[] = $rentabilidadeMensalBOControle;
					$anoMesControle = aumentaAnoMes($anoMesControle);
				}
				echo $anoMesControle." 10 <br>";
				$listaRentMensal[] = $rentabilidadeMensalBO;
				$anoMesControle = aumentaAnoMes($anoMesControle);
				$rentabilidadeMensalBOControle = $rentabilidadeMensalBO;
			}else {
				echo $anoMesControle." 8 <br>";
				$listaDaListaRentMensal[]=$listaRentMensal;
				unset($listaRentMensal);
				$codigoInvestimento = $linha['ID_INVESTIMENTO'];
				$listaRentMensal[]= $rentabilidadeMensalBO;
				$anoMesControle = aumentaAnoMes($rentabilidadeMensalBO->getAnoMes());
				$rentabilidadeMensalBOControle = $rentabilidadeMensalBO;
			}
			
		}
		
	}
	if (count($listaRentMensal)==1) {
		echo $anoMesControle." 9 <br>";
		$listaDaListaRentMensal[]=$listaRentMensal;
	}
	
	
	function aumentaAnoMes($anoMesControle) {
		if (substr($anoMesControle, -2)==12) {
			$anoMesControle = $anoMesControle+89;
		}else {
			$anoMesControle = $anoMesControle+1;
		};
		return $anoMesControle;
	}
	
	foreach ($listaDaListaRentMensal as $listaRentMensal) {
		foreach ($listaRentMensal as $value) {
			echo $value->getIdInvestimento()." - ". $value->getAnoMes()." - ".$value->getValorRendimentoMensal()."<br>";
		}
	}
	die();
	
?>