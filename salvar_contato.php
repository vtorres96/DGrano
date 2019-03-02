<?php
    // Incluindo arquivo de conexão
    require_once('config/conn.php');
    
    // Funções de utilidade
    require_once('funcs/util.php');

    $nome = $_POST['nome'];	
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    $query = $pdo->prepare('INSERT INTO contato (nome, email, mensagem) VALUES (:nome, :email, :mensagem)');
    $enviou = $query->execute([
        ":nome" => $nome,
        ":email" => $email,
        ":mensagem" => $mensagem
    ]);

    if(isset($enviou) && $enviou === true){
        echo retorno('Mensagem Enviada Com Sucesso', true);
    } else {
        echo retorno($enviou->errorInfo());
    }
    
?>
