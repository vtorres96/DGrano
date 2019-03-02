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

    $query = $pdo->query("SELECT id, codigo, descricao, preco FROM produtos");
?>

<?php require_once("includes/head.php"); ?>

<body>

<?php 
$active = "cliente";
require_once("includes/navbar.php"); 
?>
<div class="container">
<h1>Efetue Seu Pedido</h1>	
<br><br>     
        
<div class="col-lg-9">
    <label for="ex1">Pesquisar</label>
    <input type="text" class="form-control" style="text-transform:uppercase" maxlength="20" id='descri' name="descri"><br><!-- Input Descrição -->
    <!--<div id="descriList"></div>-->
</div>

<div class="col-lg-3">
    <a href="finalizar_pedido.php" class="btn btn-success" style="margin-top:25px;">Visualizar Pedido</a>
</div>
<br><br><br><br>
<div class="row">
    <?php while ($produtos = $query->fetchObject()): ?>
        <form method="POST" action="salvar_pedido.php" class="formulario">
            <div id="mensagem"></div>
            
            <input type="hidden" name="cliente" value="<?= $secao_usuario; ?>">
            <div class="col-lg-4">
                <img style="width:75%;" src="imagem.php?id=<?= $produtos->id ?>" />
                <div class="caption">
                    <input type="hidden" name="id" value="<?= $produtos->id ?>"> <br>
                    <input type="hidden" name="codigo" value="<?= $produtos->codigo ?>"> <br>
                    <strong>Descrição:</strong> <?= $produtos->descricao ?> <input type="hidden" name="descricao" value="<?= $produtos->descricao ?>">  <br>
                    <strong>Preço: </strong>  R$ <strong style="font-size:25px;"><?= number_format($produtos->preco,2) ?></strong> <input type="hidden" name="preco" value="<?= $produtos->preco ?>"> <br><br>
                    <input type="hidden" name="status" value="">
                    <input type="submit" class="btn btn-primary" id="salvar" value="Adicionar ao Pedido" data-loading-text="Adicionando..." >
                </div>
                <br><br><br><br><br>
            </div>
        </form>
    <?php endwhile; ?>
</div>
</div>
<br><br>  

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
<script type="text/javascript" src="ajax/valida_carrinho.js"></script>
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