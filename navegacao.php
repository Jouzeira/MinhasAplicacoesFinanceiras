<?php 

$menubla= isset($_GET['menubla'])		? $_GET['menubla'] 	: 0;
$menuble= isset($_GET['menuble'])		? $_GET['menuble'] 	: 0;
$menuInst= isset($_GET['menuInst'])		? $_GET['menuInst'] 	: 0;

?>



		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	           <img src="imagens/cifrao.png" height="40"/>
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li <?php if($menubla==1) {?>class="active"<?php }?> ><a href="instituicoesFinanceiras.php?menubla=1">bla bla</a></li>
	            <li <?php if($menuble==1) {?>class="active"<?php }?> ><a href="instituicoesFinanceiras.php?menuble=1">ble ble</a></li>
	            <li <?php if($menuInst==1) {?>class="active"<?php }?> ><a href="instituicoesFinanceiras.php?menuInst=1">Instituições Financeiras</a></li>
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>