<?php

require_once ("./models/Produto.php");

$pdo = new PDO("sqlite:" . __DIR__ . "/db.sqlite");
$pdo->exec("CREATE TABLE IF NOT EXISTS produtos (id INTEGER PRIMARY KEY, nome TEXT, valor NUMBER, disponivel BOOLEAN)");

function postData($pdo)
{
    $produtoUm = new Produto(2, "Laranja", 8.00, true);
    $sqlQuery = "INSERT INTO produtos (id, nome, valor, disponivel) VALUES ('{$produtoUm->getId()}','{$produtoUm->getNome()}', '{$produtoUm->getValor()}', '{$produtoUm->getdisponivel()}')";
    $responsePost = $pdo->exec($sqlQuery);

    if ($responsePost > 0) {
        echo "Enviado com sucesso";
    }
}



function getData($pdo)
{
    $sqlQuery = "SELECT * FROM produtos";
    $responseGet = $pdo->query($sqlQuery);
    $productDatas = $responseGet->fetchAll(PDO::FETCH_ASSOC);
    $productList = [];

    foreach ($productDatas as $produto) {
        $productList[] = new Produto($produto['id'], $produto['nome'], $produto['valor'], $produto['disponivel']);
    }

    echo var_dump($productList);
}
getData($pdo);