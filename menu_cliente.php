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

<!--Inicio Nosso Software-->
<section class="main-section alabaster" id="Software">
	<div class="container">
	    <h2>Nosso Software</h2>
		<h6>A DGrano Tecnologia tem o compromisso de fornecer meios para que seus clientes possam ter uma gestão sistêmica e eficiente dos números de sua empresa.</h6>
    	<div class="row">
			<figure class="col-lg-5 col-sm-4 wow fadeInLeft">
            	<img  src="img/noteedit.png" alt="">
            </figure>
        	<div class="col-lg-7 col-sm-8 featured-work">
            	<div class="featured-box">
                	<div class="featured-box-col2 wow fadeInRight delay-02s">
                        <p class="justify">
						<b>Desenvolvimento</b> - Nossos produtos são flexíveis para diferentes segmentos do varejo, o que permite fácil adaptação para a realidade de cada cliente.<br><br>
                        <b>Implantação</b> - Conhecer o cliente é fudamental para que o sistema funcione. Nós estudamos suas necessidades e entregamos a solução em pleno funcionamento.<br><br>
                        <b>Treinamento</b> - Nossos sistemas são de fácil manuseio, entretanto, um treinamento inicial é fundamental para ele seja utilizado adequadamente - e nós fazemos isso.<br><br>
                        <b>Hardware</b> - Sem hardware de qualidade, nada funciona. Nós montamos computadores e fornecemos impressoras fiscais e não fiscais, leitores de código de barras, etc.Detalhes<br><br>
                        <b>Redes e Internet</b> - Cabeamento estruturado, Reorganização de cabeamento existente, Identificação e Reparo de problemas de lentidão e travamento na rede de dados. Detalhes<br><br>
                        <b>Atendimento</b> - Aqui na DGrano você não fica na mão. Temos solidez, estrutura e uma equipe bem treinada para lhe atender.
						</p>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>
<!--Fim Nosso Software-->

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
                        <label class="control-label">Nome:</label>
                        <input name="nome" type="text" class="form-control" value="<?= $usuario["nome"]; ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Email:</label>
                        <input name="email" type="text" class="form-control" value="<?= $usuario["email"] ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Usuario:</label>
                        <input name="usuario" type="text" class="form-control" value="<?= $usuario["usuario"] ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Senha:</label>
                        <input name="senha" type="text" class="form-control" value="<?= $usuario["senha"] ?>">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-danger" value="Alterar" name="menu_cliente">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-scrolltofixed.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.isotope.js"></script>
<script type="text/javascript" src="js/wow.js"></script>
<script type="text/javascript" src="js/classie.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="http://malsup.github.io/min/jquery.form.min.js"></script>
<script type="text/javascript" src="js/animate.js"></script>

</body>
</html>
