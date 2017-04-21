<?php 

	class tipoInvestimentoBO {
		
		private $id;
		private $nomeTipoInvestimento;
		private $idTipoRenda;
		
		public function setId ($id){
			$this->id = $id;
		}
		public function getId() {
			return $this->id;
		}
		
		public function setNomeTipoInvestimento($nomeTipoInvestimento) {
			$this->nomeTipoInvestimento = $nomeTipoInvestimento;
		}
		public function getNomeTipoInvestimento() {
			return $this->nomeTipoInvestimento;
		}
		
		public function setIdTipoRenda($idTipoRenda) {
			$this->idTipoRenda = $idTipoRenda;
		}
		public function getIdTipoRenda() {
			return $this->idTipoRenda;
		}
	}

?>