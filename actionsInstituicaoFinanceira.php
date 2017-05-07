<?php
require_once('model/db.class.php');

$con = new db();

session_start();
$ID_PESSOA = $_SESSION['ID_PESSOA'];

try
{
	//Open database connection
	$con = mysql_connect("localhost","root","admin");
	mysql_select_db("maf", $con);

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM tb_instituicao_financeira where ID_PESSOA = ".$ID_PESSOA.";");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];

		//Get records from database
		$result = mysql_query("SELECT * FROM tb_instituicao_financeira where ID_PESSOA = ".$ID_PESSOA." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
	/* else if($_GET["action"] == "create")
	{
		//Insert record into database
		$sql = (
			"INSERT INTO tb_instituicao_financeira
				(ID_PESSOA, 
				NOME_INST_FINANCEIRA, 
				CNPJ_INST_FINANCEIRA, 
				COD_INST_FINANCEIRA, 
				AGENCIA_INST_FINANCEIRA, 
				CONTA_INST_FINANCEIRA, 
				TXMANUT_INST_FINANCEIRA, 
				COD_VERIF_AGEN_INST_FINANCEIRA, 
				COD_VERIF_CONTA_INST_FINANCEIRA)
 			 VALUES($ID_PESSOA,
				" . $_POST["NOME_INST_FINANCEIRA"] . "', 
				" . $_POST["CNPJ_INST_FINANCEIRA"]  . ",
				0 ,
				" . $_POST["AGENCIA_INST_FINANCEIRA"]  . ",
				" . $_POST["CONTA_INST_FINANCEIRA"]  . ",
				 0 ,
				 0 ,
				 0 
				);"
		);
		echo $sql;
		die();
		$result = mysql_query($sql);
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM tb_instituicao_financeira WHERE ID_INST_FINANCEIRA = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);
		
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	} */
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = mysql_query("UPDATE people SET Name = '" . $_POST["Name"] . "', Age = " . $_POST["Age"] . " WHERE PersonId = " . $_POST["PersonId"] . ";");
		
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM tb_instituicao_financeira WHERE ID_INST_FINANCEIRA = " . $_POST["ID_INST_FINANCEIRA"] . ";");
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	mysql_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>