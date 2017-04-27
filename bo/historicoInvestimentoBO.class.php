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
}

?>