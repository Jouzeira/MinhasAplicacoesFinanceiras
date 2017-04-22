<?php

class TipoCategoriaBO {
	
	private $id;
	private $nomeTipoCategoria;
	
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	
	public function setNomeTipoCategoria($nomeTipoCategoria) {
		$this->nomeTipoCategoria = $nomeTipoCategoria;
	}
	public function getNomeTipoCategoria() {
		return $this->nomeTipoCategoria;
	}
}

?>