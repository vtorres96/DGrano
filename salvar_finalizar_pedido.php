<?php   include("conexao.php");  ?>

<script>
    function redirectPedido(){
        setTimeout("window.location = 'visualizar_pedidos.php';",100);
    }
</script>

<?php

	if (isset($_POST['finalizar'])){
                   
                $id = $_POST['id'];
                $cliente = $_POST['cliente'];
                $codigo = array_filter($_REQUEST['codigo']);
                $descricao = $_REQUEST['descricao'];
                $preco = $_REQUEST['preco_venda'];	
                $quantidade = $_REQUEST['quantidade'];
                $custo_total = $_REQUEST['custo_total'];
                $status = $_REQUEST['status'];
                
                $sql = "SELECT * FROM pedido WHERE cliente = '$cliente'"; 
                $resulta = $conn->query($sql);
                $row = $resulta->fetch_assoc();  
                
                for($i = 0; $i<count($codigo)AND($_REQUEST['descricao']); $i++)  {
                
                    if($resulta->num_rows > $i){
                        $result = "UPDATE pedido set quantidade = '$quantidade[$i]', custo_total = '$custo_total[$i]', status = '$status[$i]' WHERE cliente = '$cliente' AND id = '$id[$i]' ";
                    } else {
                        $result = "INSERT INTO pedido (cliente, data_venda, codigo, descricao, preco_venda, quantidade, custo_total, status) VALUES ('$cliente[$i]', NOW(), '$codigo[$i]', '$descricao[$i]', '$preco[$i]', '$quantidade[$i]', '$custo_total[$i]', '$status[$i]')";
                    }
                
                    $resultado = mysqli_query($conn, $result);          
                    
                }
				
		echo "<script>redirectPedido()</script>";
	}
	
?>