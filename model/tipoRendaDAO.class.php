<?php

require_once 'genericoDao.class.php';

class TipoRendaDAO {
	
	private $genericoDAO;
	
	function __construct(){
		$this->genericoDAO = new genericoDAO();
	}
	
	function consultaListaTipoRenda() {
		return $this->genericoDAO->select("tb_tipo_renda","*",null);
	}
	
	public function consultaPorId($id) {
		return $this->genericoDAO->select("tb_tipo_renda","*","ID_TIPO_RENDA = ".$id);
	}
}

?>