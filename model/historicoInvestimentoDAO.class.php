<?php

require_once 'genericoDao.class.php';

class HistoricoInvestimentoDAO {
	
	private $genericoDAO;
	
	function __construct(){
		$this->genericoDAO = new genericoDAO();
	}
	
	public function cadastrarHistorico($historicoInvestimentoBO) {
		return $this->genericoDAO->insert("tb_historico_investimento",
											"ID_INVESTIMENTO,DT_ATUALIZACAO_HISTINVESTIMENTO,VLLIQUIDO_HISTINVESTIMENTO", 
				$historicoInvestimentoBO->getIdInvestimento()
				.",'".$historicoInvestimentoBO->getDtAtualizacao()."'"
				.",".$historicoInvestimentoBO->getValorLiquido());
	}
	
	public function consultarSaldoUltimaAtualizacao($idInvestimento) {
		return $this->genericoDAO->select("tb_historico_investimento",
											"max(DT_ATUALIZACAO_HISTINVESTIMENTO),VLLIQUIDO_HISTINVESTIMENTO",
				"ID_INVESTIMENTO = ".$idInvestimento);
	}
	
	
}

?>