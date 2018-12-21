<?php session_start();  ?>

<?php

    if(!isset($_SESSION['usuario']) && (!isset($_SESSION['senha']))){	
        header("Location: menu.php");	
    }

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

<style>
.justify{
    text-align: justify;
    text-justify: inter-word;
}
</style>

</head>
<body>
<?php
    $secao_usuario = $_SESSION['usuario'];
     
?>
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

        <br><br>
        <div class="container">
			
            <h1>Visualize as Mensagens </h1>
            <br>
            <div class="form-group col-lg-8">
                <label>Lista de Sugestões / Mensagens enviadas pelos usuários.</label>
            </div>  
            <br><br>     
            
            <div class="table-responsive">
                <table class="table  table-bordered table-hover">
                    <thead>
                        <tr>                                            
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Mensagem</th>
                            <th>Visualizar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php	include("conexao.php");

                            $sql = "SELECT * FROM contato ORDER BY id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {

                                while($row = $result->fetch_assoc()) {	?>
                                    <tr>
                                        <?php $row['id']; ?>
                                        <td><?php echo $row['nome']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['mensagem']; ?></td>
                                        <td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal<?php echo $row['id']; ?>">Visualizar</button></td>
                                        <td><a href="processa_apagar.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-xs btn-danger">Apagar</button></a></td>
                                    </tr>
                                    <!-- Inicio Modal -->
                                    <div class="modal fade" id="myModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                            <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title text-center" id="myModalLabel">Mensagem de: <?php echo $row['nome']; ?></h4>
                                                            </div>
                                                            <div class="modal-body">                                                                   
                                                                    <p>Nome: <?php echo $row['nome']; ?></p>
                                                                    <br>
                                                                    <p>Email: <?php echo $row['email']; ?></p>
                                                                    <br>
                                                                    <p>Mensagem: <b><?php echo $row['mensagem']; ?></b></p>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                                    <!-- Fim Modal -->
                                <?php } ?>

                            <?php } ?>				
                    </tbody>
                </table>
            </div>
            
            <br><br><br><br><br><br><br><br>
        </div>

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