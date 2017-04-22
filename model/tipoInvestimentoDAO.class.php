<?php

require_once 'genericoDao.class.php';

	class TipoInvestimentoDAO {
		
		private $genericoDAO;
		
		function __construct(){
			$this->genericoDAO = new genericoDAO();
		}
		
		function consultaListaTipoInvestimento() {
			return $this->genericoDAO->select("tb_tipo_investimento","*",null);
		}
	}

?>