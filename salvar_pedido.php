<?php

    // Incluindo arquivo de conexão
    require_once('config/conn.php');
    
    // Funções de utilidade
    require_once('funcs/util.php');
   
        
    $id = $_POST['id'];
    $cliente = $_POST['cliente'];
    $data_venda = date('Y-m-d');
    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $status = $_POST['status'];

    $resulta = $pdo->query("SELECT * FROM pedido WHERE cliente = '$cliente' AND codigo = '$codigo' AND descricao = '$descricao' AND status = '' ");

    if ($resulta->rowCount()) {
        echo ($stmt->execute()) ? retorno('Este Produto Já Foi Adicionado.', true) : retorno($stmt->errorInfo());
    } else {

        // Preparando comando
        $stmt = $pdo->prepare("INSERT INTO pedido (cliente, data_venda, codigo, descricao, preco_venda, status) VALUES (:cliente, :data_venda, :codigo, :descricao, :preco, :status)");

        // Definindo parâmetros
        $stmt->bindParam(':cliente', $cliente, PDO::PARAM_STR);
        $stmt->bindParam(':data_venda', $data_venda, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);

        // Executando e exibindo resultado
        echo ($stmt->execute()) ? retorno('Produto: '.$descricao.' Adicionado.', true) : retorno($stmt->errorInfo());

    }

?>