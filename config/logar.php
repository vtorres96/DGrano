<script>
    function redirect_admin(){
        setTimeout("window.location = 'menu_admin.php';",0.500);
    }
    function redirect_cliente(){
        setTimeout("window.location = 'menu_cliente.php';",0.500);
    }
    function erroLogin(){
        $(document).ready(function() { 
            window.location.href='#Restrito';
        });
    }
</script>

<?php

    include ("conexao.php");

    if(isset($_REQUEST['logar'])){

    $usuario = $_REQUEST['usuario'];
    $senha   = $_REQUEST['senha'];
    $nivel_acesso = 1;

    $valida = "SELECT * FROM cadastro WHERE usuario = '$usuario' AND senha = '$senha'";
    $valida_senha = $conn->query($valida);

    $logado = "SELECT * FROM cadastro WHERE usuario = '$usuario' AND senha = '$senha' AND nivel_acesso = $nivel_acesso";
    $redireciona_logado = $conn->query($logado);

        if($valida_senha->num_rows == 0){
            echo "<script>erroLogin()</script>";
            echo '<p style="color:red;">Senha errada</p>';
        } else if ($redireciona_logado->num_rows > 0){
            $_SESSION['usuario'] = $usuario;
            $_SESSION['nivel_acesso'] = $nivel_acesso;
            echo "<script>redirect_admin()</script>";
        } else {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['nivel_acesso'] = $nivel_acesso;
            echo "<script>redirect_cliente()</script>";
        }
    }
?>
