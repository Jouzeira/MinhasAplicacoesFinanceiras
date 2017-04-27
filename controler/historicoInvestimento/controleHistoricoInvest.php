<?php

require_once '../../model/historicoInvestimentoDAO.class.php';
require_once '../../bo/historicoInvestimentoBO.class.php';

switch ( $_GET['acao']) {
	case "cadastrar":
		
		$historicoInvestimentoBO = new HistoricoInvestimentoBO();
		$historicoInvestimentoBO->setIdInvestimento($_GET['idInvestimento']);
		$historicoInvestimentoBO->setDtAtualizacao($_GET['dtAtualizacao']);
		$historicoInvestimentoBO->setValorLiquido($_GET['valorLiquido']);
		
		$historicoInvestimentoDAO = new HistoricoInvestimentoDAO();
		
		if ($historicoInvestimentoDAO->cadastrarHistorico($historicoInvestimentoBO)) {
			header('Location: ../../visao/historicoInvestimento/atualizarHistoricoInvestimentos.php?msgIncluir=1');
		}else {
			echo "Erro a cadastrar Hstórico de Investimento.";
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