<?php
	include_once("conexao.php");
	
	$id = $_GET['id'];
	
	$result = "DELETE FROM contato WHERE id = '$id'";
	$resultado = mysqli_query($conn, $result);	
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>

	<body> <?php
		if(mysqli_affected_rows($conn) != 0){
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/visualizar_contato.php'>
				<script type=\"text/javascript\">
					alert(\"Mensagem Apagada com Sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Oxxy/visualizar_contato.php'>
				<script type=\"text/javascript\">
					alert(\"Erro ao Apagar Mensagem.\");
				</script>
			";	
		}?>
	</body>
</html>
<?php $conn->close(); ?>