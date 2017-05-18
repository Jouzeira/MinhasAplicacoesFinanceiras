<?php

class db {

	//host
	private $host = 'mysql.hostinger.com.br';
// 	private $host = 'localhost';
// 	private $host = '192.168.0.100';

	//usuario
	private $usuario = 'u859943329_root';

	//senha
	private $senha = 'admin10';

	//banco de dados
	private $database = 'u859943329_maf';
	
	private $link;
	
	public function __construct(){
		
		//criar a conexão
		// A função mysqli_connect espera 4 parâmetros: localização do banco de dados, usuario de acesso, senha e o banco de dados
		$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);
		
		//ajustar o charset de comunicação entre o charset e o banco de dados , recebe dois parametros: os dados da conexão e qual é o charset
		mysqli_set_charset($con, 'utf8');
		
		//verificar se houve erro de conexão
		if(mysqli_connect_errno()){
			echo 'Erro ao tentar se conectar com o banco de dados MySQL '.mysqli_connect_error();
		}
		
		$this->link = $con;
		
	}
	
	public function getlink(){
		return $this->link;
	}

	public function conecta_mysql(){

		//criar a conexão
		// A função mysqli_connect espera 4 parâmetros: localização do banco de dados, usuario de acesso, senha e o banco de dados
		$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

		//ajustar o charset de comunicação entre o charset e o banco de dados , recebe dois parametros: os dados da conexão e qual é o charset
		mysqli_set_charset($con, 'utf8');

		//verificar se houve erro de conexão
		if(mysqli_connect_errno()){
			echo 'Erro ao tentar se conectar com o banco de dados MySQL '.mysqli_connect_error();
		}

		return $con;
	}

}

?>