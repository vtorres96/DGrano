<?php session_start();  ?>

<?php

    if(!isset($_SESSION['usuario']) && (!isset($_SESSION['senha']))){	
        header("Location: menu.php");	
    }


    $secao_usuario = $_SESSION['usuario'];
     

    include_once("conexao.php");
    
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $result_cursos = "UPDATE cadastro SET nome = '$nome', email = '$email', usuario = '$usuario', senha = '$senha' WHERE id = '$id'";	
    $resultado_cursos = mysqli_query($conn, $result_cursos);
    
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
               
	</head>

	<body> <?php
        
                if(isset($_POST['menu'])){
        
                    if(mysqli_affected_rows($conn) != 0){
                        echo "
                            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/menu_cliente.php'>
                            <script type=\"text/javascript\">alert(\"Cadastro Alterado Com Sucesso.\");</script>
                        ";	
                    } else {
                        echo "
                            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/menu_cliente.php'>
                            <script type=\"text/javascript\">alert(\"Cadastro Salvo Sem Alterações.\");</script>
                        ";                       
                    }
                
		}
                
                if(isset($_POST['produtos'])){
        
                    if(mysqli_affected_rows($conn) != 0){
                        echo "
                            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/visualizar_produtos.php'>
                            <script type=\"text/javascript\">alert(\"Cadastro Alterado Com Sucesso.\");</script>
                        ";	
                    } else {
                        echo "
                            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/visualizar_produtos.php'>
                            <script type=\"text/javascript\">alert(\"Cadastro Salvo Sem Alterações.\");</script>
                        ";                       
                    }
                
		}
                
                if(isset($_POST['pedidos'])){
        
                    if(mysqli_affected_rows($conn) != 0){
                        echo "
                            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/visualizar_pedidos.php'>
                            <script type=\"text/javascript\">alert(\"Cadastro Alterado Com Sucesso.\");</script>
                        ";	
                    } else {
                        echo "
                            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/visualizar_pedidos.php'>
                            <script type=\"text/javascript\">alert(\"Cadastro Salvo Sem Alterações.\");</script>
                        ";                       
                    }
                
		}
                
                if(isset($_POST['contato'])){
        
                    if(mysqli_affected_rows($conn) != 0){
                        echo "
                            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/contato_cliente.php'>
                            <script type=\"text/javascript\">alert(\"Cadastro Alterado Com Sucesso.\");</script>
                        ";	
                    } else {
                        echo "
                            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/contato_cliente.php'>
                            <script type=\"text/javascript\">alert(\"Cadastro Salvo Sem Alterações.\");</script>
                        ";                       
                    }
                
		        }
                
                if(isset($_POST['finalizar'])){
        
                    if(mysqli_affected_rows($conn) != 0){
                        echo "
                            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/finalizar_pedido.php'>
                            <script type=\"text/javascript\">alert(\"Cadastro Alterado Com Sucesso.\");</script>
                        ";	
                    } else {
                        echo "
                            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/finalizar_pedido.php'>
                            <script type=\"text/javascript\">alert(\"Cadastro Salvo Sem Alterações.\");</script>
                        ";                       
                    }
                
		}
                
                ?>
	</body>
</html>
<?php $conn->close(); ?>