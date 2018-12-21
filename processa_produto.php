<?php
	include_once("conexao.php");
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$codigo = mysqli_real_escape_string($conn, $_POST['codigo']);
	$descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
        $preco = mysqli_real_escape_string($conn, $_POST['preco']);
	
	$result_cursos = "UPDATE produtos SET codigo = '$codigo', descricao = '$descricao', preco = '$preco' WHERE id = '$id'";	
	$resultado_cursos = mysqli_query($conn, $result_cursos);	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>

	<body> 
                <?php
        
                    if(mysqli_affected_rows($conn) != 0){
                        echo "
                            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/cadastro_produtos.php'>
                            <script type=\"text/javascript\">alert(\"Cadastro Alterado Com Sucesso.\");</script>
                        ";	
                    } else {
                        echo "
                            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/cadastro_produtos.php'>
                            <script type=\"text/javascript\">alert(\"Erro ao Alterar Cadastro.\");</script>
                        ";	
                    } 
                
                ?>
	</body>
</html>
<?php $conn->close(); ?>