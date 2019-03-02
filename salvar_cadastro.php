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

    $query = $pdo->prepare("SELECT * FROM cadastro WHERE usuario = :usuario");
    $query->execute([
        ":usuario" => $usuario
    ]);

    $cadastrado = $query->fetch(PDO::FETCH_ASSOC);

    if ($cadastrado) {
        echo retorno('Login Já Existente', true);
    } else {

        $query = $pdo->prepare('INSERT INTO cadastro (nome, email, usuario, senha, nivel_acesso) VALUES (:nome, :email, :usuario, :senha, :nivel_acesso)');
        $salvou = $query->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':usuario' => $usuario,
            ':senha' => $senha,
            ':nivel_acesso' => $nivel_acesso
        ]);

        if(isset($salvou) && $salvou === true){
            echo retorno('Usuário Cadastrado com Sucesso', true);
        } else {
            echo retorno($salvou->errorInfo());
        }
    }

?>
