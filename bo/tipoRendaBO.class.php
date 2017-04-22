<?php

class TipoRendaBO {
	
	private $id;
	private $nomeTipoRenda;
	
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	
	public function setNomeTipoRenda($nomeTipoRenda) {
		$this->nomeTipoRenda = $nomeTipoRenda;
	}
	public function getNomeTipoRenda() {
		return $this->nomeTipoRenda;
	}
}

?>