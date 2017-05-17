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
    FROM u859943329_maf.tb_historico_investimento 
    where ID_INVESTIMENTO = ".$idInvestimento." and
    DT_ATUALIZACAO_HISTINVESTIMENTO = (select  max(DT_ATUALIZACAO_HISTINVESTIMENTO)
											FROM u859943329_maf.tb_historico_investimento 
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
							from u859943329_maf.tb_historico_investimento hi,  
							( select @valor := (SELECT 	VL_APLICACAO_INVESTIMENTO FROM u859943329_maf.tb_investimento WHERE ID_INVESTIMENTO = ".$idInvestimento." )) t2,
							( select @data1 := (SELECT  DT_APLICACAO_INVESTIMENTO FROM u859943329_maf.tb_investimento WHERE ID_INVESTIMENTO = ".$idInvestimento." )) t3
							where hi.ID_INVESTIMENTO = ".$idInvestimento."
							order by hi.DT_ATUALIZACAO_HISTINVESTIMENTO asc 
						) tabCalc
					ORDER BY tabCalc.DT_ATUALIZACAO_HISTINVESTIMENTO DESC "
				, "select");
	}
	
	public function excluirHistoricoPorId($idHistorico,$idInvestimento) {
		
		$resultHistorico = $this->consultarHistoricoPorId($idHistorico);
		$historicoBO = new HistoricoInvestimentoBO();
		while ($linha = mysqli_fetch_array($resultHistorico,MYSQLI_ASSOC)) {
			$historicoBO->setId($linha['ID_HISTORICO_INVESTIMENTO']);
			$historicoBO->setIdInvestimento($linha['ID_INVESTIMENTO']);
			$historicoBO->setDtAtualizacao($linha['DT_ATUALIZACAO_HISTINVESTIMENTO']);
			$historicoBO->setValorLiquido($linha['VLLIQUIDO_HISTINVESTIMENTO']);
		}
		
		$investimentoDAO = new InvestimentoDAO();
		$arrayInvestimento = $investimentoDAO->consultarPorId($idInvestimento);
		
		$this->genericoDAO->delete("tb_historico_investimento",
									"ID_HISTORICO_INVESTIMENTO = ".$idHistorico);
		$result = $this->consultarHistoricoPorIdInvestimento($idInvestimento);
		$valor = mysqli_fetch_array($result,MYSQLI_ASSOC)['VLLIQUIDO_HISTINVESTIMENTO'];
		if ($valor == null) {
			$valor = $arrayInvestimento['VL_APLICACAO_INVESTIMENTO'];
		}
		$investimentoDAO = new InvestimentoDAO();
		$investimentoDAO->alterarValorSaldoLiquido($idInvestimento, $valor);
		$rentabilidadeMensalDAO = new RentabilidadeMensalDAO();
		return $rentabilidadeMensalDAO->atualizarRentabilidadeMensal($historicoBO,$valor,$arrayInvestimento['DT_APLICACAO_INVESTIMENTO']);
		
	}
	
	public function consultarHistoricoPorId($idHistorico) {
		return $this->genericoDAO->select("tb_historico_investimento","*","ID_HISTORICO_INVESTIMENTO = ".$idHistorico);
	}
	
	public function consultarRelHistoricoInvestimento($idPessoa) {
		
		$sql = "select * FROM
				(
				SELECT 
				hi.ID_INVESTIMENTO as ID_INVESTIMENTO,
				hi.DT_ATUALIZACAO_HISTINVESTIMENTO AS DATA_1,
				hi.VLLIQUIDO_HISTINVESTIMENTO AS VALOR,
				i.NOME_INVESTIMENTO AS NOME
				FROM u859943329_maf.tb_historico_investimento hi, u859943329_maf.tb_investimento i
				where hi.ID_INVESTIMENTO = i.ID_INVESTIMENTO
				and i.ID_PESSOA = ".$idPessoa."
				union
				select 
				ID_INVESTIMENTO AS ID_INVESTIMENTO,
				DT_APLICACAO_INVESTIMENTO AS DATA_1,
				VL_APLICACAO_INVESTIMENTO AS VALOR,
				NOME_INVESTIMENTO AS NOME
				from u859943329_maf.tb_investimento
				where ID_PESSOA = ".$idPessoa.") TB_UNIAO
				order by TB_UNIAO.ID_INVESTIMENTO, DATA_1";
		
		return $this->genericoDAO->sqlDireto($sql, "SELECT");
	}
	
}

?>