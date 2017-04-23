<?php 

session_start();

require_once '../../model/pessoaDAO.class.php';
require_once '../../bo/pessoaBO.class.php';

$pessoaDAO = new PessoaDAO();

// echo 'ID_PESSOA: '.$_SESSION['ID_PESSOA'];
// die();

$resultado = $pessoaDAO->consultarPessoa($_SESSION['ID_PESSOA']);

$pessoaBO = new PessoaBO();

$pessoaBO->setId($resultado['ID_PESSOA']);
$pessoaBO->setCpf($resultado['CPF_PESSOA']);
$pessoaBO->setNome($resultado['NOME_PESSOA']);
$pessoaBO->setEmail($resultado['EMAIL_PESSOA']);
$pessoaBO->setDtNascimento($resultado['DT_NAS_PESSOA']);
 
// echo '<br>'.$pessoaBO->getId();
// echo '<br>'.$pessoaBO->getCpf();
// echo '<br>'.$pessoaBO->getNome();
// echo '<br>'.$pessoaBO->getEmail();
// echo '<br>'.$pessoaBO->getDtNascimento();

?>