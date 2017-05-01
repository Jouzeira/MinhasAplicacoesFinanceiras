<?php
require_once('db.class.php');
// include_once("usuariosVO.php");
class genericoDAO extends db{
// 	public function __construct(){}
// 	private function __clone(){}
	
// 	public function __destruct() {
// 		foreach ($this as $key => $value) {
// 			unset($this->$key);
// 		}
// 		foreach(array_keys(get_defined_vars()) as $var) {
// 			unset(${"$var"});
// 		}
// 		unset($var);
// 	}
	
	public function select($tabela,$fields="*",$where=""){
		
		if(strlen($where)>0) $where= " where ".$where;
		$sql = "SELECT $fields FROM $tabela$where";
		return $this->resultado ( $this->getlink(), $sql,"select" );
		
	}
	
	public function insert($tabela,$fields,$params){
		
		$sql = "INSERT INTO $tabela ($fields) VALUES ($params)";
		return $this->resultado ( $this->getlink(), $sql,"insert" );
	}
	
	public function update($tabela,$fields,$where=null){
		
		$sql = "UPDATE $tabela SET $fields";
		if(isset($where)) $sql .= " WHERE $where";
		return $this->resultado ( $this->getlink(), $sql,"update" );
	}
	
	public function delete($tabela,$where=null){
		
		$sql = "DELETE FROM $tabela";
		if(isset($where)) $sql .= " WHERE $where";
		return $this->resultado ( $this->getlink(), $sql,"delete" );
	}
	
	public function sqlDireto($sql,$tipoQuery) {
		return $this->resultado ( $this->getlink(), $sql, $tipoQuery);
	}
	
	private function resultado($link, $sql,$tipoQuery) {
		if($resultado_id = mysqli_query($link, $sql)){
			return $resultado_id;
		}else {
			
			echo 'Erro ao executar o '.$tipoQuery.':<br/>'.$sql.'<br/>'.mysqli_error($link);;
			die();
		}
	}
}
?>


