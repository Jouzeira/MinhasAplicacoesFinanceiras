<?php

session_start();
// 	require_once '../../controler/home/preencheHome.php';
if(!isset($_SESSION['NOME_PESSOA'])){
	header('Location: ../../index.php?erro=1');
}

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">	

		<title>M.A.F</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		
		<!-- highcharts - link cdn -->
		<script src="../../utils/highcharts/code/highcharts.js"></script>
		<script src="../../utils/highcharts/code/modules/exporting.js"></script>
<!-- 		<script src="https://code.highcharts.com/highcharts.js"></script> -->
<!-- 		<script src="https://code.highcharts.com/modules/exporting.js"></script> -->

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="../../utils/bootstrap/css/bootstrap.min.css">
<!-- 		<link rel="stylesheet" href="../../utils/bootstrap/css/bootstrap.min.css"><!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
	
	</head>

	<body>

		<!-- Static navbar -->
	    <?php include 'navegacao.php';?>


	    <div class="container">
	    <div class="col-md-2"></div>
	    <div class="col-md-8">
				    	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="5"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="6"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="7"></li>
			  </ol>
			
			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
			    <div class="item active">
			      <img src="/imagens/Slide1.png" alt="Primeiros passos">
			    </div>
			    <div class="item">
			       <img src="/imagens/Slide2.png" alt="Primeiros passos">
			    </div>
			    <div class="item">
			       <img src="/imagens/Slide3.png" alt="Primeiros passos">
			    </div>
			    <div class="item">
			       <img src="/imagens/Slide4.png" alt="Primeiros passos">
			    </div>
			    <div class="item">
			       <img src="/imagens/Slide5.png" alt="Primeiros passos">
			    </div>
			    <div class="item">
			       <img src="/imagens/Slide6.png" alt="Primeiros passos">
			    </div>
			    <div class="item">
			       <img src="/imagens/Slide7.png" alt="Primeiros passos">
			    </div>
			    <div class="item">
			       <img src="/imagens/Slide8.png" alt="Primeiros passos">
			    </div>
			  </div>
			
			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
	    </div>
	    <div class="col-md-2"></div>
		</div><!-- /container -->
		
		
		
		<script>
			$('.carousel').carousel()
		</script>
		
		
	</body>
</html>