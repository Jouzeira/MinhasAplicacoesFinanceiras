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
		
		$sqlConsulta = "SELECT ANO_MES FROM maf.tb_rentabilidade_mensal 
						where ANO_MES = ( Year('".$historicoInvestimentoBO->getDtAtualizacao()."') * 100 ) + ( Month('".$historicoInvestimentoBO->getDtAtualizacao()."'))
						and ID_INVESTIMENTO = ".$historicoInvestimentoBO->getIdInvestimento();
		
		$resultAnoMes = $this->genericoDAO->sqlDireto($sqlConsulta, "SELECT");
		
		$existe = false;
		if (mysqli_fetch_array($resultAnoMes,MYSQLI_ASSOC)) {
			$existe= true;
		}
		
		$sql="";
		
		if ($existe) {
			$sql .= "update maf.tb_rentabilidade_mensal rm, ";
		}else {
			$sql .= "insert into maf.tb_rentabilidade_mensal (ID_INVESTIMENTO,ANO_MES,VL_RENDIMENTO_MENSAL) ";
		}
$sql.="		
(select 
".$historicoInvestimentoBO->getIdInvestimento()." AS ID_INVESTIMENTO,
( Year('".$historicoInvestimentoBO->getDtAtualizacao()."') * 100 ) + ( Month('".$historicoInvestimentoBO->getDtAtualizacao()."') )   AS ANO_MES,
cast(TB_REND_MENSAL.VL_RENDIMENTO_MENSAL AS decimal(10,2)) AS VL_RENDIMENTO_MENSAL
from
		(select 
		case when Month('".$dataAplicacao."') = Month('".$historicoInvestimentoBO->getDtAtualizacao()."') AND Year('".$dataAplicacao."') = Year('".$historicoInvestimentoBO->getDtAtualizacao()."') THEN 
			@qtDias := Day(Last_day('".$dataAplicacao."')) - Day('".$dataAplicacao."') 
		else
			@qtDias := Day(Last_day('".$historicoInvestimentoBO->getDtAtualizacao()."'))
		end as DIFF_DIA,
		@mediaMensal := ifnull(avg(RENT_DIARIA),0) * @qtDias AS VL_RENDIMENTO_MENSAL
		FROM
				(select 
					hi.DT_ATUALIZACAO_HISTINVESTIMENTO,
					CAST((hi.VLLIQUIDO_HISTINVESTIMENTO - @valor) AS decimal(10,2)) as difValor,
					(datediff(hi.DT_ATUALIZACAO_HISTINVESTIMENTO, @data1)) as difData,
					cast(( CAST((hi.VLLIQUIDO_HISTINVESTIMENTO - @valor) AS decimal(10,2)) / (datediff(hi.DT_ATUALIZACAO_HISTINVESTIMENTO, @data1))  ) AS decimal(10,2) ) as RENT_DIARIA,
					@valor := hi.VLLIQUIDO_HISTINVESTIMENTO as valorVar,
					@data1 := hi.DT_ATUALIZACAO_HISTINVESTIMENTO as dataVar
				from maf.tb_historico_investimento hi,  
				( select @valor := ".$valorAplicado.") t2,
				( select @data1 := '".$dataAplicacao."') t3
				where hi.ID_INVESTIMENTO = ".$historicoInvestimentoBO->getIdInvestimento()."
				order by hi.DT_ATUALIZACAO_HISTINVESTIMENTO asc) TB_REND
		where month(TB_REND.DT_ATUALIZACAO_HISTINVESTIMENTO)=month('".$historicoInvestimentoBO->getDtAtualizacao()."')
		AND year(TB_REND.DT_ATUALIZACAO_HISTINVESTIMENTO)=year('".$historicoInvestimentoBO->getDtAtualizacao()."')) TB_REND_MENSAL)
";
		
		if ($existe) {
			$sql .= " rm2 set rm.VL_RENDIMENTO_MENSAL = rm2.VL_RENDIMENTO_MENSAL
						where rm.ANO_MES = ( Year('".$historicoInvestimentoBO->getDtAtualizacao()."') * 100 ) + ( Month('".$historicoInvestimentoBO->getDtAtualizacao()."') )
							and rm.ID_INVESTIMENTO = ".$historicoInvestimentoBO->getIdInvestimento();
		}
		
		return $this->genericoDAO->sqlDireto($sql, "INSERT");
		
	}
}
?>