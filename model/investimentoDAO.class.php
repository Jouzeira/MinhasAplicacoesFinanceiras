<?php

require_once 'genericoDao.class.php';

class InvestimentoDAO {
	
	private $genericoDAO;
	
	function __construct(){
		$this->genericoDAO = new genericoDAO();
	}
	
	function consultaListaInvestimento($idPessoa) {
		return $this->genericoDAO->select("tb_investimento","*","ID_PESSOA = ".$idPessoa);
	}
	
	public function cadastrarInvestimento($investimentoBO) {
		$campos = "ID_TIPO_INVESTIMENTO
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
					.", VL_SALDO_LIQUIDO_INVESTIMENTO = ".$investimentoBO->getValorSaldoLiquidoPadraoBD();
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
			from maf.tb_investimento as invest, maf.tb_tipo_investimento as tipoInvest
			where 	invest.ID_PESSOA = ".$idPessoa." and
					invest.ID_TIPO_INVESTIMENTO = tipoInvest.ID_TIPO_INVESTIMENTO
			group by invest.ID_TIPO_INVESTIMENTO";
		
		return $this->genericoDAO->sqlDireto($sql, "select");
	}
}

?>