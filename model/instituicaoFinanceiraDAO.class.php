<?php

require_once 'genericoDao.class.php';

class InstituicaoFinanceiraDAO {
	
	private $genericoDAO;
	
	function __construct(){
		$this->genericoDAO = new genericoDAO();
	}
	
	function consultaInstituicaoFinanceira($idPessoa) {
		return $this->genericoDAO->select("tb_instituicao_financeira","*","ID_PESSOA = $idPessoa");
	}
}

?>