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
				.",".$historicoInvestimentoBO->getValorLiquidoPadraoBD());
	}
	
	public function consultarSaldoUltimaAtualizacao($idInvestimento) {
		return $this->genericoDAO->select("tb_historico_investimento",
											"max(DT_ATUALIZACAO_HISTINVESTIMENTO),VLLIQUIDO_HISTINVESTIMENTO",
				"ID_INVESTIMENTO = ".$idInvestimento);
	}
	
	public function consultarDataAtualizacao($historicoInvestimentoBO) {
		
		
		return $this->genericoDAO->select("tb_historico_investimento", "DT_ATUALIZACAO_HISTINVESTIMENTO", 
				"DT_ATUALIZACAO_HISTINVESTIMENTO = '".$historicoInvestimentoBO->getDtAtualizacao()
				."' AND ID_INVESTIMENTO = ".$historicoInvestimentoBO->getIdInvestimento());
		
	}
	
}

?>