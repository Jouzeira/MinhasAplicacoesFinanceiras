<?php

class HistoricoInvestimentoBO {
	
	private $id;
	private $idInvestimento;
	private $dtAtualizacao;
	private $valorBruto;
	private $valorLiquido;
	
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	
	public function setIdInvestimento($idInvestimento) {
		$this->idInvestimento = $idInvestimento;
	}
	public function getIdInvestimento() {
		return $this->idInvestimento;
	}
	
	public function setDtAtualizacao($dtAtualizacao) {
		$this->dtAtualizacao = $dtAtualizacao;
	}
	public function getDtAtualizacao() {
		return $this->dtAtualizacao;
	}
	
	public function setValorBruto($valorBruto) {
		$this->valorBruto = $valorBruto;
	}
	public function getValorBruto() {
		return $this->valorBruto;
	}
	
	public function setValorLiquido($valorLiquido) {
		$this->valorLiquido = $valorLiquido;
	}
	public function getValorLiquido() {
		return $this->valorLiquido;
	}
	
	public function getValorLiquidoPadraoBD() {
		$verificar = array(",");
		$substituir   = array(".");
		return str_replace($verificar, $substituir, $this->valorLiquido);
	}
	public function getValorLiquidoPadraoTela() {
		$verificar = array(".");
		$substituir   = array(",");
		return str_replace($verificar, $substituir, $this->valorLiquido);
	}
	public function getValorLiquidoFormatado() {
		return "R$ ".$this->getValorLiquidoPadraoTela();
	}
	public function getDtAtualizacaoFormatado(){
		return substr($this->dtAtualizacao, 8,2)."/".substr($this->dtAtualizacao, 5,2)."/".substr($this->dtAtualizacao, 0,4);
	}
}

?>