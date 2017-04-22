<?php

class InstituicaoFinanceiraBO {
	
	private $id;
	private $idPessoa;
	private $nome;
	private $cnpj;
	private $codigo;
	private $agencia;
	private $conta;
	private $taxaManutencao;
	private $codVerifAgencia;
	private $codVerifConta;
	
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	
	public function setIdPessoa($idPessoa) {
		$this->idPessoa;
	}
	public function getIdPessoa() {
		return $this->idPessoa;
	}
	
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	
	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
	}
	public function getCnpj() {
		return $this->cnpj;
	}
	
	public function setCodigo($codigo) {
		$this->codigo = $codigo;
	}
	public function getCodigo() {
		return $this->codigo;
	}
	
	public function setAgencia($agencia) {
		$this->agencia = $agencia;
	}
	public function getAgencia() {
		return $this->agencia;
	}
	
	public function setConta($conta) {
		$this->conta = $conta;
	}
	public function getConta() {
		return $this->conta;
	}
	
	public function setTaxaManutencao($taxaManutencao) {
		$this->taxaManutencao = $taxaManutencao;
	}
	public function getTaxaManutencao() {
		return $this->taxaManutencao;
	}
	
	public function setCodVerifAgencia($codVerifAgencia) {
		$this->codVerifAgencia = $codVerifAgencia;
	}
	public function getCodVerifAgencia() {
		return $this->codVerifAgencia;
	}
	
	public function setCodVerifConta($codVerifConta) {
		$this->codVerifConta = $codVerifConta;
	}
	public function getCodVerifConta() {
		return $this->codVerifConta;
	}
}

?>