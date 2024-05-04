<?php

require_once ("./models/Produto.php");

$pdo = new PDO("sqlite:" . __DIR__ . "/db.sqlite");
$pdo->exec("CREATE TABLE IF NOT EXISTS produtos (id INTEGER PRIMARY KEY, nome TEXT, valor NUMBER, disponivel BOOLEAN)");

function postData(PDO $pdo)
{
    $produtoUm = new Produto(3, "Pera", 14.00, false);
    $sqlQuery = "INSERT INTO produtos (id, nome, valor, disponivel) VALUES (?, ?, ?, ?)";
    // Também pode ser feito nomeando os placeholders: 
    // $sqlQuery = "INSERT INTO produtos (id, nome, valor, disponivel) VALUES (:id, :nome, :valor, :disponivel)";

    // $statement->bindValue(":id", $produtoUm->getId(), PDO::PARAM_INT);

    $statement = $pdo->prepare($sqlQuery);


    $statement->bindValue(1, $produtoUm->getId(), PDO::PARAM_INT);
    $statement->bindValue(2, $produtoUm->getNome(), PDO::PARAM_STR);
    $statement->bindValue(3, $produtoUm->getValor(), PDO::PARAM_INT);
    $statement->bindValue(4, $produtoUm->getDisponivel(), PDO::PARAM_BOOL);

    if ($statement->execute()) {
        echo "Enviado com sucesso";
    }
}

function getAllData(PDO $pdo)
{
    $sqlQuery = "SELECT * FROM produtos";
    $statment = $pdo->query($sqlQuery);
    $productDatas = $statment->fetchAll(PDO::FETCH_ASSOC);
    $productList = [];

    foreach ($productDatas as $produto) {
        $productList[] = new Produto($produto['id'], $produto['nome'], $produto['valor'], $produto['disponivel']);
    }

    echo var_dump($productList);
}

function getOneData(PDO $pdo)
{
    $sqlQuery = "SELECT * FROM produtos WHERE id = 3";
    $statement = $pdo->query($sqlQuery);
    $productDatas = $statement->fetch(PDO::FETCH_ASSOC);

    if ($productDatas > 0) {
        $produtoEncontrado = new Produto($productDatas["id"], $productDatas["nome"], $productDatas["valor"], $productDatas["disponivel"]);
        echo var_dump($produtoEncontrado);
        echo "Seu produto de id " . $produtoEncontrado->getId() . " é o " . $produtoEncontrado->getNome();
    }

}

function deleteOneData(PDO $pdo, int $id)
{
    $statement = $pdo->prepare("DELETE FROM produtos WHERE id = :id");
    $statement->bindValue(":id", $id, PDO::PARAM_INT);
    if ($statement->execute()) {
        echo "Produto deletado com sucesso!";
    }
}

getAllData($pdo);
deleteOneData($pdo, 2);
getAllData($pdo);
