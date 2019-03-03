<?php require_once("config/conn.php"); ?>

<?php if($active == "comum"): ?>
    <nav class="main-nav-outer" id="test">
        <div class="container">
            <ul class="main-nav">
                <li><a href="#Produtos">&nbsp;</a></li>
                <li><a href="#Software" class="active">Home</a></li>
                <li><a href="#Produtos">A D'Grano</a></li>
                <li class="small-logo"><a href="#Software"><img src="img/d-grano.png" style="width:60px;" alt=""></a></li>
                <li><a href="#Contato">Contato</a></li>
                <li><a href="#Cadastro">Acesso</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
            <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
        </div>
    </nav>
<?php endif; ?>

<?php if($active == "admin"): ?>
<nav class="main-nav-outer" id="test">
	<div class="container">
        <ul class="main-nav">
            <li><a href="visualizar_cadastro.php">Visualizar Usuários</a></li>
            <li><a href="visualizar_contato.php">Visualizar Mensagens</a></li>
            <li class="small-logo"><a href="menu_admin.php"><img src="img/d-grano.png" style="width:60px;" alt=""></a></li>
            <li><a href="cadastro_produtos.php">Cadastrar Produtos</a></li>
            <li><a href="logoff.php">Sair</a></li>
            <li>
                <a href="" title="Alterar Cadastro" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa-user"></i> Administrador: <?= $secao_usuario; ?>
                </a>
            </li>
        </ul>
        <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
    </div>
</nav>
<?php endif; ?>

<?php if($active == "cliente"): ?>
    <nav class="main-nav-outer" id="test">
        <div class="container">
            <ul class="main-nav">
                <li><a href="contato_cliente.php">Enviar Mensagem</a></li>
                <li><a href="visualizar_produtos.php">Visualizar Produtos</a></li>
                <li class="small-logo"><a href="menu_cliente.php"><img src="img/d-grano.png" style="width:60px;" alt=""></a></li>
                <li><a href="visualizar_pedidos.php">Visualizar Pedidos</a></li>
                <li><a href="logoff.php">Sair</a></li>
                <li><a href="">    </a></li>
                <li>
                    <a href="" title="Alterar Cadastro" data-toggle="modal" data-target="#exampleModal" data-whatever="<?= $usuario['id']; ?>" data-whatevernome="<?= $usuario['nome']; ?>"  data-whateveremail="<?= $usuario['email']; ?>" data-whateverusuario="<?= $usuario['usuario']; ?>" data-whateversenha="<?= $usuario['senha']; ?>">
                        <i class="fa-user"></i> Cliente: <?php  echo $secao_usuario; ?>
                    </a>
                </li>
            </ul>
            <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
        </div>
    </nav>
<?php endif; ?>