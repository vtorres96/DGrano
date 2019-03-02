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

    $query = $pdo->prepare("SELECT * FROM pedido WHERE cliente = :cliente AND codigo = :codigo AND descricao = :descricao AND status = :status ");
    $query->execute([
        ":cliente" => $cliente,
        ":codigo" => $codigo,
        ":descricao" => $descricao,
        ":status" => ' '
    ]);

    $pedidos = $query->fetchAll(PDO::FETCH_ASSOC);

    if(!$pedidos){

        $query = $pdo->prepare("INSERT INTO pedido (cliente, data_venda, codigo, descricao, preco_venda, status) VALUES (:cliente, :data_venda, :codigo, :descricao, :preco, :status)");

        $salvou = $query->execute([
            ':cliente' => $cliente,
            ':data_venda' => $data_venda,
            ':codigo' => $codigo,
            ':descricao' => $descricao,
            ':preco' => $preco,
            ':status' => $status
        ]);

        if(isset($salvou) && $salvou === true){
            echo retorno('Produto: ' . $descricao . ' adicionado', true);
        } else {
            echo retorno($salvou->errorInfo());
        }
    }

?>