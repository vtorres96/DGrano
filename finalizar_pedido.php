<?php session_start();  ?>

<?php

    if(!isset($_SESSION['usuario']) && (!isset($_SESSION['senha']))){	
        header("Location: menu.php");	
    }

?>
<?php 
    
    include ("conexao.php"); 

        if(isset($_POST['deletar'])){

            $id_prod = $_POST['id_prod'];
            // sql to delete a record
            $sql = "DELETE FROM pedido WHERE id = '$id_prod' ";

            if ($conn->query($sql) === TRUE) {
                echo "";
            } else {
                echo "Erro ao deletar: " . $conn->error;
            }

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
    .myButton {
        background:url(img/trash.png) no-repeat;
        cursor:pointer;
        width: 40px;
        height: 40px;
        border: none;
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
            <li><a href="contato_cliente.php">Enviar Mensagem</a></li>
            <li><a href="visualizar_produtos.php">Visualizar Produtos</a></li>
            <li class="small-logo"><a href="menu_cliente.php"><img src="img/d-grano.png" style="width:60px;" alt=""></a></li>
            <li><a href="visualizar_pedidos.php">Visualizar Pedidos</a></li>
            <li><a href="logoff.php">Sair</a></li>
            <li><a href="">    </a></li>
            <?php	

            include ("conexao.php");

            $sql = "SELECT * FROM cadastro WHERE usuario = '$secao_usuario'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {	?>
            <li><a href="" title="Alterar Cadastro" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $row['id']; ?>" data-whatevernome="<?php echo $row['nome']; ?>"  data-whateveremail="<?php echo $row['email']; ?>" data-whateverusuario="<?php echo $row['usuario']; ?>" data-whateversenha="<?php echo $row['senha']; ?>"><i class="fa-user"></i> Cliente: <?php  echo $secao_usuario; ?></a></li>
                <?php } ?>
            <?php } ?>
        </ul>
        <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
    </div>
