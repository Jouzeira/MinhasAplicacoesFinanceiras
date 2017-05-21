<?php

require_once 'genericoDao.class.php';

class RentabilidadeMensalDAO {
	
	private $genericoDAO;
	
	function __construct(){
		$this->genericoDAO = new genericoDAO();
	}
	
	public function atualizarRentabilidadeMensal($historicoInvestimentoBO,$valorAplicado,$dataAplicacao) {
		
		$verificar = array(",");
		$substituir   = array(".");
		$valorAplicado = str_replace($verificar, $substituir, $valorAplicado);
		
		$this->genericoDAO = new genericoDAO();
		$this->genericoDAO->delete("tb_rentabilidade_mensal", "ID_INVESTIMENTO = ".$historicoInvestimentoBO->getIdInvestimento());

		
		
$sql ="	insert into u859943329_maf.tb_rentabilidade_mensal (ID_INVESTIMENTO,ANO_MES,VL_RENDIMENTO_MENSAL,VL_PERCENT_RENTABILIDADE_MENSAL,VL_SALDO_LIQUIDO_MENSAL) 	
(select 
	".$historicoInvestimentoBO->getIdInvestimento()." AS ID_INVESTIMENTO,
	ANO_MES,
	cast((DIFF_DIA * RENDIMENTO_MENSAL) as decimal(10,2)) as VL_RENDIMENTO_MENSAL,
	@valorAplicado2 := cast((cast((DIFF_DIA * RENDIMENTO_MENSAL) as decimal(10,2)) / @valorAplicado)*100 as decimal(10,4) )as VL_PERCENT_RENTABILIDADE_MENSAL,
	@valorAplicado := @valorAplicado + cast((DIFF_DIA * RENDIMENTO_MENSAL) as decimal(10,2)) as VL_SALDO_LIQUIDO_MENSAL
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
					from u859943329_maf.tb_historico_investimento hi,  
					( select @valor := ".$valorAplicado.") t2,
					( select @data1 := '".$dataAplicacao."') t3
					where hi.ID_INVESTIMENTO = ".$historicoInvestimentoBO->getIdInvestimento()." 
					order by hi.DT_ATUALIZACAO_HISTINVESTIMENTO asc) tb_rent,
			(select @valorDif := 0) t4) tb_media
	group by ANO_MES) tb,
    (select @valorAplicado := ".$valorAplicado.") tb_ap)
";
				$this->genericoDAO = new genericoDAO();
		return $this->genericoDAO->sqlDireto($sql, "INSERT");
		
	}
	
	public  function consultaRentabilidadesPorListaInvestimentos($listaInvestimentos) {
		$sql = "SELECT 
					rm.ID_INVESTIMENTO,
					rm.ANO_MES,
					rm.VL_RENDIMENTO_MENSAL,
					i.NOME_INVESTIMENTO
				FROM u859943329_maf.tb_rentabilidade_mensal rm,
				u859943329_maf.tb_investimento i
				where i.ID_INVESTIMENTO = rm.ID_INVESTIMENTO
					and rm.ID_INVESTIMENTO in (";
		foreach ($listaInvestimentos as $value) {
			$sql.= $value.",";
		}
		$sql = substr($sql, 0,-1);
		$sql.= ") order by rm.ID_INVESTIMENTO,rm.ANO_MES";
		return $this->genericoDAO->sqlDireto($sql, "SELECT");
	}
	
	public function consultaRentabilidadePorIdUsuario($idUsuario){
		$sql .= "SELECT
					I.ID_INVESTIMENTO
				FROM u859943329_maf.tb_investimento AS I
				WHERE I.ID_PESSOA = ".$idUsuario;
		
		$resultListaIdInvestimentos =  $this->genericoDAO->sqlDireto($sql, "select");
		$listaIdInvestimento = array();
		while ($linha = mysqli_fetch_array($resultListaIdInvestimentos, MYSQLI_ASSOC)){
			$listaIdInvestimento[] = $linha;
		} // /while
		return $this->consultaRentabilidadesPorListaInvestimentos($listaIdInvestimentos);
	} // /function consultaRentabilidadePorIdUsuario
	
	public function consultarRentabilidadeJTable ($sql) {
		return $this->genericoDAO->sqlDireto($sql, "SELECT");
	}
	
	public function consultaListaAnoMes($idPessoa){
		$sql = "SELECT DISTINCT RM.ANO_MES
				FROM u859943329_maf.tb_rentabilidade_mensal AS RM
				JOIN u859943329_maf.tb_investimento AS I
				ON I.ID_INVESTIMENTO = RM.ID_INVESTIMENTO
				WHERE I.ID_PESSOA = ".$idPessoa." 
				ORDER BY RM.ANO_MES DESC";
		return $this->genericoDAO->sqlDireto($sql, "SELECT");
	}
	
	
}

?>