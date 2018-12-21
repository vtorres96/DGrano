<?php
    // Incluindo arquivo de conexão
    require_once('config/conn.php');

    // Funções de utilidade
    require_once('funcs/util.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $nivel_acesso = 0;

    $resulta = $pdo->query("SELECT * FROM cadastro WHERE usuario = '$usuario'");

    if ($resulta->rowCount()) {
        echo ($resulta->execute()) ? retorno('Login Já Existente', true) : retorno($resulta->errorInfo());
    } else {

        $stmt = $pdo->prepare('INSERT INTO cadastro (nome, email, usuario, senha, nivel_acesso) VALUES (:nome, :email, :usuario, :senha, :nivel_acesso)');

        // Definindo parâmetros
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':nivel_acesso', $nivel_acesso, PDO::PARAM_INT);

        // Executando e exibindo resultado
        echo ($stmt->execute()) ? retorno('Usuário Cadastrado com Sucesso', true) : retorno($stmt->errorInfo());

    }

?>
