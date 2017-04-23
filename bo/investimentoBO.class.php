<?php
class investimentoBO {
	
	private $id;
	private $idTipo;
	private $idPessoa;
	private $idTipoRenda;
	private $idTipoCategoria;
	private $idInstFinanceira;
	private $nomeInvestimento;
	private $dataAplicacao;
	private $dataMinimaResgate;
	private $dataVencimento;
	private $valorAplicacao;
	private $taxaContratada;
	private $taxaCorretagem;
	
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	public function setIdTipo($idTipo) {
		$this->idTipo = $idTipo;
	}
	public function getIdTipo() {
		return $this->idTipo;
	}
	public function setIdPessoa($idPessoa) {
		$this->idPessoa = $idPessoa;
	}
	public function getIdPessoa() {
		return $this->idPessoa;
	}
	public function setIdTipoRenda($idTipoRenda) {
		$this->idTipoRenda = $idTipoRenda;
	}
	public function getIdTipoRenda() {
		return $this->idTipoRenda;
	}
	public function setIdTipoCategoria($idTipoCategoria) {
		$this->idTipoCategoria = $idTipoCategoria;
	}
	public function getIdTipoCategoria() {
		return $this->idTipoCategoria;
	}
	public function setIdInstFinanceira($idInstFinanceira) {
		$this->idInstFinanceira = $idInstFinanceira;
	}
	public function getIdInstFinanceira() {
		return $this->idInstFinanceira;
	}
	public function setNomeInvestimento($nomeInvestimento) {
		$this->nomeInvestimento = $nomeInvestimento;
	}
	public function getNomeInvestimento() {
		return $this->nomeInvestimento;
	}
	public function setDataAplicacao($dataAplicacao) {
		$this->dataAplicacao = $dataAplicacao;
	}
	public function getDataAplicacao() {
		return $this->dataAplicacao;
	}
	public function setDataMinimaResgate($dataMinimaResgate) {
		$this->dataMinimaResgate = $dataMinimaResgate;
	}
	public function getDataMinimaResgate() {
		return $this->dataMinimaResgate;
	}
	public function setDataVencimento($dataVencimento) {
		$this->dataVencimento = $dataVencimento;
	}
	public function getDataVencimento() {
		return $this->dataVencimento;
	}
	public function setValorAplicacao($valorAplicacao) {
		$this->valorAplicacao = $valorAplicacao;
	}
	public function getValorAplicacao() {
		return $this->valorAplicacao;
	}
	public function setTaxaContratada($taxaContratada) {
		$this->taxaContratada = ($taxaContratada==null || $taxaContratada=="")?0:$taxaContratada;
	}
	public function getTaxaContratada() {
		return $this->taxaContratada;
	}
	public function setTaxaCorretagem($taxaCorretagem) {
		$this->taxaCorretagem = ($taxaCorretagem==null || $taxaCorretagem=="")?0:$taxaCorretagem;
	}
	public function getTaxaCorretagem() {
		return $this->taxaCorretagem;
	}
	public function getValorAplicacaoPadraoBD() {
		$verificar = array(",");
		$substituir   = array(".");
		return str_replace($verificar, $substituir, $this->valorAplicacao);
	}
	public function getTaxaContratadaPadraoBD() {
		$verificar = array(",");
		$substituir   = array(".");
		return str_replace($verificar, $substituir, $this->taxaContratada);
	}
	public function getTaxaCorretagemPadraoBD() {
		$verificar = array(",");
		$substituir   = array(".");
		return str_replace($verificar, $substituir, $this->taxaCorretagem);
	}
	public function getValorAplicacaoPadraoTela() {
		$verificar = array(".");
		$substituir   = array(",");
		return str_replace($verificar, $substituir, $this->valorAplicacao);
	}
	public function getTaxaContratadaPadraoTela() {
		$verificar = array(".");
		$substituir   = array(",");
		return str_replace($verificar, $substituir, $this->taxaContratada);
	}
	public function getTaxaCorretagemPadraoTela() {
		$verificar = array(".");
		$substituir   = array(",");
		return str_replace($verificar, $substituir, $this->taxaCorretagem);
	}
	public function getDataAplicacaoFormatada() {
		return substr($this->dataAplicacao, 8,2)."/".substr($this->dataAplicacao, 5,2)."/".substr($this->dataAplicacao, 0,4);
	}
	public function getValorAplicacaoFormatado() {
		return "R$ ".$this->getValorAplicacaoPadraoTela();
	}
}

?>