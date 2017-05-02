<?php

class RentabilidadeMensalDAO {
	
	private $genericoDAO;
	
	function __construct(){
		$this->genericoDAO = new genericoDAO();
	}
	
	public function atualizarRentabilidadeMensal($historicoInvestimentoBO,$valorAplicado,$dataAplicacao) {
		$verificar = array(",");
		$substituir   = array(".");
		$valorAplicado = str_replace($verificar, $substituir, $valorAplicado);
		$sql = "

insert into maf.tb_rentabilidade_mensal (ID_INVESTIMENTO,ANO_MES,VL_RENDIMENTO_MENSAL,VL_SALDO_LIQUIDO_MENSAL,VL_PERCENT_RENTABILIDADE_MENSAL)
select 
	".$historicoInvestimentoBO->getIdInvestimento()." AS ID_INVESTIMENTO,
    (year('".$historicoInvestimentoBO->getDtAtualizacao()."')*100)+(month('".$historicoInvestimentoBO->getDtAtualizacao()."')) AS ANO_MES,
	cast(tbSaldoLiquido.RENDIMENTO_MENSAL as decimal(10,2)) as RENDIMENTO_MENSAL,
	cast(tbSaldoLiquido.SALDO_LIQUIDO as decimal(20,2)) as SALDO_LIQUIDO,
	cast((select case when month('".$dataAplicacao."') = month('".$historicoInvestimentoBO->getDtAtualizacao()."') and year('".$dataAplicacao."') = year('".$historicoInvestimentoBO->getDtAtualizacao()."') 
				then @percentRent := (RENDIMENTO_MENSAL / ".$valorAplicado.")*100
				else @percentRent := (RENDIMENTO_MENSAL / (select rm.VL_SALDO_LIQUIDO_MENSAL from maf.tb_rentabilidade_mensal rm where ANO_MES =  (year('".$historicoInvestimentoBO->getDtAtualizacao()."')*100)+(month('".$historicoInvestimentoBO->getDtAtualizacao()."')-1)) + (RENDIMENTO_MENSAL))*100
			end) as decimal(10,4)) PERCENTUAL_RENTABILIDADE
			
from
(
	select 
		QUANTIDADE_DIAS * MEDIA_RENDIMENTO_DIARIO as RENDIMENTO_MENSAL,
		(select case when month('".$dataAplicacao."') = month('".$historicoInvestimentoBO->getDtAtualizacao()."') and year('".$dataAplicacao."') = year('".$historicoInvestimentoBO->getDtAtualizacao()."') 
			then @saldoLiquido := ".$valorAplicado." + (QUANTIDADE_DIAS * MEDIA_RENDIMENTO_DIARIO)
			else @saldoLiquido := (select rm.VL_SALDO_LIQUIDO_MENSAL from maf.tb_rentabilidade_mensal rm where ANO_MES =  (year('".$historicoInvestimentoBO->getDtAtualizacao()."')*100)+(month('".$historicoInvestimentoBO->getDtAtualizacao()."')-1)) + (QUANTIDADE_DIAS * MEDIA_RENDIMENTO_DIARIO)
		end) SALDO_LIQUIDO
	from
		(SELECT 
			(select case when month('".$dataAplicacao."') = month('".$historicoInvestimentoBO->getDtAtualizacao()."') and year('".$dataAplicacao."') = year('".$historicoInvestimentoBO->getDtAtualizacao()."') 
				then @quantDias := day(last_day('".$dataAplicacao."')) - day('".$dataAplicacao."') 
				else @quantDias := day(last_day('".$historicoInvestimentoBO->getDtAtualizacao()."'))
			end) QUANTIDADE_DIAS,
			cast(avg(tabCalc.VL_RENDIMENTO_DIARIO) as decimal(10,2)) as MEDIA_RENDIMENTO_DIARIO
		FROM (
				select 
					
					hi.DT_ATUALIZACAO_HISTINVESTIMENTO,
					hi.VLLIQUIDO_HISTINVESTIMENTO,
					cast(( CAST((hi.VLLIQUIDO_HISTINVESTIMENTO - @valor) AS decimal(10,2)) / (datediff(hi.DT_ATUALIZACAO_HISTINVESTIMENTO, @data1))  ) AS decimal(10,2) ) as VL_RENDIMENTO_DIARIO,
					@valor := hi.VLLIQUIDO_HISTINVESTIMENTO as valorVar,
					@data1 := hi.DT_ATUALIZACAO_HISTINVESTIMENTO as dataVar
				from maf.tb_historico_investimento hi,  
				( select @valor := (SELECT 	VL_APLICACAO_INVESTIMENTO FROM maf.tb_investimento WHERE ID_INVESTIMENTO = ".$historicoInvestimentoBO->getIdInvestimento()." )) t2,
				( select @data1 := (SELECT  DT_APLICACAO_INVESTIMENTO FROM maf.tb_investimento WHERE ID_INVESTIMENTO = ".$historicoInvestimentoBO->getIdInvestimento()." )) t3
				where hi.ID_INVESTIMENTO = ".$historicoInvestimentoBO->getIdInvestimento()." 
				order by hi.DT_ATUALIZACAO_HISTINVESTIMENTO asc
			) tabCalc
	where   month(tabCalc.DT_ATUALIZACAO_HISTINVESTIMENTO) = month('".$historicoInvestimentoBO->getDtAtualizacao()."')
	AND year(tabCalc.DT_ATUALIZACAO_HISTINVESTIMENTO) = year('".$historicoInvestimentoBO->getDtAtualizacao()."')) tb
)tbSaldoLiquido


";
		
		return $this->genericoDAO->sqlDireto($sql, "INSERT");
		
	}
}
?>