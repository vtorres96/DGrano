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

    if(isset($_POST['alterar'])){

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
    
    $query = $pdo->prepare("SELECT * FROM pedido WHERE status = :fin AND cliente = :secao_usuario ORDER BY id DESC");
    $query->execute([
        ":fin" => "FIN",
        ":secao_usuario" => $secao_usuario
    ]);

    $pedidos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once("includes/head.php"); ?>

<body>

<?php 
    $active = "cliente";
    require_once("includes/navbar.php"); 
?>
<div class="container">			
    <h1>Visualize seus pedidos</h1>
    <br>
    <div class="form-group col-lg-8">
        <p>Estão listados abaixo somente pedidos que foram finalizados.</p>
    </div>  
    <br><br>     

    <?php if(isset($alterou) && $alterou === true): ?>
        <div class="alert alert-success">
            Usuário alterado com sucesso
        </div>
    <?php endif; ?>
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>                                            
                    <th>Cliente</th>
                    <th>Data Venda</th>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Valor Pago</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($pedidos as $pedido): 
                ?>
                        <tr>
                            <td><?= $pedido['cliente'] ?></td>
                            <td><?= date('d-m-Y', strtotime($pedido["data_venda"])) ?></td>
                            <td><?= $pedido['descricao'] ?></td>
                            <td>R$  <?= $pedido['preco_venda'] ?></td>
                            <td><?= $pedido['quantidade'] ?></td>
                            <td>R$  <?= $pedido['custo_total'] ?></td>
                            <td><?= $pedido['status'] ?></td>
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