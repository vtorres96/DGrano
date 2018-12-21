
<?php

    session_start();

    // Incluindo arquivo de conexão
    require_once('config/conn.php');

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
        .pointer{
          cursor: pointer;
        }
    </style>

    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="http://malsup.github.io/min/jquery.form.min.js"></script>

    <script type="text/javascript">
            // Sem Refresh Contato

            // Quando carregado a página
            $(function ($) {

                // Quando enviado o formulário
                $('#formulario_contato').on('submit', function () {

                    // Armazenando objetos em variáveis para utilizá-los posteriormente
                    var formulario = $(this);
                    var botao = $('#salvar_contato');
                    var mensagem = $('#mensagem_contato');

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

            // Sem Refresh para Cadastro

            // Quando carregado a página
            $(function ($) {

                // Quando enviado o formulário
                $('#formulario_cadastro').on('submit', function () {

                    // Armazenando objetos em variáveis para utilizá-los posteriormente
                    var formulario = $(this);
                    var botao = $('#salvar_cadastro');
                    var mensagem = $('#mensagem_cadastro');

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
<!--Inicio-Menu-->
<nav class="main-nav-outer" id="test">
	<div class="container">
        <ul class="main-nav">
            <li><a href="#Software" class="active">Home</a></li>
            <li><a href="#Produtos">A D'Grano</a></li>
            <li class="small-logo"><a href="#Software"><img src="img/d-grano.png" style="width:60px;" alt=""></a></li>
            <li><a href="#Contato">Contato</a></li>
            <li><a href="#Restrito">Acesso</a></li>
        </ul>
        <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
    </div>
</nav>
<!--Fim-Menu-->

<!--Inicio Nosso Software-->
<section class="main-section alabaster" id="Software" class="active">
	<div class="container">
	    <h2>Nosso Sistema</h2>
		<h6>A D'Grano® Panificadora tem o compromisso de fornecer meios para que seus clientes possam ter uma gestão sistêmica e eficiente das suas reservas e pedidos.</h6>
    	<div class="row">
			<figure class="col-lg-5 col-sm-4 wow fadeInLeft">
            	<img  src="img/noteedit.png" alt="">
            </figure>
        	<div class="col-lg-7 col-sm-8 featured-work">
            	<div class="featured-box">
                    <div class="featured-box-col2 wow fadeInRight delay-02s">
                        <br>
                        <p class="justify">
                            <b>Qualidade</b> - Buscamos sempre excelência ao servir nossos clientes, foco em servir bem para servir sempre.
                                <br>
                                <br>
                            <b>Desenvolvimento</b> - Nossos produtos são flexíveis para diferentes segmentos do varejo, o que permite fácil adaptação para a realidade de cada cliente.
                                <br>
                                <br>
                            <b>Implantação</b> - Conhecer o cliente é fudamental para que o sistema funcione. Nós estudamos suas necessidades e entregamos a solução em pleno funcionamento.
                                <br>
                                <br>
                            <b>Treinamento</b> - Nossos profissionais recebem um treinamento desde os processos iniciais e simples até os mais complexos e avançados, para melhor atender nossos clientes.
                                <br>
                                <br>
                            <b>Atendimento</b> - Aqui na D'Grano você não fica na mão. Temos solidez, estrutura e uma equipe bem treinada para lhe atender.
			            </p>
                    </div>
                </div>
                <a class="Learn-More" href="#">Learn More</a>
            </div>
        </div>
	</div>

        <br><br><br><br>
	<div id="one"></div><!--Esta DIV serve para setar os links da pasta Links-->

</section>
<!--Fim Nosso Software-->

<!--Inicio Nosso Software-->
<section class="main-section alabaster" id="Produtos" style="background:url('img/fundo_sobrenos.jpg');">
	<div class="container" style="background:rgba(251, 251, 251, 0.9);">
            <h2>Quem Somos</h2>
            <h6>A D'Grano® Panificadora tem o compromisso como uma de nossas filosofias, e com foco em atender a com empatia, proporcionando a sua preferência, e a nossa qualidade como indústria panificaçao e confeitaria.</h6>
            <div class="row">
                    <figure class="col-lg-5 col-sm-4 wow fadeInLeft">
                        <img src="img/D-GRANO.png" style="width:75%;">
                    </figure>

        	<div class="col-lg-7 col-sm-8 featured-work">
                    <div class="featured-box">
                        <div class="featured-box-col2 wow fadeInRight delay-02s">

                            <p class="justify">
                                A D'Grano, umas das primeiras a produzir a mais completa linha de produtos para panificação e confeitaria,<br> se
                                dedica há mais de 10 anos em deixar a vida muito mais saborosa.<br> As misturas para pães e bolos e toda variedade de
                                produtos para padarias produzidos pela Adinor aprimoram as receitas<br> deixando o sabor mais delicioso.<br>
                                Os principais ingredientes do sucesso da D'Grano estão nas matérias-primas de primeira linha, vindas de vários
                                países,<br> na tecnologia própria e no alto controle de qualidade nas várias etapas da industrialização dos produtos.
                                A empresa conta também com mão de obra especializada em todos os setores da indústria e integração total com os
                                clientes.<br> Aliado a tudo isso, soma-se também investimentos constantes em pesquisas e desenvolvimento dos produtos
                                e na prestação<br> de serviços de qualidade. Localizada de forma estratégica no Centro Industrial de São Paulo
                                (CISP), um dos mais importantes<br> pólos industriais do Estado de São Paulo,
                                possuimos um espaço privilegiado para todas as etapas do processo de produção, centrado em um só lugar. <br><br>
                            </p>
                            <br><br>
                        </div>
                    </div>
                </div>
                <figure class="col-lg-5 col-sm-4 wow fadeInLeft">
                        <img src="img/paes_sobrenos.jpg" style="width:95%;">
                    </figure>

        	<div class="col-lg-7 col-sm-8 featured-work">
                    <div class="featured-box">
                        <div class="featured-box-col2 wow fadeInRight delay-02s">
                            <p class="justify">
                                E para garantir um crescimento constante, a qualidade e o bom desempenho dos seus produtos no mercado, a D'Grano<br>
                                dispõe de um moderno centro técnico, onde todos os produtos são testados. É por tudo isso que a D'Grano é uma das
                                empresas<br> que mais crescem no Sudeste com destaque entre as melhores indústrias do segmento no Brasil e com
                                atuação em quase todo<br> território nacional e alto grau de satisfação dos clientes.
                                 E para garantir um crescimento constante, a qualidade e o bom desempenho dos seus produtos no mercado, a D'Grano<br>
                                dispõe de um moderno centro técnico, onde todos os produtos são testados.
                            </p>
                            <br><br><br><br><br><br><br><br>
                        </div>
                    </div>
                </div>
                <figure class="col-lg-5 col-sm-4 wow fadeInLeft">
                    <img src="img/integrais_sobrenos.png" style="width:80%;">
                </figure>
                <div class="col-lg-7 col-sm-8 featured-work">
                    <div class="featured-box">
                        <div class="featured-box-col2 wow fadeInRight delay-02s">

                            <p class="justify">
                                  <br>
                                <b>Sustentabilidade</b> - Industrializar matérias primas de qualidade contribuindo com o desenvolvimento tecnológico agregando valores e
                                viabilizando a sustentabilidade do segmento de panificação e confeitaria.
                                                            <br>
                                                        <br>
                                <b>Referência</b> - Ser uma empresa de Referência em qualidade e tecnologia de matérias primas no segmento da indústria Brasileira de
                                panificação e confeitaria.
                                <br>
                                                        <br>
                                <b>Ética</b> - Agimos de forma coerente e correta com os nossos clientes, para proporcioná-los diferença no tratamento.
                            </p>
                        </div>
                    </div>
                    <a class="Learn-More" href="#">Learn More</a>
                </div>
            </div>
	</div>
    <div id="one"></div><!--Esta DIV serve para setar os links da pasta Links-->
</section>
<!--Fim Nosso Software-->

<!-- Inicio Formulário D'Grano -->
<section class="main-section" id="Contato" style="background: url('img/fundo_contato.jpg')no-repeat;">
	<div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 wow fadeInLeft delay-05s">

                    <div class="service-list">
                        <div class="container" style="background:#ffffffd6;">
                            <br>
                            <h2>Preencha o formulário</h2>
                            <h6>A D'Grano® Panificadora, agradece a sua preocupação em oferecer sugestão, nos auxiliando na busca por excelência.</h6>
                            <br>
                            <br>
                            <div class="col-lg-6 col-sm-7 wow fadeInLeft">
                                <div class="contact-info-box address clearfix">
                                        <h3><i class=" icon-map-marker"></i>Endereço:</h3>
                                        <span>Praça Nove de Julho 164<br>Guararema, São Paulo</span>
                                </div>
                                <div class="contact-info-box phone clearfix">
                                        <h3><i class="fa-phone"></i>Telefone:</h3>
                                        <span>(11) 2258-9502 / 2231-5728</span>
                                </div>
                                <div class="contact-info-box email clearfix">
                                        <h3><i class="fa-pencil"></i>email:</h3>
                                        <span>dgrano@dgrano.com.br</span>
                                </div>
                                <div class="contact-info-box hours clearfix">
                                        <h3><i class="fa-clock-o"></i>Horários:</h3>
                                        <span><strong>Segunda - Quinta:</strong> 06:00 - 23:00<br><strong>Sexta:</strong> 06:00 - 22:00<br><strong>Sábado - Domingo:</strong> 06:00 - 21:00<br></span>
                                </div>
                                <ul class="social-link">
                                        <li class="twitter"><a href="https://twitter.com/DGranoOficial"><i class="fa-twitter"></i></a></li>
                                    <li class="facebook"><a href="https://www.facebook.com/Panificadora-D-Grano-444581252664304/"><i class="fa-facebook"></i></a></li>
                                    <li class="gplus"><a href="#"><i class="fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                            <form id="formulario_contato" action="salvar_contato.php" method="POST">

                            <div class="col-lg-6">

                                <div id="mensagem_contato"></div>


                                <div class="form-group">
                                    <label>Nome: </label>
                                    <input class="form-control" style="background:#ffffffd6;" type="text" name="nome" id="nome" value="" required>
                                </div>

                                <div class="form-group">
                                    <label>E-mail: </label>
                                    <input class="form-control" style="background:#ffffffd6;" type="email" name="email" id="email" value="" required>
                                </div>

                                <div class="form-group">
                                    <label>Mensagem: </label>
                                    <textarea class="form-control" style="background:#ffffffd6;" rows="8" name="mensagem" maxlength="200"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="submit" id="salvar_contato" class="btn btn-primary" value="Enviar Mensagem" data-loading-text="Enviando...">
                                </div>

                            </div>
                            </form>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
	</div>
</section>
<!--Fim Formulário D'Grano -->

<!--Inicio Área Restrita-->
<section class="main-section" id="Restrito" style="background: url('img/fundo_login.jpg')no-repeat;">
	<div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 wow fadeInLeft delay-05s">
                    <div class="service-list">
                        <div class="container" style="background:rgba(251, 251, 251, 0.9);">
                            <br>
                            <h2>Área Restrita</h2>
                            <h6>A D'Grano disponibiliza uma área restrita para clientes com uma gama de funcionalidades integradas à fim de automatizar suas reservas,
                                também disponibilizamos suporte para solucionar todas as suas dúvidas.</h6>
                            <div class="container col-lg-8" style="width: 1140px; background:rgba(251, 251, 251, 0.1);">
                                <br>
                                <div class="col-lg-6">
                                    <br>

                                            <h1>Não possui cadastro?</h1>
                                            <div class="form-group col-lg-8">
                                            <label>Preencha o formulário abaixo para se cadastrar.</label>
                                            </div>
                                    <br>
                                    <form id="formulario_cadastro" method="POST" action="salvar_cadastro.php">

                                        <div class="col-lg-6">
                                            <div id="mensagem_cadastro"></div>
                                        </div>

                                        <div class="form-group col-lg-10">
                                            <label>Informe Nome: </label>
                                            <input type="text" class="form-control" name="nome" id="nome" value="" required>
                                        </div>
                                        <div class="form-group col-lg-10">
                                            <label>Informe E-mail: </label>
                                            <input type="text" class="form-control" name="email" id="email" value="" required>
                                        </div>

                                        <div class="form-group col-lg-10">
                                              <label>Informe Login: </label>
                                            <input type="text" class="form-control" name="usuario" id="usuario" value="" required>
                                        </div>

                                        <div class="form-group col-lg-10">
                                            <label>Informe Senha:   </label>
                                            <input type="password" class="form-control" name="senha" id="senha" value="" required>
                                        </div>

                                        <div class="form-group col-lg-10">
                                            <input type="hidden" class="form-control" name="nivel_acesso" id="nivel_acesso">
                                            <input type="submit" id="salvar_cadastro" class="btn btn-primary" value="Cadastrar" id="cadastrar" name="cadastrar">
                                        </div>
                                    </form>
                                <br>
                                </div>
                                <div class="col-lg-4">
                                    <br>
                                    <h1>Já possuo cadastro.</h1>
                                    <div class="form-group">
                                        <label>Informe seu Login e Senha para se logar.</label>
                                    </div>
                                    <br>
                                    <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text"class="form-control" placeholder="Usuario" name="usuario" >
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Senha" name="senha">
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <input type="submit" name="logar" value="Logar" class="btn btn-primary">
                                    </form>
                                    <br><br>
                                    <?php  include('config/logar.php');  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="container"></div>
</section>
<!--Fim Área Restrita-->



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
