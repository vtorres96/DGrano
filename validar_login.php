<?php include("conexao.php"); ?>

<script>
    function redirect(){
        setTimeout("window.location = 'menu.php';",0.500);
    }
</script>

<?php

	if (isset($_REQUEST['logar'])){
		
		$usuario = $_REQUEST['usuario'];	
		$senha = $_REQUEST['senha'];
		
		$resultx  = "SELECT * FROM Cadastro WHERE usuario = '$usuario' AND senha = '$senha' ";
		$resultando = $conn->query($resultx);
		$rowC = mysqli_num_rows($resultando);
		
		if ($rowC <= 0){
			
                    echo "<script>redirect()</script>";
                    echo "<script>alert('Usuário ou Senha incorretos, você será redirecionado ao topo da página!');</script>";
				
		} else { 

                    $resulty = "SELECT usuario, senha FROM Cadastro WHERE usuario = '$usuario' AND senha = '$senha' AND nivel_acesso = 1";
                    $resulta = $conn->query($resulty);
                    $row = $resulta->fetch_assoc();
				
                    if ($resulta->num_rows > 0) {
                        $_SESSION['usuario'] = $usuario;
                        $_SESSION['senha']   = $senha;		
                        header("Location: menu_admin.php");
                    } else {
                        $_SESSION['usuario'] = $usuario;
                        $_SESSION['senha']   = $senha;		
                        header("Location: menu_cliente.php");
                    }
			
		} 
	
	}
?>