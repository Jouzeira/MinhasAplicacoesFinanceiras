<?php

require_once 'genericoDao.class.php';

class HistoricoInvestimentoDAO {
	
	private $genericoDAO;
	
	function __construct(){
		$this->genericoDAO = new genericoDAO();
	}
	
	public function cadastrarHistorico($historicoInvestimentoBO) {
		return $this->genericoDAO->insert("tb_historico_investimento",
											"ID_INVESTIMENTO,DT_ATUALIZACAO_HISTINVESTIMENTO,VLLIQUIDO_HISTINVESTIMENTO,VL_RENDIMENTO_DIARIO", 
				$historicoInvestimentoBO->getIdInvestimento()
				.",'".$historicoInvestimentoBO->getDtAtualizacao()."'"
				.",".$historicoInvestimentoBO->getValorLiquidoPadraoBD()
				.",".$historicoInvestimentoBO->getValorRendimentoDiario());
	}
	
	public function consultarSaldoUltimaAtualizacao($idInvestimento) {
		
		$sql = "SELECT 
	DT_ATUALIZACAO_HISTINVESTIMENTO 
    ,VLLIQUIDO_HISTINVESTIMENTO 
    FROM maf.tb_historico_investimento 
    where ID_INVESTIMENTO = ".$idInvestimento." and
    DT_ATUALIZACAO_HISTINVESTIMENTO = (select  max(DT_ATUALIZACAO_HISTINVESTIMENTO)
											FROM maf.tb_historico_investimento 
											where ID_INVESTIMENTO = ".$idInvestimento." ) ";
		
		return $this->genericoDAO->sqlDireto($sql, "select");
	}
	
	public function consultarDataAtualizacao($historicoInvestimentoBO) {
		
		return $this->genericoDAO->select("tb_historico_investimento", "DT_ATUALIZACAO_HISTINVESTIMENTO", 
				"DT_ATUALIZACAO_HISTINVESTIMENTO = '".$historicoInvestimentoBO->getDtAtualizacao()
				."' AND ID_INVESTIMENTO = ".$historicoInvestimentoBO->getIdInvestimento());
		
	}
	
	public function consultarHistoricoPorIdInvestimento($idInvestimento) {
		return $this->genericoDAO->select("tb_historico_investimento",
											"*",
											"ID_INVESTIMENTO = ".$idInvestimento." order by DT_ATUALIZACAO_HISTINVESTIMENTO desc");
	}
	
}

?>