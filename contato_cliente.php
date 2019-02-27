<?php

    session_start();

    $secao_usuario = $_SESSION['usuario'];
    $nivel_acesso = $_SESSION['nivel_acesso'];

    if(!isset($secao_usuario)){
        header("Location: menu.php");
    }

    require_once("config/conn.php");

    $query = $pdo->prepare("SELECT * FROM cadastro WHERE usuario = :secao_usuario");
    $query->execute([
        ":secao_usuario" => $secao_usuario
    ]);

    $usuario = $query->fetch(PDO::FETCH_ASSOC);

?>

<?php require_once("includes/head.php"); ?>

<body>

<?php 
    $active = "cliente";
    require_once("includes/navbar.php"); 
?>

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
                        </div>
                    </div>
                </div>
            </div>
	    </div>
</section>

<?php require_once("includes/footer.php"); ?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="ajax/valida_cadastro.js"></script>
<script type="text/javascript" src="ajax/valida_contato.js"></script>
<script type="text/javascript" src="js/jquery-scrolltofixed.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.isotope.js"></script>
<script type="text/javascript" src="js/wow.js"></script>
<script type="text/javascript" src="js/classie.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="http://malsup.github.io/min/jquery.form.min.js"></script>
<script src="animate.js"></script>
</body>
</html>