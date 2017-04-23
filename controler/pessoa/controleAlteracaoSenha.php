<?php 

session_start();

require_once '../../bo/pessoaBO.class.php';
require_once '../../model/pessoaDAO.class.php';

$pessoaBO 	= new PessoaBO();
$pessoaDAO 	= new PessoaDAO();

$pessoaBO->setId($_SESSION['ID_PESSOA']);
$pessoaBO->setSenha(md5($_POST['senha']));
$confirmaSenha = md5($_POST['confirmSenha']);

//verifica confirmação de senha
if (!$pessoaBO->isSenhaValida($confirmaSenha)){
	$senha_confirmada = true;
	$retorno_get .= "erro_senha=1&";
	header('Location: ../../visao/pessoa/alteraUsuario.php?'.$retorno_get);
	die(); //interrompe a execução do script
} else {
	if ($pessoaDAO->alterarSenha($pessoaBO)){
		header('Location: ../../visao/pessoa/alteraUsuario.php?msgAlterarSenha=1');
		die(); //interrompe a execução do script
	}
}

?>