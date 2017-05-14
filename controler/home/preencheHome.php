<?php


	require_once '../../model/investimentoDAO.class.php';
	require_once '../../bo/investimentoBO.class.php';
	require_once '../../model/historicoInvestimentoDAO.class.php';
	require_once '../../bo/relHistoricoInvestimentoBO.class.php';
	require_once '../../model/rentabilidadeMensalDAO.class.php';
	require_once '../../bo/rentabilidadeMensalBO.class.php';
	
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
	
// Percentual por instituicao financeira
	$resultSomaSaldo = $investimentoDAO->consultaSaldoLiquidoPorInstituicao($_SESSION['ID_PESSOA']);
	$listaInvestimentoPorInstituicao = array();
	while ($linha = mysqli_fetch_array($resultSomaSaldo,MYSQLI_ASSOC)) {
		$investimentoBO = new investimentoBO();
		$investimentoBO->setNomeInstituicao($linha['NOME_INST_FINANCEIRA']);
		$investimentoBO->setSomaSaldoLiquido($linha['SOMA_SALDO_LIQUIDO']);
		$listaInvestimentoPorInstituicao[] = $investimentoBO;
	}
	
// Capital aplicado x Saldo Líquido Atual
	$resultCapitalSaldo = $investimentoDAO->consultaCapitalSaldoLiquidoPorPessoa($_SESSION['ID_PESSOA']);
	$listaCapitalSaldo = array();
	while ($linha = mysqli_fetch_array($resultCapitalSaldo,MYSQLI_ASSOC)) {
		$investimentoBO = new investimentoBO();
		$investimentoBO->setNomeInvestimento($linha['NOME_INVESTIMENTO']);
		$investimentoBO->setValorAplicacao($linha['VL_APLICACAO_INVESTIMENTO']);
		$investimentoBO->setValorSaldoLiquido($linha['VL_SALDO_LIQUIDO_INVESTIMENTO']);
		$listaCapitalSaldo[] = $investimentoBO;
	}
	
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
	
	
	//Rentabilidade Mensal
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
	
	
	
?>