</nav>
<!--Fim-Menu-->

        <br><br>
        <div class="container">
			
            <h1>Finalize Seu Pedido</h1>	
            <br><br>     
            
            <form method="POST" action="salvar_finalizar_pedido.php" class="">
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                    <tr>                                            
                                        <th>Cliente</th>
                                        <th>Código Produto</th>
                                        <th>Descrição</th>
                                        <th>Preço</th>
                                        <th>Quantidade</th>
                                        <th>Custo Total Produto</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php	

                                        $sql = "SELECT * FROM pedido WHERE status = ' ' AND cliente = '$secao_usuario' ORDER BY id";
                                        $result = $conn->query($sql);
                                        $i = 0;   
                                        if ($result->num_rows > 0) {

                                            while($row = $result->fetch_assoc()) {	
                                                    echo'<tr>';
                                                        echo '<input type="hidden" name="id[]" value="' . $row['id'] . '">';
                                                        echo '<td>' . $row['cliente'] . '</td>';
                                                        echo '<input type="hidden" name="cliente" value="' . $row['cliente'] . '">';
                                                        echo '<td>' . $row['codigo'] . '</td>';
                                                        echo '<input type="hidden" name="codigo[]" value="' . $row['codigo'] . '">';
                                                        echo '<td>' . $row['descricao'] . '</td>';
                                                        echo '<input type="hidden" name="descricao[]" value="' . $row['descricao'] . '">';
                                                        echo '<td>' . $row['preco_venda'] . '</td>';
                                                        echo '<input type="hidden" id="preco_venda" name="preco_venda[]" value="' . $row['preco_venda'] . '" special="price">';
                                                        echo '<td><input type="text" id="quantidade" name="quantidade[]" value="1" autofocus special="quantity"></td>';
                                                        echo '<td><input type="text" id="custo_total" name="custo_total[]" style="border:none;" readonly></td>';
                                                        echo '<input type="hidden" name="status[]" value="FIN">';
                                                        echo '<form action="" enctype="multipart/form-data" method="post">';
                                                        echo '<input type="hidden" name="id_prod" value="' . $row['id'] . '">';
                                                        echo '<td><input type="submit" name="deletar" class="myButton" value="" title="Excluir"></td>';
                                                        echo '</form>';
                                                    echo '</tr>';
                                                }

                                        }
                                        //$conn->close();
                                    ?>				
                                </tbody>
                            </table>
                            <table>
                                <tr>
                                    <td>
                                        Valor Total R$: <span id="PrintSoma">0.00</span>
                                    </td>
                                </tr>
                            </table>
                            <script>  
                                /* Ínicio de Função criada para calcular dinamicamente o preço * quantidade e mostrar o resultado total por produto e por fim abaixo da tabela o total da compra */
                                var prices = document.querySelectorAll("[id^=preco_venda]"),
                                    ammounts = document.querySelectorAll("[id^=quantidade]"),
                                    subTotals = document.querySelectorAll("[id^=custo_total]"),
                                    printSum = document.getElementById("PrintSoma");

                                function sumIt() {
                                    var total = 0;

                                    Array.prototype.forEach.call(prices, function (price, index) {
                                        var subTotal = (parseFloat(price.value) || 0) * (parseFloat(ammounts[index].value) || 0);

                                        subTotals[index].value = subTotal.toFixed(2);
                                        total += subTotal;

                                    });

                                    printSum.textContent = total.toFixed(2);
                                }

                                Array.prototype.forEach.call(prices, function (input) {
                                    input.addEventListener("keyup", sumIt, false);
                                });

                                Array.prototype.forEach.call(ammounts, function (input) {
                                    input.addEventListener("keyup", sumIt, false);
                                });
                                /* Fim de Função criada para calcular dinamicamente o preço * quantidade e mostrar o resultado total por produto e por fim abaixo da tabela o total da compra */
                                sumIt();
                            </script>
                        </div>			
                        <!-- /.table-responsive -->
                        
                        <br><br>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                <input type="submit" class="btn btn-primary" value="Finalizar Pedido" id="finalizar" name="finalizar">
            </form>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
             
            
        </div>
        
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Alteração de Cadastro</h4>
                        </div>
                        <div class="modal-body">
                                <form method="POST" action="processa_cliente.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                                <label for="recipient-name" class="control-label">Nome:</label>
                                                <input name="nome" type="text" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="form-group">
                                                <label for="recipient-email" class="control-label">Email:</label>
                                                <input name="email" type="text" class="form-control" id="recipient-email">
                                        </div>
                                        <div class="form-group">
                                                <label for="recipient-usuario" class="control-label">Usuario:</label>
                                                <input name="usuario" type="text" class="form-control" id="recipient-usuario">
                                        </div>
                                    <div class="form-group">
                                                <label for="recipient-senha" class="control-label">Senha:</label>
                                                <input name="senha" type="text" class="form-control" id="recipient-senha">
                                        </div>
                                        <input name="id" type="hidden" id="id_curso">
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                                <input type="submit" class="btn btn-danger" value="Alterar" name="finalizar">
                                        </div>
                                </form>
                        </div>			  
                </div>
        </div>
</div>
<!--Inicio Rodapé-->
<footer class="footer">
    <div class="container">
        <div class="footer-logo"><a href="#"><img src="img/d-grano.png" style="width:80px;" alt=""></a></div>
        <span class="copyright">&reg; D'Grano. Todos direitos Reservados</span>
    </div>
</footer>
<!--Fim Rodapé-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
        $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                var recipientnome = button.data('whatevernome')
                var recipientemail = button.data('whateveremail')
                var recipientusuario = button.data('whateverusuario')
                var recipientsenha = button.data('whateversenha')
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Alteração de Cadastro do Cliente: ' + recipientnome)
                modal.find('#id_curso').val(recipient)
                modal.find('#recipient-name').val(recipientnome)
                modal.find('#recipient-email').val(recipientemail)
                modal.find('#recipient-usuario').val(recipientusuario)
                modal.find('#recipient-senha').val(recipientsenha)
        })
</script>

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