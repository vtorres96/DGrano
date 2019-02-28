<?php

    require_once('config/conn.php');

    $id = $_GET['id'];

    $query = $pdo->prepare('SELECT conteudo, tipo FROM produtos WHERE id = :id');
    $query->execute([
        ":id" => $id
    ]);

    if ($query->execute()){

        $foto = $query->fetchObject();

        if ($foto != null){
            header('Content-Type: '. $foto->tipo);
            echo $foto->conteudo;
        }
    }
?>