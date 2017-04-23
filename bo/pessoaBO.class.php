<?php

// ========================== REGRAS DE NEGÓCIO ============================

class PessoaBO {
	
	// Atributos
	private $id;
	private $cpf;
	private $nome;
	private $email;
	private $dtnascimento;
	private $senha;
	
	// Métodos
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	public function setCpf($cpf) {
		$this->cpf = $cpf;
	}
	public function getCpf() {
		return $this->cpf;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setDtNascimento($dtnascimento) {
		$this->dtnascimento = $dtnascimento;
	}
	public function getDtNascimento() {
		return $this->dtnascimento;
	}
	public function setSenha($senha) {
		$this->senha = $senha;
	}
	public function getSenha() {
		return $this->senha;
	}
	
	public function getCPFsemMascara(){
		$verificar = array(".", "-");
		$substituir   = array("", "");
		return str_replace($verificar, $substituir, $this->cpf);
	}
	
	public function getCPFcomMascara($cpf){
		return substr($cpf, 0,3).".".substr($cpf, 3,3).".".substr($cpf, 6,3)."-".substr($cpf, 9,2);
	}
	
	public function isSenhaValida($confirmaSenha){
		return $confirmaSenha == $this->senha;
	}
}

?>