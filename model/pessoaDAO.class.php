<?php 

require_once 'genericoDao.class.php';

class PessoaDAO {
	private $genericoDAO;
	
	function __construct(){
		$this->genericoDAO = new genericoDAO();
	}
	
	public function consultarPessoa($id){
		
		$resultado = $this->genericoDAO->select('tb_pessoa','*', 'id_pessoa = '.$id);

		return mysqli_fetch_array($resultado,MYSQLI_ASSOC);
	}
	
}

?>