<?php

	class RentabilidadeMensalBO {
		
		private $id;
		private $idInvestimento;
		private $anoMes;
		private $valorRendimentoMensal;
		private $valorSaldoLiquidoMensal;
		private $valorPercentRentabilidadeMensal;
		private $nomeInvestimento;
		
		public function setId($id) {
			$this->id = $id;
		}
		public function getId() {
			return $this->id;
		}
		
		public function setIdInvestimento($idInvestimento) {
			$this->idInvestimento = $idInvestimento;
		}
		public function getIdInvestimento() {
			return $this->idInvestimento;
		}
		
		public function setAnoMes($anoMes) {
			$this->anoMes = $anoMes;
		}
		public function getAnoMes() {
			return $this->anoMes;
		}
		
		public function setValorRendimentoMensal($valorRendimentoMensal) {
			$this->valorRendimentoMensal = $valorRendimentoMensal;
		}
		public function getValorRendimentoMensal() {
			return $this->valorRendimentoMensal;
		}
		
		public function setValorSaldoLiquidoMensal($valorSaldoLiquidoMensal) {
			$this->valorSaldoLiquidoMensal = $valorSaldoLiquidoMensal;
		}
		public function getValorSaldoLiquidoMensal() {
			return $this->valorSaldoLiquidoMensal;
		}
		
		public function setValorPercentRentabilidadeMensal($valorPercentRentabilidadeMensal) {
			$this->valorPercentRentabilidadeMensal = $valorPercentRentabilidadeMensal;
		}
		public  function getValorPercentRentabilidadeMensal() {
			return $this->valorPercentRentabilidadeMensal;
		}
		public function setNomeInvestimento($nomeInvestimento) {
			$this->nomeInvestimento = $nomeInvestimento;
		}
		public function getNomeInvestimento() {
			return $this->nomeInvestimento;
		}
	}

?>