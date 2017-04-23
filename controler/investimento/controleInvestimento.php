<?php

session_start();

require_once '../../bo/investimentoBO.class.php';
require_once '../../model/investimentoDAO.class.php';

switch ( $_GET['acao']) {
	case "excluir":
		$investimentoDAO = new InvestimentoDAO();
		if ($investimentoDAO->excluirInvestimento($_GET['valor'])) {
			header('Location: ../../visao/investimentos/investimentos.php?msgExcluir=1');
		}else {
			echo "Erro ao cadastrar o Investimento.";
			die();;
		}
	break;
	case "cadastrar":
		
		$investimentoDAO = new InvestimentoDAO();
		
		if ($investimentoDAO->cadastrarInvestimento(populaInvestimentoBO())) {
			header('Location: ../../visao/investimentos/investimentos.php?msgIncluir=1');
		}else {
			echo "Erro ao cadastrar o Investimento.";
			die();
		}
	break;
	case "alterar":
		
		$investimentoDAO = new InvestimentoDAO();
		
		if ($investimentoDAO->alterarInvestimento(populaInvestimentoBO())) {
			header('Location: ../../visao/investimentos/investimentos.php?msgAlterar=1');
		}else {
			echo "Erro ao alterar o Investimento.";
			die();
		}
	break;
	
	default:
		echo "Teste: ";
		die();
	break;
}




/**
 * 
 */

function populaInvestimentoBO() {
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
	$investimentoBO->setId(isset($_POST['idInvestimento'])?$_POST['idInvestimento']:null);
	return $investimentoBO;
}

?>
