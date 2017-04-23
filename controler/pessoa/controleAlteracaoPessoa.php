<?php 

session_start();

require_once '../../bo/pessoaBO.class.php';
require_once '../../model/pessoaDAO.class.php';

$pessoaBO 	= new PessoaBO();
$pessoaDAO 	= new PessoaDAO();

$pessoaBO->setCpf			($_POST['cpf']);
$pessoaBO->setNome			($_POST['nome']);
$pessoaBO->setEmail			($_POST['email']);
$pessoaBO->setDtNascimento	($_POST['dtNascimento']);

$email_existe_outro = false;

//Buscar ID_PESSOA

// $id = $pessoaDAO->consultarIdPessoa($pessoaBO->getEmail());
$pessoaBO->setId($_SESSION['ID_PESSOA']);

// $pessoaBO->setSenha		(md5($_POST['senha']));
// $confirmaSenha = md5($_POST['confirmSenha']);

//verificar se o e-mail já existe, exceto o dele mesmo
if ($pessoaDAO->EmailExisteOutro($pessoaBO->getEmail(),$_SESSION['ID_PESSOA'])){
	$email_existe_outro = true;
	$retorno_get .= "erro_email_outro=1&";
	header('Location: ../../visao/pessoa/alteraUsuario.php?'.$retorno_get);
	die();
} else {
	$pessoaDAO->alterarPessoa($pessoaBO);
}

?>