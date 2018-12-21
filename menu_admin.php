<?php

  session_start();
  include("conexao.php");

  $nivel_acesso  = $_SESSION['nivel_acesso'];
  $secao_usuario = $_SESSION['usuario'];

  if(!isset($_SESSION['usuario']) && (!isset($_SESSION['senha']))){
      header("Location: menu.php");
  }

  if($nivel_acesso != 1){
    header("Location: menu_cliente.php");
  }

  $query = "Select status, sum(custo_total) as valores from pedido Group by status";
  $result = mysqli_query($conn, $query);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1">

<title>D'Grano Panificadora</title>

<link rel="shortcut icon" type="imagem/x-icon" href="d-granos.png">

<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,800italic,700italic,600italic,400italic,300italic,800,700,600' rel='stylesheet' type='text/css'>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/responsive.css" rel="stylesheet" type="text/css">
<link href="css/animate.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

<script type="text/javascript" src="js/jquery.1.8.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery-scrolltofixed.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.isotope.js"></script>
<script type="text/javascript" src="js/wow.js"></script>
<script type="text/javascript" src="js/classie.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart()
    {
         var data = google.visualization.arrayToDataTable([
                   ['Status', 'Valores'],
                   <?php
                     while($row = mysqli_fetch_array($result))  {
                       if($result->num_rows > 0){
                           echo "['".$row["status"]."', ".number_format($row["valores"],2)."],";

                       }
                     }
                   ?>
              ]);
         var options = {
               title: 'Gráfico de Vendas - Pedidos Finalizados e em Aberto',
               is3D:true,
               pieHole: 0.4
          };
         var chart = new google.visualization.PieChart(document.getElementById('piechart'));
         chart.draw(data, options);
    }
</script>

<style>
  .justify{
      text-align: justify;
      text-justify: inter-word;
  }
  .pointer {
    cursor: pointer;
  }
</style>

</head>
<body>

<!--Inicio-Menu-->
<nav class="main-nav-outer" id="test">
	<div class="container">
        <ul class="main-nav">
            <li><a href="visualizar_cadastro.php">Visualizar Usuários</a></li>
            <li><a href="visualizar_contato.php">Visualizar Mensagens</a></li>
            <li class="small-logo"><a href="menu_admin.php"><img src="img/d-grano.png" style="width:60px;" alt=""></a></li>
            <li><a href="cadastro_produtos.php">Cadastrar Produtos</a></li>
            <li><a href="logoff.php">Sair</a></li>
            <li><a href=""><i class="fa-user"></i> Administrador: <?php  echo $secao_usuario; ?></a></li>
        </ul>
        <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
    </div>
</nav>
<!--Fim-Menu-->

<!--Inicio Nosso Software-->
<section class="main-section alabaster" id="Software">
	<div class="container">

	    <h2>Área administrativa</h2>
		<h6>A D'Grano® Panificadora tem o compromisso de fornecer meios para que seus clientes possam ter uma gestão sistêmica e eficiente dos números de sua empresa.</h6>
    	<div class="row">
        	<div class="col-lg-7 col-sm-8 featured-work">

                    <div style="width:900px; background:rgba(251, 251, 251, 0.9);">
                        <div id="piechart" style="width: 900px; height: 500px;"></div>
                    </div>

                <a class="Learn-More" href="#">Learn More</a>
            </div>
        </div>
	</div>


	<div id="one"></div><!--Esta DIV serve para setar os links da pasta Links-->


</section>
<!--Fim Nosso Software-->

<!--Inicio Rodapé-->
<footer class="footer">
    <div class="container">
        <div class="footer-logo"><a href="#"><img src="img/d-grano.png" style="width:80px;" alt=""></a></div>
        <span class="copyright">&reg; D'Grano. Todos direitos Reservados</span>
    </div>
</footer>
<!--Fim Rodapé-->


<script type="text/javascript">
    $(document).ready(function(e) {
        $('#test').scrollToFixed();
        $('.res-nav_click').click(function(){
            $('.main-nav').slideToggle();
            return false

        });

    });
</script>

  <script>
    wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100
      }
    );
    wow.init();
  </script>


<script type="text/javascript">
	$(window).load(function(){

		$('.main-nav li a').bind('click',function(event){
			var $anchor = $(this);

			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top - 102
			}, 1500,'easeInOutExpo');
			/*
			if you don't want to use the easing effects:
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top
			}, 1000);
			*/
			event.preventDefault();
		});
	})
</script>

<script type="text/javascript">

$(window).load(function(){


  var $container = $('.portfolioContainer'),
      $body = $('body'),
      colW = 375,
      columns = null;


  $container.isotope({
    // disable window resizing
    resizable: true,
    masonry: {
      columnWidth: colW
    }
  });

  $(window).smartresize(function(){
    // check if columns has changed
    var currentColumns = Math.floor( ( $body.width() -30 ) / colW );
    if ( currentColumns !== columns ) {
      // set new column count
      columns = currentColumns;
      // apply width to container manually, then trigger relayout
      $container.width( columns * colW )
        .isotope('reLayout');
    }

  }).smartresize(); // trigger resize to set container width
  $('.portfolioFilter a').click(function(){
        $('.portfolioFilter .current').removeClass('current');
        $(this).addClass('current');

        var selector = $(this).attr('data-filter');
        $container.isotope({

            filter: selector,
         });
         return false;
    });

});

</script>

</body>
</html>
