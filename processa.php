<?php
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
		if(mysqli_affected_rows($conn) != 0){
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/visualizar_cadastro.php'>
				<script type=\"text/javascript\">
					alert(\"Cadastro Alterado Com Sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/visualizar_cadastro.php'>
				<script type=\"text/javascript\">
					alert(\"Cadastro Salvo Sem Alterações.\");
				</script>
			";	
		}?>
	</body>
</html>
<?php $conn->close(); ?>