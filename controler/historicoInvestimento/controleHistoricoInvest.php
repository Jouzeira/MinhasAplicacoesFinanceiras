<?php

require_once '../../model/historicoInvestimentoDAO.class.php';
require_once '../../bo/historicoInvestimentoBO.class.php';
require_once '../../model/investimentoDAO.class.php';
require_once '../../bo/investimentoBO.class.php';

switch ( $_GET['acao']) {
	case "cadastrar":
		
		if ($_POST['saldoLiquido']<=$_POST['valorLiquido']) {
			
			$historicoInvestimentoBO = new HistoricoInvestimentoBO();
			$historicoInvestimentoBO->setIdInvestimento($_POST['idInvestimento']);
			$historicoInvestimentoBO->setDtAtualizacao($_POST['dtAtualizacao']);
			$historicoInvestimentoBO->setValorLiquido($_POST['valorLiquido']);
			
			$historicoInvestimentoDAO = new HistoricoInvestimentoDAO();
			if (mysqli_fetch_array($historicoInvestimentoDAO->consultarDataAtualizacao($historicoInvestimentoBO))) {
				header('Location: ../../visao/historicoInvestimento/atualizarHistoricoInvestimentos.php?valor='.$_POST['idInvestimento'].'&msgErroData=1');
				die();
			}
			
			
			if ($historicoInvestimentoDAO->cadastrarHistorico($historicoInvestimentoBO)) {
				
				$investimentoDAO = new InvestimentoDAO();
				if ($investimentoDAO->alterarValorSaldoLiquido($historicoInvestimentoBO->getIdInvestimento(),$historicoInvestimentoBO->getValorLiquidoPadraoBD())) {
					header('Location: ../../visao/historicoInvestimento/atualizarHistoricoInvestimentos.php?valor='.$historicoInvestimentoBO->getIdInvestimento().'&msgIncluir=1');
				}else {
					echo "Erro a alterar o valor do saldo liquido do investimento.";
					die();
				}
				
			}else {
				echo "Erro a cadastrar Hstórico de Investimento.";
				die();
			}
		}else {
			header('Location: ../../visao/historicoInvestimento/atualizarHistoricoInvestimentos.php?valor='.$_POST['idInvestimento'].'&msgErroValorMenor=1');
			die();
		}
		
		break;
	case "alterar":
		break;
	case "excluir":
		break;
		
	default:
		echo "Teste: ";
		die();
		break;
}
?>