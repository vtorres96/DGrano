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

    if(isset($_POST['deletar'])){

        $id = $_POST['id'];

        $query = $pdo->prepare("DELETE FROM contato WHERE id = :id");
        $deletou = $query->execute([
            ":id" => $id
        ]);        
    }

    if(isset($_POST['alterar'])){

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        $query = $pdo->prepare("UPDATE cadastro SET nome = :nome , email = :email, senha = :senha WHERE usuario = :usuario");
        $alterou = $query->execute([
            ":usuario" => $secao_usuario,
            ":nome" => $nome,
            ":email" => $email,
            ":senha" => $senha
        ]);        
    }
    
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
    
    <?php if(isset($deletou) && $deletou === true): ?>
            <div class="alert alert-success">
                Mensagem excluída com sucesso
            </div>
    <?php endif; ?>

    <?php if(isset($alterou) && $alterou === true): ?>
            <div class="alert alert-success">
                Usuário alterado com sucesso
            </div>
    <?php endif; ?>

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
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $contato['id'] ?>">
                                <td><input type="submit" name="deletar" class="btn btn-xs btn-danger" value="Apagar" title="Apagar"></td>
                            </form>
                        </tr>

                        <div class="modal fade" id="myModal<?= $contato['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-center" id="myModalLabel">Mensagem de: <?= $contato['nome']; ?></h4>
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
                <form method="POST" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label class="control-label">Nome:</label>
                        <input name="nome" type="text" class="form-control" value="<?= $usuario["nome"]; ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Email:</label>
                        <input name="email" type="text" class="form-control" value="<?= $usuario["email"] ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Senha:</label>
                        <input name="senha" type="text" class="form-control" value="<?= $usuario["senha"] ?>">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" value="Alterar" name="alterar">Alterar</button>
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