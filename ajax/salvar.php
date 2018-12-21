<?php
// Incluindo arquivo de conexão
require_once('../config/conn.php');

// Funções de utilidade
require_once('../funcs/util.php');

// Constantes
define('TAMANHO_MAXIMO', (2 * 1024 * 1024));

// Verificando se selecionou alguma imagem
if (!isset($_FILES['foto'])){
    echo retorno('Selecione um produto');
    exit;
}

// Recupera os dados dos campos
$foto = $_FILES['foto'];
$nome = $foto['name'];
$tipo = $foto['type'];
$tamanho = $foto['size'];
$codigo = $_POST['codigo'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];

// Validações básicas
// Formato
if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo))
{
    echo retorno('Isso não é uma imagem válida');
    exit;
}

// Tamanho
if ($tamanho > TAMANHO_MAXIMO)
{
    echo retorno('A imagem deve possuir no máximo 2 MB');
    exit;
}

// Transformando foto em dados (binário)
$conteudo = file_get_contents($foto['tmp_name']);

// Preparando comando
$stmt = $pdo->prepare('INSERT INTO produtos (nome, conteudo, tipo, tamanho, codigo, descricao, preco) VALUES (:nome, :conteudo, :tipo, :tamanho, :codigo, :descricao, :preco)');

// Definindo parâmetros
$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$stmt->bindParam(':conteudo', $conteudo, PDO::PARAM_LOB);
$stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
$stmt->bindParam(':tamanho', $tamanho, PDO::PARAM_INT);
$stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
$stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
$stmt->bindParam(':preco', $preco, PDO::PARAM_INT);

// Executando e exibindo resultado
echo ($stmt->execute()) ? retorno('Produto Cadastrado Com Sucesso', true) : retorno($stmt->errorInfo());