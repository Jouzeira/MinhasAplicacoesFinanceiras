<?php 

require_once '../../model/rentabilidadeMensalDAO.class.php';

$rentabilidadeMensalDAO = new RentabilidadeMensalDAO();

$resultListaAnoMes = $rentabilidadeMensalDAO->consultaListaAnoMes($_SESSION['ID_PESSOA']);

$listaAnoMes = array();
while ($linha = mysqli_fetch_array($resultListaAnoMes)) {
	$listaAnoMes[] = $linha['ANO_MES']; 
}

?>