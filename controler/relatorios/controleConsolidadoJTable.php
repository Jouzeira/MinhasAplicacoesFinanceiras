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
			
		$jtSorting 			= $_GET["jtSorting"];
		$jtStartIndex 		= $_GET["jtStartIndex"];
		$jtPageSize 		= $_GET["jtPageSize"];
		
		$nomeInvestimento	= $_POST["nomeInvestimento"];
 		$anoMes				= $_POST["anoMes"];
		
		$queryGeral = "SELECT
							I.NOME_INVESTIMENTO,
							RM.ID_INVESTIMENTO, 
					        concat(right(RM.ANO_MES,2),'/',left(RM.ANO_MES,4)) AS ANO_MES, 
						    concat('R$ ', format(I.VL_APLICACAO_INVESTIMENTO,2,'de_DE')) AS VL_APLICACAO_INVESTIMENTO,
						    concat('R$ ', format(I.VL_SALDO_LIQUIDO_INVESTIMENTO,2,'de_DE')) AS VL_SALDO_LIQUIDO_INVESTIMENTO,
						    concat('R$ ', format(RM.VL_RENDIMENTO_MENSAL,2,'de_DE')) AS VL_RENDIMENTO_MENSAL,
						    concat('R$ ', format(RM.VL_SALDO_LIQUIDO_MENSAL,2,'de_DE')) AS VL_SALDO_LIQUIDO_MENSAL,
						    concat(CAST(RM.VL_PERCENT_RENTABILIDADE_MENSAL AS DECIMAL(10,2)), '%') AS VL_PERCENT_RENTABILIDADE_MENSAL
						FROM u859943329_maf.tb_rentabilidade_mensal AS RM
						JOIN u859943329_maf.tb_investimento AS I
							ON RM.ID_INVESTIMENTO = I.ID_INVESTIMENTO
						WHERE RM.ID_INVESTIMENTO in ( SELECT I.ID_INVESTIMENTO FROM u859943329_maf.tb_investimento AS I	WHERE I.ID_PESSOA = ".$_SESSION['ID_PESSOA']." )";
		
		if (!is_null($nomeInvestimento) && $nomeInvestimento!= ""){
			$queryGeral.= " AND I.NOME_INVESTIMENTO LIKE '%" .$nomeInvestimento."%'";
		}
		
		if (!is_null($anoMes) && $anoMes!= ""){
			$queryGeral.= " AND RM.ANO_MES = " .$anoMes;
		}
		
		$queryCount = "	SELECT COUNT(ID_INVESTIMENTO) AS RecordCount
							   	FROM (".$queryGeral.") AS TB";
		
		$queryFilter = $queryGeral;
		$queryFilter .= " ORDER BY $jtSorting LIMIT $jtStartIndex , $jtPageSize ;";
		
		$result = mysqli_query($con, $queryCount);
		$row = mysqli_fetch_array($result);
		$recordCount = $row['RecordCount'];
		
		//Get records from database
		$result = mysqli_query($con, $queryFilter);
		
		//Add all records to an array
		$rows = array();
		while($row = mysqli_fetch_array($result))
		{
			$rows[] = $row;
		}
		//
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}

	//Close database connection
	mysqli_close($con);
} // ============== /try ==================
catch(Exception $ex)
{
	//Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
?>