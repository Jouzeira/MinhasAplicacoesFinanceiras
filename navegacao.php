<?php
$menubla 		= isset ( $_GET ['menubla'] ) 		? $_GET ['menubla'] 	: 0;
$menuInvest 	= isset ( $_GET ['menuInvest'] ) 	? $_GET ['menuInvest'] 	: 0;
$menuInst 		= isset ( $_GET ['menuInst'] ) 		? $_GET ['menuInst'] 	: 0;
$menuUsuario 	= isset ( $_GET ['menuUsuario'] ) 	? $_GET ['menuUsuario'] : 0;

?>

<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#navbar" aria-expanded="false"
				aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<img src="/MinhasAplicacoesFinanceiras/imagens/cifrao.png"
				height="40" />
		</div>

		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li <?php if($menubla==1) {?> class="active" <?php }?>><a
					href="instituicoesFinanceiras.php?menubla=1">bla bla</a></li>
				<li <?php if($menuInvest==1) {?> class="active" <?php }?>><a
					href="/MinhasAplicacoesFinanceiras/visao/investimentos/investimentos.php?menuInvest=1">Investimentos</a></li>
				<li <?php if($menuInst==1) {?> class="active" <?php }?>><a
					href="/MinhasAplicacoesFinanceiras/instituicoesFinanceiras.php?menuInst=1">Instituições
						Financeiras</a></li>
				<li <?php if($menuUsuario==1) {?> class="active" <?php }?>><a
					href="/MinhasAplicacoesFinanceiras/inscrevase.php?menuUsuario=1"><?= $_SESSION['NOME_PESSOA'] ?></a></li>
				<li><a href="controler/sair.php">Sair</a></li>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</nav>