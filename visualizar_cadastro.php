<?php

    session_start();

    $secao_usuario = $_SESSION['usuario'];
    $nivel_acesso = $_SESSION['nivel_acesso'];

    if(!isset($secao_usuario) || $nivel_acesso != 1){
        header("Location: menu.php");
      }

    require_once("config/conn.php");

    $query = $pdo->prepare("SELECT * FROM cadastro WHERE usuario = :secao_usuario");
    $query->execute([
        ":secao_usuario" => $secao_usuario
    ]);

    $usuario = $query->fetch(PDO::FETCH_ASSOC);
    
    $query = $pdo->query("SELECT * FROM cadastro ORDER BY id");
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once("includes/head.php"); ?>

<body>

<?php 
    $active = "admin";
    require_once("includes/navbar.php"); 
?>

<div class="container">
    <h1>Visualize Usuários Cadastrados</h1>
    <br>
    <div class="form-group col-lg-8">
        <label>Lista de usuários que estão cadastrados no sistema.</label>
    </div>  
    <br><br>     
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>                                            
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Usuario</th>
                    <th>Senha</th>
                    <th>Nível Acesso</th>
                    <th>Alterar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($usuarios as $usuario): 
                ?>
                        <tr>
                            <td><?= $usuario['id']; ?></td>
                            <td><?= $usuario['nome']; ?></td>
                            <td><?= $usuario['email']; ?></td>
                            <td><?= $usuario['usuario']; ?></td>
                            <td><?= $usuario['senha']; ?></td>
                            <td><?= $usuario['nivel_acesso']; ?></td>
                            <td><button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="<?= $usuario['id']; ?>" data-whatevernome="<?= $usuario['nome']; ?>"  data-whateveremail="<?= $usuario['email']; ?>" data-whateverusuario="<?= $usuario['usuario']; ?>" data-whateversenha="<?= $usuario['senha']; ?>">Alterar Cadastro</button></td>
                        </tr>
                <?php 
                    endforeach; 
                ?>			
            </tbody>
        </table>
    </div>
</div>
<br><br><br><br><br><br><br><br>

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