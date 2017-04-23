<?php 

session_start();

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

$senha_confirmada 	= false;
$cpf_existe 		= false;
$email_existe 		= false;

//verifica confirmação de senha
if (!$pessoaBO->isSenhaValida($confirmaSenha)){
	$senha_confirmada = true;
	$retorno_get .= "erro_senha=1&";
}

//verificar se o CPF já existe
if ($pessoaDAO->CPFexiste($pessoaBO->getCPFsemMascara())){
	$cpf_existe = true;
	$retorno_get .= "erro_cpf=1&";
}

//verificar se o e-mail já existe
if ($pessoaDAO->Emailexiste($pessoaBO->getEmail())){
	$email_existe = true;
	$retorno_get .= "erro_email=1&";
}

if($senha_confirmada || $cpf_existe || $email_existe){
	$retorno_get.= 'cpf='.$pessoaBO->getCpf();
	$retorno_get.= '&nome='.$pessoaBO->getNome();
	$retorno_get.= '&email='.$pessoaBO->getEmail();
	$retorno_get.= '&dtNascimento='.$pessoaBO->getDtNascimento();
	header('Location: ../../inscrevase.php?'.$retorno_get);
	die(); //interrompe a execução do script
} else {
	//Inserir dados da pessoa no banco	
	$inserirDadosPessoa = $pessoaDAO->inserirPessoa($pessoaBO);
	
	$novoId = $pessoaDAO->consultarIdPessoa($pessoaBO->getEmail());
	$posicao = strpos($pessoaBO->getNome(), ' ');
	
	$_SESSION['NOME_PESSOA'] 	= ($posicao==null||$posicao==0||$posicao=="") ? ($pessoaBO->getNome()) : (substr($pessoaBO->getNome(), 0, $posicao));
	$_SESSION['EMAIL_PESSOA'] 	= $pessoaBO->getEmail();
	$_SESSION['ID_PESSOA'] 		= $novoId['ID_PESSOA'];
	
	header('Location: ../../home.php');
}
?>