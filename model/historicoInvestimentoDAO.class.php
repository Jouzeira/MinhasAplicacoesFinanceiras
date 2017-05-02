<?php

require_once 'genericoDao.class.php';
require_once 'investimentoDAO.class.php';
require_once 'rentabilidadeMensalDAO.class.php';

class HistoricoInvestimentoDAO {
	
	private $genericoDAO;
	
	function __construct(){
		$this->genericoDAO = new genericoDAO();
	}
	
	public function cadastrarHistorico($historicoInvestimentoBO,$valorAplicado,$dataAplicacao) {
		$this->genericoDAO->insert("tb_historico_investimento",
											"ID_INVESTIMENTO,DT_ATUALIZACAO_HISTINVESTIMENTO,VLLIQUIDO_HISTINVESTIMENTO", 
				$historicoInvestimentoBO->getIdInvestimento()
				.",'".$historicoInvestimentoBO->getDtAtualizacao()."'"
				.",".$historicoInvestimentoBO->getValorLiquidoPadraoBD());
		
		$resultMaxDataAtualizacao = $this->consultarSaldoUltimaAtualizacao($historicoInvestimentoBO->getIdInvestimento());
		
		$investimentoDao = new InvestimentoDAO();
		$investimentoDao->alterarValorSaldoLiquido($historicoInvestimentoBO->getIdInvestimento(), mysqli_fetch_array($resultMaxDataAtualizacao,MYSQLI_ASSOC)['VLLIQUIDO_HISTINVESTIMENTO']);
		
		$rentabilidadeMensalDAO = new RentabilidadeMensalDAO();
		return $rentabilidadeMensalDAO->atualizarRentabilidadeMensal($historicoInvestimentoBO,$valorAplicado,$dataAplicacao);
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
		return $this->genericoDAO->sqlDireto(
				"SELECT * 
					FROM (
							select 
								hi.ID_HISTORICO_INVESTIMENTO,
								hi.ID_INVESTIMENTO,
								hi.DT_ATUALIZACAO_HISTINVESTIMENTO,
								hi.VLLIQUIDO_HISTINVESTIMENTO,
								cast(( CAST((hi.VLLIQUIDO_HISTINVESTIMENTO - @valor) AS decimal(10,2)) / (datediff(hi.DT_ATUALIZACAO_HISTINVESTIMENTO, @data1))  ) AS decimal(10,2) ) as VL_RENDIMENTO_DIARIO,
								@valor := hi.VLLIQUIDO_HISTINVESTIMENTO as valorVar,
								@data1 := hi.DT_ATUALIZACAO_HISTINVESTIMENTO as dataVar
							from maf.tb_historico_investimento hi,  
							( select @valor := (SELECT 	VL_APLICACAO_INVESTIMENTO FROM maf.tb_investimento WHERE ID_INVESTIMENTO = ".$idInvestimento." )) t2,
							( select @data1 := (SELECT  DT_APLICACAO_INVESTIMENTO FROM maf.tb_investimento WHERE ID_INVESTIMENTO = ".$idInvestimento." )) t3
							where hi.ID_INVESTIMENTO = ".$idInvestimento."
							order by hi.DT_ATUALIZACAO_HISTINVESTIMENTO asc 
						) tabCalc
					ORDER BY tabCalc.DT_ATUALIZACAO_HISTINVESTIMENTO DESC "
				, "select");
	}
	
	public function excluirHistoricoPorId($idHistorico,$idInvestimento) {
		$this->genericoDAO->delete("tb_historico_investimento",
									"ID_HISTORICO_INVESTIMENTO = ".$idHistorico);
		$result = $this->consultarHistoricoPorIdInvestimento($idInvestimento);
		$investimentoDAO = new InvestimentoDAO();
		return $investimentoDAO->alterarValorSaldoLiquido($idInvestimento, mysqli_fetch_array($result,MYSQLI_ASSOC)['VLLIQUIDO_HISTINVESTIMENTO']);
		
	}
	
}

?>