<?php

require_once 'genericoDao.class.php';

class InvestimentoDAO {
	
	private $genericoDAO;
	
	function __construct(){
		$this->genericoDAO = new genericoDAO();
	}
	
	function consultaListaInvestimentoPersonalizado($idPessoa) {
		$sql = "SELECT 
				i.ID_INVESTIMENTO,
				ti.NOME_TIPO_INVESTIMENTO,
				i.ID_PESSOA ,
				tr.NOME_TIPO_RENDA ,
				i.ID_TIPO_CATEGORIA ,
				ifi.NOME_INST_FINANCEIRA ,
				i.NOME_INVESTIMENTO ,
				i.DT_APLICACAO_INVESTIMENTO,
				i.DT_MINIMA_RESGATE_INVESTIMENTO ,
				i.DT_VENCIMENTO_INVESTIMENTO ,
				i.VL_APLICACAO_INVESTIMENTO,
				i.TX_CONTRATADA_INVESTIMENTO ,
				i.TX_CORRETAGEM_INVESTIMENTO,
				i.VL_SALDO_LIQUIDO_INVESTIMENTO ,
				(select count(hi.ID_HISTORICO_INVESTIMENTO) from u859943329_maf.tb_historico_investimento hi where hi.ID_INVESTIMENTO = i.ID_INVESTIMENTO) as POSSUI_ATUALIZACOES
				FROM 	u859943329_maf.tb_investimento i 
						,u859943329_maf.tb_tipo_investimento ti
				        ,u859943329_maf.tb_tipo_renda tr
				        ,u859943329_maf.tb_instituicao_financeira ifi
				where i.ID_PESSOA = ".$idPessoa."
				and i.ID_TIPO_INVESTIMENTO = ti.ID_TIPO_INVESTIMENTO 
				and tr.ID_TIPO_RENDA = i.ID_TIPO_RENDA
				and ifi.ID_INST_FINANCEIRA = i.ID_INST_FINANCEIRA";
		
		return $this->genericoDAO->sqlDireto($sql, "SELECT");
	}
	
	function consultaListaInvestimento($idPessoa) {
		return $this->genericoDAO->select("tb_investimento","*","ID_PESSOA = ".$idPessoa);
	}
	
	public function cadastrarInvestimento($investimentoBO) {
		$campos = "   ID_TIPO_INVESTIMENTO
					, ID_PESSOA
					, ID_TIPO_RENDA
					, ID_TIPO_CATEGORIA
					, ID_INST_FINANCEIRA
					, NOME_INVESTIMENTO
					, DT_APLICACAO_INVESTIMENTO
					, VL_APLICACAO_INVESTIMENTO
					, TX_CONTRATADA_INVESTIMENTO
					, TX_CORRETAGEM_INVESTIMENTO
					, VL_SALDO_LIQUIDO_INVESTIMENTO";
		
		$parametros = $investimentoBO->getIdTipo()
		.",".$investimentoBO->getIdPessoa()
		.",".$investimentoBO->getIdTipoRenda()
		.",".$investimentoBO->getIdTipoCategoria()
		.",".$investimentoBO->getIdInstFinanceira()
		.",'".$investimentoBO->getNomeInvestimento()
		."','".$investimentoBO->getDataAplicacao()
		."',".$investimentoBO->getValorAplicacaoPadraoBD()
		.",".$investimentoBO->getTaxaContratadaPadraoBD()
		.",".$investimentoBO->getTaxaCorretagemPadraoBD()
		.",".$investimentoBO->getValorAplicacaoPadraoBD();
		
		if ($investimentoBO->getDataMinimaResgate()!=null && $investimentoBO->getDataMinimaResgate()!=""){
			$campos.=", DT_MINIMA_RESGATE_INVESTIMENTO";
			$parametros.=",'".$investimentoBO->getDataMinimaResgate()."'";
		}
		if ($investimentoBO->getDataVencimento()!=null && $investimentoBO->getDataVencimento()!="") {
			$campos.=", DT_VENCIMENTO_INVESTIMENTO";
			$parametros.=",'".$investimentoBO->getDataVencimento()."'";
		}
		return $this->genericoDAO->insert("tb_investimento", $campos, $parametros);
	}
	
	public function excluirInvestimento($id) {
		return $this->genericoDAO->delete("tb_investimento", "ID_INVESTIMENTO = ".$id);
	}
	
