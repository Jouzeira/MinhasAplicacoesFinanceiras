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
		$campos = "ID_TIPO_INVESTIMENTO, ID_PESSOA, ID_TIPO_RENDA, ID_TIPO_CATEGORIA, ID_INST_FINANCEIRA, NOME_INVESTIMENTO, DT_APLICACAO_INVESTIMENTO, VL_APLICACAO_INVESTIMENTO, TX_CONTRATADA_INVESTIMENTO, TX_CORRETAGEM_INVESTIMENTO";
		$parametros = $investimentoBO->getIdTipo().",".$investimentoBO->getIdPessoa().",".$investimentoBO->getIdTipoRenda().",".$investimentoBO->getIdTipoCategoria().",".$investimentoBO->getIdInstFinanceira().",'".$investimentoBO->getNomeInvestimento()."','".$investimentoBO->getDataAplicacao()."',".$investimentoBO->getValorAplicacaoPadraoBD().",".$investimentoBO->getTaxaContratadaPadraoBD().",".$investimentoBO->getTaxaCorretagemPadraoBD();
		
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
}

?>