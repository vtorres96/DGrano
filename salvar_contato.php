<?php
    // Incluindo arquivo de conexão
    require_once('config/conn.php');
    
    // Funções de utilidade
    require_once('funcs/util.php');

    $nome = $_POST['nome'];	
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Preparando comando
    $stmt = $pdo->prepare('INSERT INTO contato (nome, email, mensagem) VALUES (:nome, :email, :mensagem)');

    // Definindo parâmetros
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':mensagem', $mensagem, PDO::PARAM_STR);

    // Executando e exibindo resultado
    echo ($stmt->execute()) ? retorno('Mensagem Enviada Com Sucesso', true) : retorno($stmt->errorInfo());

?>
