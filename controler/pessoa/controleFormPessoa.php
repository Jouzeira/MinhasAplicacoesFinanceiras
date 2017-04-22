<?php 

require_once '../../model/pessoaDAO.class.php';
require_once '../../bo/pessoaBO.class.php';

$pessoaDAO 	= new PessoaDAO();
$pessoaBO 	= new PessoaBO();

$pessoaBO->setCpf			($_POST['cpf']);
$pessoaBO->setNome			($_POST['nome']);
$pessoaBO->setEmail			($_POST['email']);
$pessoaBO->setDtNascimento	($_POST['dtNascimento']);
$pessoaBO->setSenha		(md5($_POST['senha']));

$confirmaSenha = md5($_POST['confirmSenha']);

//verifica confirmação de senha
if (!$pessoaBO->isSenhaValida($confirmaSenha)){
	header('Location: ../../inscrevase.php?'."erro_senha=1&");
	die(); //interrompe a execução do script
}

//verificar se o CPF já existe
if ($pessoaDAO->CPFexiste($pessoaBO->getCPFsemMascara())){
	header('Location: ../../inscrevase.php?'."erro_cpf=1&");
	die(); //interrompe a execução do script
}

//Inserir dados da pessoa no banco	
$inserirDadosPessoa = $pessoaDAO->inserirPessoa($pessoaBO);

?>