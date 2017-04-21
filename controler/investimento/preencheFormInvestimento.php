<?php

require_once '../../model/genericoDao.class.php';
require_once '../../bo/tipoInvestimentoBO.class.php';

$genericoDao = new genericoDAO();
$resultado = $genericoDao->select("tb_tipo_investimento","*",null);

$listTipoInvestimento = array();
while ($linha = mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
	$tipoInvestimento = new tipoInvestimento();
	$tipoInvestimento->setId($linha['ID_TIPO_INVESTIMENTO']);
	$tipoInvestimento->setNomeTipoInvestimento($linha['NOME_TIPO_INVESTIMENTO']);
	$tipoInvestimento->setIdTipoRenda($linha['ID_TIPO_RENDA']);
	$listTipoInvestimento[] = $tipoInvestimento;
}

foreach ($listTipoInvestimento as $tipo) {
	echo "<br/>".$tipo->getNomeTipoInvestimento();
}

?>