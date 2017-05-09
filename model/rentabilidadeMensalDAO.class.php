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
		
		$this->genericoDAO->delete("tb_rentabilidade_mensal", "ID_INVESTIMENTO = ".$historicoInvestimentoBO->getIdInvestimento());

		
		
$sql ="	insert into maf.tb_rentabilidade_mensal (ID_INVESTIMENTO,ANO_MES,VL_RENDIMENTO_MENSAL) 	
(select 
	".$historicoInvestimentoBO->getIdInvestimento()." AS ID_INVESTIMENTO,
	ANO_MES,
	cast((DIFF_DIA * RENDIMENTO_MENSAL) as decimal(10,2)) as VL_RENDIMENTO_MENSAL
from
	(select 
		case when ( Year(dataVar) * 100 ) + ( Month(dataVar) ) = ( Year('".$dataAplicacao."') * 100 ) + ( Month('".$dataAplicacao."') ) THEN 
			@qtDias := Day(Last_day('".$dataAplicacao."')) - Day('".$dataAplicacao."') 
		else
			@qtDias := Day(Last_day(dataVar))
		end as DIFF_DIA,
		avg(RENT_MENSAL) AS RENDIMENTO_MENSAL,
		( Year(dataVar) * 100 ) + ( Month(dataVar) ) as ANO_MES
	from
			(select
				(RENT_DIARIA + @valorDif)/2 as RENT_MENSAL,
				@valorDif := RENT_DIARIA as valorAnterior,
				dataVar
			from
					(select 
						cast(( CAST((hi.VLLIQUIDO_HISTINVESTIMENTO - @valor) AS decimal(10,2)) / (datediff(hi.DT_ATUALIZACAO_HISTINVESTIMENTO, @data1))  ) AS decimal(10,2) ) as RENT_DIARIA,
						@valor := hi.VLLIQUIDO_HISTINVESTIMENTO as valorVar,
						@data1 := hi.DT_ATUALIZACAO_HISTINVESTIMENTO as dataVar
					from maf.tb_historico_investimento hi,  
					( select @valor := ".$valorAplicado.") t2,
					( select @data1 := '".$dataAplicacao."') t3
					where hi.ID_INVESTIMENTO = ".$historicoInvestimentoBO->getIdInvestimento()." 
					order by hi.DT_ATUALIZACAO_HISTINVESTIMENTO asc) tb_rent,
			(select @valorDif := 0) t4) tb_media
	group by ANO_MES) tb)
";
		
		return $this->genericoDAO->sqlDireto($sql, "INSERT");
		
	}
	
	public  function consultaRentabilidadesPorListaInvestimentos($listaInvestimentos) {
		$sql = "SELECT * FROM maf.tb_rentabilidade_mensal
				where ID_INVESTIMENTO in (";
		foreach ($listaInvestimentos as $value) {
			$sql.= $value.",";
		}
		$sql = substr($sql, 0,-1);
		$sql.= ") order by ID_INVESTIMENTO,ANO_MES";
		return $this->genericoDAO->sqlDireto($sql, "SELECT");
	}
}
?>