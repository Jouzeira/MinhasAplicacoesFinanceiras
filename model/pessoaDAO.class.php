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

	public function inserirPessoa($pessoaBO){
		$this->genericoDAO->insert	(	
									'tb_pessoa', 
									'CPF_PESSOA, NOME_PESSOA, EMAIL_PESSOA, DT_NAS_PESSOA, SENHA', 
									 "'".$pessoaBO->getCPFsemMascara()."',
									 '".$pessoaBO->getNome()."',
									 '".$pessoaBO->getEmail()."',
									 '".$pessoaBO->getDtNascimento()."',
									 '".$pessoaBO->getSenha()."'"
									);
	}
	
	public function CPFexiste($cpfConsulta){
		$resultadoCpfExiste = $this->genericoDAO->select	(	
										'tb_pessoa',
									   	'CPF_PESSOA',
										"CPF_PESSOA = '".$cpfConsulta."'"	
									  	);
		return mysqli_fetch_array($resultadoCpfExiste,MYSQLI_ASSOC);
	}

} // ========== / Class PessoaDAO ============

?>