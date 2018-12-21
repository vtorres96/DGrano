<?php session_start();  ?>

<?php

    if(!isset($_SESSION['usuario']) && (!isset($_SESSION['senha']))){
        header("Location: menu.php");
    }

    // Incluindo arquivo de conexão
    require_once('config/conn.php');

    // Selecionando fotos no banco de dados
    $stmt = $pdo->query('SELECT id, codigo, descricao, preco FROM produtos');

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

    <!-- Início do sript JQuery JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Fim do script JQuery JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="http://malsup.github.io/min/jquery.form.min.js"></script>

    <script type="text/javascript">

            // Quando carregado a página
            $(function ($) {

                // Quando enviado o formulário
                $('#formulario').on('submit', function () {

                    // Armazenando objetos em variáveis para utilizá-los posteriormente
                    var formulario = $(this);
                    var botao = $('#salvar');
                    var mensagem = $('#mensagem');

                    // Exibindo indicador de carregamento (Bootstrap)
                    // Docs: http://getbootstrap.com/javascript/#buttons
                    botao.button('loading');

                    // Enviando formulário
                    $(this).ajaxSubmit({

                        // Definindo tipo de retorno do servidor
                        dataType: 'json',

                        // Se a requisição foi um sucesso
                        success: function (retorno) {

                            // Se cadastrado com sucesso
                            if (retorno.sucesso) {
                                // Definindo estilo da mensagem (sucesso)
                                mensagem.attr('class', 'alert alert-success');

                                // Limpando formulário
                                formulario.resetForm();
                            }
                            else {
                                // Definindo estilo da mensagem (erro)
                                mensagem.attr('class', 'alert alert-danger');
                            }

                            // Exibindo mensagem
                            mensagem.html(retorno.mensagem);

                            // Escondendo indicador de carregamento
                            botao.button('reset');

                        },

                        // Se houver algum erro na requisição
                        error: function () {

                            // Definindo estilo da mensagem (erro)
                            mensagem.attr('class', 'alert alert-danger');

                            // Exibindo mensagem
                            mensagem.html('Oops, ocorreu um erro');

                            // Escondendo indicador de carregamento
                            botao.button('reset');
                        }

                    });

                    // Retorna FALSE para que o formulário não seja enviado de forma convencional
                    return false;

                });

            });

    </script>
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

                <div class="container">
			<h1>Cadastro de Produtos</h1>
			<br>
			<form id="formulario" action="ajax/salvar.php" method="post">

				<div id="mensagem"></div>

				<div class="form-group">
					<label>Escolha a Foto</label>
					<input class="form-control" type="file" name="foto"/>
				</div>

                                <div class="form-group">
					<label>Informe o Código do Produto: </label>
                                        <input class="form-control" type="text" name="codigo" maxlength="10"/>
				</div>

                                <div class="form-group">
					<label>Informe a Descrição do Produto: </label>
					<input class="form-control" type="text" name="descricao" maxlength="30"/>
				</div>

                                <div class="form-group">
					<label>Informe o Preço do Produto: </label>
					<input class="form-control" type="text" name="preco" maxlength="2"/>
				</div>

				<input id="salvar" class="btn btn-primary" type="submit" value="Salvar" data-loading-text="Salvando..."/>

			</form>
			<br><br>

                        <h1>Produtos Cadastrados</h1>
                        <br>
                        <div class="row">

                                <?php while ($foto = $stmt->fetchObject()){ ?>

                                        <div class="col-sm-6 col-md-4">

                                                <div class="thumbnail">

                                                        <img style="width:75%;" src="imagem.php?id=<?php echo $foto->id ?>" />

                                                        <div class="caption">
                                                                <strong>Código:</strong> <?php echo $foto->codigo ?> <br/>
                                                                <strong>Descrição:</strong> <?php echo $foto->descricao ?> <br/>
                                                                <strong>Preço:</strong> R$: <?php echo number_format($foto->preco,2) ?> <br/><br/>
                                                                <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $foto->id; ?>"  data-whatevercodigo="<?php echo $foto->codigo; ?>" data-whateverdescricao="<?php echo $foto->descricao; ?>" data-whateverpreco="<?php echo number_format($foto->preco,2); ?>">Alterar Produto</button>
                                                        </div>
                                                        <br><br>
                                                </div>

                                        </div>

                                <?php } ?>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="exampleModalLabel">Alteração de Produtos</h4>
                                        </div>
                                        <div class="modal-body">
                                                <form method="POST" action="processa_produto.php" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                                <label for="recipient-codigo" class="control-label">Código:</label>
                                                                <input name="codigo" type="text" class="form-control" id="recipient-codigo">
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="recipient-descricao" class="control-label">Descrição:</label>
                                                                <input name="descricao" type="text" class="form-control" id="recipient-descricao">
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="recipient-preco" class="control-label">Preço:</label>
                                                                <input name="preco" type="text" class="form-control" id="recipient-preco">
                                                        </div>
                                                        <input name="id" type="hidden" id="id">
                                                        <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-danger">Alterar</button>
                                                        </div>
                                                </form>
                                        </div>
                                    </div>
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
                var recipientcodigo = button.data('whatevercodigo')
                var recipientdescricao = button.data('whateverdescricao')
                var recipientpreco = button.data('whateverpreco')
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Alteração do Produto: ' + recipientdescricao)
                modal.find('#id').val(recipient)
                modal.find('#recipient-codigo').val(recipientcodigo)
                modal.find('#recipient-descricao').val(recipientdescricao)
                modal.find('#recipient-preco').val(recipientpreco)
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