	public function consultarPorIdPersonalizado($id){
		$sql = "SELECT 
				i.ID_INVESTIMENTO,
				ti.NOME_TIPO_INVESTIMENTO,
				i.ID_PESSOA ,
				tr.NOME_TIPO_RENDA ,
				tc.NOME_TIPO_CATEGORIA ,
				ifi.NOME_INST_FINANCEIRA ,
				i.NOME_INVESTIMENTO ,
				i.DT_APLICACAO_INVESTIMENTO,
				i.DT_MINIMA_RESGATE_INVESTIMENTO ,
				i.DT_VENCIMENTO_INVESTIMENTO ,
				i.VL_APLICACAO_INVESTIMENTO,
				i.TX_CONTRATADA_INVESTIMENTO ,
				i.TX_CORRETAGEM_INVESTIMENTO,
				i.VL_SALDO_LIQUIDO_INVESTIMENTO 
				FROM 	u859943329_maf.tb_investimento i 
						,u859943329_maf.tb_tipo_investimento ti
				        ,u859943329_maf.tb_tipo_renda tr
				        ,u859943329_maf.tb_instituicao_financeira ifi
				        ,u859943329_maf.tb_tipo_categoria tc
				where i.ID_INVESTIMENTO = ".$id."
				and i.ID_TIPO_INVESTIMENTO = ti.ID_TIPO_INVESTIMENTO 
				and tr.ID_TIPO_RENDA = i.ID_TIPO_RENDA
				and ifi.ID_INST_FINANCEIRA = i.ID_INST_FINANCEIRA
				and tc.ID_TIPO_CATEGORIA = i.ID_TIPO_CATEGORIA";
		
		$result = $this->genericoDAO->sqlDireto($sql, "SELECT");
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	public function consultarPorId ($id) {
		$resultado = $this->genericoDAO->select("tb_investimento","*","ID_INVESTIMENTO = ".$id);
		return mysqli_fetch_array($resultado,MYSQLI_ASSOC);
	}
	
	public function alterarInvestimento($investimentoBO) {
		
		$campos = "ID_TIPO_INVESTIMENTO = ".$investimentoBO->getIdTipo()
					.", ID_PESSOA =".$investimentoBO->getIdPessoa()
					.", ID_TIPO_RENDA = ".$investimentoBO->getIdTipoRenda()
					.", ID_TIPO_CATEGORIA = ".$investimentoBO->getIdTipoCategoria()
					.", ID_INST_FINANCEIRA = ".$investimentoBO->getIdInstFinanceira()
					.", NOME_INVESTIMENTO = '".$investimentoBO->getNomeInvestimento()."'"
					.", DT_APLICACAO_INVESTIMENTO = '".$investimentoBO->getDataAplicacao()."'"
					.", VL_APLICACAO_INVESTIMENTO = ".$investimentoBO->getValorAplicacaoPadraoBD()
					.", TX_CONTRATADA_INVESTIMENTO = ".$investimentoBO->getTaxaContratadaPadraoBD()
					.", TX_CORRETAGEM_INVESTIMENTO = ".$investimentoBO->getTaxaCorretagemPadraoBD()
					.", VL_SALDO_LIQUIDO_INVESTIMENTO = ".$investimentoBO->getValorAplicacaoPadraoBD();
		if ($investimentoBO->getDataMinimaResgate()!=null && $investimentoBO->getDataMinimaResgate()!=""){
			$campos.=", DT_MINIMA_RESGATE_INVESTIMENTO = '".$investimentoBO->getDataMinimaResgate()."'";
		}
		if ($investimentoBO->getDataVencimento()!=null && $investimentoBO->getDataVencimento()!="") {
			$campos.=", DT_VENCIMENTO_INVESTIMENTO = '".$investimentoBO->getDataVencimento()."'";
		}
		
		$parametros = "ID_INVESTIMENTO = ".$investimentoBO->getId();
		
		return $this->genericoDAO->update("tb_investimento", $campos, $parametros);
	}
	
	public function alterarValorSaldoLiquido($id,$valor) {
		$this->genericoDAO = new genericoDAO();
		return $this->genericoDAO->update("tb_investimento", 
											"VL_SALDO_LIQUIDO_INVESTIMENTO = ".$valor,
											"ID_INVESTIMENTO = ".$id);
	}
	
	public function consultaSaldoLiquidoPorTipoInvestimento($idPessoa) {
		
		$sql = "
			Select 
				sum(invest.VL_SALDO_LIQUIDO_INVESTIMENTO) as SOMA_SALDO_LIQUIDO
				, invest.ID_TIPO_INVESTIMENTO 
			    , tipoInvest.NOME_TIPO_INVESTIMENTO
			from u859943329_maf.tb_investimento as invest, u859943329_maf.tb_tipo_investimento as tipoInvest
			where 	invest.ID_PESSOA = ".$idPessoa." and
					invest.ID_TIPO_INVESTIMENTO = tipoInvest.ID_TIPO_INVESTIMENTO
			group by invest.ID_TIPO_INVESTIMENTO";
		
		return $this->genericoDAO->sqlDireto($sql, "select");
	}
	
	public function consultaSaldoLiquidoPorInstituicao($idPessoa) {
		
		$sql = "
			Select 
				sum(invest.VL_SALDO_LIQUIDO_INVESTIMENTO) as SOMA_SALDO_LIQUIDO
			    , instituicao.NOME_INST_FINANCEIRA
			from u859943329_maf.tb_investimento as invest, u859943329_maf.tb_instituicao_financeira as instituicao
			where 	invest.ID_PESSOA = ".$idPessoa." and
					invest.ID_INST_FINANCEIRA = instituicao.ID_INST_FINANCEIRA
			group by invest.ID_INST_FINANCEIRA";
		return $this->genericoDAO->sqlDireto($sql, "select");
	}
	public function consultaCapitalSaldoLiquidoPorPessoa($idPessoa) {
		
		$sql = "
			select NOME_INVESTIMENTO,VL_APLICACAO_INVESTIMENTO,VL_SALDO_LIQUIDO_INVESTIMENTO
			from u859943329_maf.tb_investimento
			where ID_PESSOA = ".$idPessoa;
		return $this->genericoDAO->sqlDireto($sql, "select");
	}
}

?>