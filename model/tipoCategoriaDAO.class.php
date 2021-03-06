<?php

require_once 'genericoDao.class.php';

class TipoCategoriaDAO {
	
	private $genericoDAO;
	
	function __construct(){
		$this->genericoDAO = new genericoDAO();
	}
	
	function consultaListaTipoCategoria() {
		return $this->genericoDAO->select("tb_tipo_categoria","*",null);
	}
	
	public function consultaPorId($id) {
		return $this->genericoDAO->select("tb_tipo_categoria","*","ID_TIPO_CATEGORIA = ".$id);
	}
}

?>