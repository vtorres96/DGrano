<?php
    require_once('config/conn.php');

    if(isset($_REQUEST['logar'])){

        $usuario = $_REQUEST['usuario'];
        $senha = $_REQUEST['senha'];

        $query = $pdo->prepare("SELECT * FROM cadastro WHERE usuario = :usuario AND senha = :senha ");
        $query->execute([
            ":usuario" => $usuario,
            ":senha" => $senha
        ]);

        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        if(!$usuario){
            $erro = true;
        } else if ($usuario["nivel_acesso"] == 1){
            session_start();

            $_SESSION['usuario'] = $usuario["nome"];
            $_SESSION['nivel_acesso'] = $usuario["nivel_acesso"];

            header("Location: menu_admin.php"); 
        } else {

            session_start();

            $_SESSION['usuario'] = $usuario["nome"];
            $_SESSION['nivel_acesso'] = $usuario["nivel_acesso"];

            header("Location: menu_cliente.php");
        }
    }
?>

<?php require_once("includes/head.php"); ?>

<body>
<?php 
    $active = "comum";
    require_once("includes/navbar.php"); 
?>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Digite o seu usuário e a sua senha</h3>
                </div>
                <div class="panel-body">
                    <fieldset>
                        <form method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                <input class="form-control" placeholder="Usuario" name="usuario" type="" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Senha" name="senha" type="password" value="">
                            </div>
                            <button type="submit" name="logar" id="logar" class="btn btn-lg btn-success btn-block">Logar</button>
                        </form>
                    </fieldset> <br>
                    <?php if(isset($erro) && $erro === true): ?>
                        <div class="form-group alert alert-danger">
                            Usuário ou senha inválidos
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

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
<script type="text/javascript" src="js/animate.js"></script>
</body>
</html>
