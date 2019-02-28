<?php

    require_once('config/conn.php');

    $id = $_GET['id'];


    $stmt = $pdo->prepare('SELECT conteudo, tipo FROM produtos WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);


    if ($stmt->execute()){

        $foto = $stmt->fetchObject();

        if ($foto != null){
            header('Content-Type: '. $foto->tipo);
            echo $foto->conteudo;
        }
    }
?>