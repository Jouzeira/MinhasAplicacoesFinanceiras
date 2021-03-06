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
	
	public function consultarIdPessoa($email){
		$this->genericoDAO = new genericoDAO();
		$resultadoIdPessoa = $this->genericoDAO->select('tb_pessoa','ID_PESSOA', "EMAIL_PESSOA = '".$email."'");
		return mysqli_fetch_array($resultadoIdPessoa, MYSQLI_ASSOC);
	}

	public function inserirPessoa($pessoaBO){
		$this->genericoDAO = new genericoDAO();
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
	
	public function Emailexiste($emailConsulta){
		$this->genericoDAO = new genericoDAO();
		$resultadoEmailExiste = $this->genericoDAO->select	(
				'tb_pessoa',
				'EMAIL_PESSOA',
				"EMAIL_PESSOA = '".$emailConsulta."'"
				);
		return mysqli_fetch_array($resultadoEmailExiste,MYSQLI_ASSOC);
	}
	
	public function EmailExisteOutro($email,$id){
		$this->genericoDAO = new genericoDAO();
		$resultadoEmailExisteOutro = $this->genericoDAO->select	(
				'tb_pessoa',
				'EMAIL_PESSOA',
				"EMAIL_PESSOA = '".$email."' AND EMAIL_PESSOA <> (SELECT EMAIL_PESSOA FROM tb_pessoa WHERE ID_PESSOA = ".$id.")" 
				);
		return mysqli_fetch_array($resultadoEmailExisteOutro,MYSQLI_ASSOC);
	}
	
	public function alterarPessoa($pessoaBO){
		$this->genericoDAO = new genericoDAO();
		return $this->genericoDAO->update(
			'tb_pessoa', 
			"CPF_PESSOA = '".$pessoaBO->getCPFsemMascara().
			"', NOME_PESSOA = '".$pessoaBO->getNome().
			"', EMAIL_PESSOA = '".$pessoaBO->getEmail().
			"', DT_NAS_PESSOA = '".$pessoaBO->getDtNascimento()."'"
			,"ID_PESSOA = ".$pessoaBO->getId()
			);
	}
	
	public function alterarSenha($pessoaBO){
		return $this->genericoDAO->update('tb_pessoa', "SENHA = '".$pessoaBO->getSenha()."'", "ID_PESSOA = ".$pessoaBO->getId());
	}

} // ========== / Class PessoaDAO ============

?>