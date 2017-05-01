<?php

class HistoricoInvestimentoBO {
	
	private $id;
	private $idInvestimento;
	private $dtAtualizacao;
	private $valorBruto;
	private $valorLiquido;
	private $valorRendimentoDiario;
	
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
	
	public function setValorRendimentoDiario($valorRendimentoDiario){
		$this->valorRendimentoDiario = $valorRendimentoDiario;
	}
	public function getValorRendimentoDiario() {
		return $this->valorRendimentoDiario;
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
	
	public function getValorRendimentoDiarioPadraoTela() {
		$verificar = array(".");
		$substituir   = array(",");
		return str_replace($verificar, $substituir, $this->valorRendimentoDiario);
	}
	public function getValorRendimentoDiarioFormatado() {
		return "R$ ".$this->getValorRendimentoDiarioPadraoTela();
	}
}

?>