<?php

	session_start();

	// a fun��o unset elimina indices da super global SESSION
	unset($_SESSION['NOME_PESSOA']);
	unset($_SESSION['EMAIL_PESSOA']);
	unset($_SESSION['ID_PESSOA']);
	
	header('Location: ../index.php');
	
?>