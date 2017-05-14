<?php 

session_start();
require_once '../../model/db.class.php';

try
{
	$conexao = new db();
	$con = $conexao->getlink();
	
	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
			
		$jtSorting = $_GET["jtSorting"];
		$jtStartIndex = $_GET["jtStartIndex"];
		$jtPageSize = $_GET["jtPageSize"];
		
		$queryGeral = "SELECT
							ID_INVESTIMENTO,
							ANO_MES,
							VL_RENDIMENTO_MENSAL
						FROM maf.tb_rentabilidade_mensal
						where ID_INVESTIMENTO in ( SELECT	I.ID_INVESTIMENTO FROM MAF.tb_investimento AS I	WHERE I.ID_PESSOA = ".$_SESSION['ID_PESSOA']." )";
		// echo $queryGeral;
		// echo "<br>";
		
		$queryCount = "	SELECT COUNT(ID_INVESTIMENTO) AS RecordCount
							   	FROM (".$queryGeral.") AS TB";
		
		//echo $queryCount;
		
		$queryFilter = $queryGeral;
		$queryFilter .= " ORDER BY $jtSorting LIMIT $jtStartIndex , $jtPageSize ;";
		
		//$result = $rentabilidadeMensalDAO->consultarRentabilidadeJTable($queryCount);
		$result = mysqli_query($con, $queryCount);
		$row = mysqli_fetch_array($result);
		$recordCount = $row['RecordCount'];
		
		//		//Get records from database
		// $result = $rentabilidadeMensalDAO->consultarRentabilidadeJTable($queryFilter);
		$result = mysqli_query($con, $queryFilter);
		
		//Add all records to an array
		$rows = array();
		while($row = mysqli_fetch_array($result))
		{
			$rows[] = $row;
		}
		//
		//		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
} // ============== /try ==================
catch(Exception $ex)
{
	//echo "Teste";
	// 	echo("<script>console.log('PHP: ".$origem."');</script>");
	//Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
?>