<?php

	class RelHistoricoInvestimentoBO {
		
		private $idInvestimento;
		private $data;
		private $valor;
		private $nome;
		
		function setIdInvestimento($idInvestimento) {
			$this->idInvestimento = $idInvestimento;
		}
		function getIdInvestimento() {
			return $this->idInvestimento;
		}
		
		function setData($data) {
			$this->data = $data;
		}
		function getData() {
			return $this->data;
		}
		
		function setValor($valor) {
			$this->valor = $valor;
		}
		function getValor() {
			return $this->valor;
		}
		
		function setNome($Nome) {
			$this->nome = $Nome;
		}
		function getNome() {
			return $this->nome;
		}
	}

?>