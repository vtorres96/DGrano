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
    
    $query = $pdo->query("SELECT * FROM contato ORDER BY id DESC");
    $contatos = $query->fetchAll(PDO::FETCH_ASSOC);
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
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Mensagem</th>
                    <th>Visualizar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($contatos as $contato): 
                ?>
                        <tr>
                            <td><?= $contato['nome']; ?></td>
                            <td><?= $contato['email']; ?></td>
                            <td><?= $contato['mensagem']; ?></td>
                            <td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal<?= $contato['id']; ?>">Visualizar</button></td>
                            <td><a href="processa_apagar.php?id=<?php echo $contato['id']; ?>"><button type="button" class="btn btn-xs btn-danger">Apagar</button></a></td>
                        </tr>

                        <div class="modal fade" id="myModal<?= $contato['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-center" id="myModalLabel">Mensagem de: <?php echo $row['nome']; ?></h4>
                                    </div>
                                    <div class="modal-body">                                                                   
                                        <p>Nome: <?= $contato['nome']; ?></p><br>
                                        <p>Email: <?= $contato['email']; ?></p><br>
                                        <p>Mensagem: <b><?= $contato['mensagem']; ?></b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
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