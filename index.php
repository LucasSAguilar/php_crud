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

function getAllData($pdo)
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

function getOneData(PDO $pdo)
{
    $sqlQuery = "SELECT * FROM produtos WHERE id = 1";
    $statement = $pdo->query($sqlQuery);
    $productDatas = $statement->fetch(PDO::FETCH_ASSOC);

    if ($productDatas > 0) {
        $produtoEncontrado = new Produto($productDatas["id"], $productDatas["nome"], $productDatas["valor"], $productDatas["disponivel"]);
        echo var_dump($produtoEncontrado);
        echo "Seu produto de id " . $produtoEncontrado->getId() . " é o " . $produtoEncontrado->getNome();
    }

}


getOneData($pdo);