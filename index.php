<?php

require_once ("./models/Produto.php");

$pdo = new PDO("sqlite:" . __DIR__ . "/db.sqlite");
$pdo->exec("CREATE TABLE IF NOT EXISTS produtos (id INTEGER PRIMARY KEY, nome TEXT, valor NUMBER, disponivel BOOLEAN)");

function postData($pdo)
{
    $produtoUm = new Produto("Peneira", 10.00, true);
    $sqlQuery = "INSERT INTO produtos (nome, valor, disponivel) VALUES ('{$produtoUm->getNome()}', '{$produtoUm->getValor()}', '{$produtoUm->getdisponivel()}')";
    $responsePost = $pdo->exec($sqlQuery);

    if ($responsePost > 0) {
        echo "Enviado com sucesso";
    }
}

function getData($pdo)
{
    $sqlQuery = "SELECT * FROM produtos";
    $responseGet = $pdo->query($sqlQuery);
    $dados = $responseGet->fetchAll();

    for ($i = 0; $i < count($dados); $i++) {
        echo $i . ": " . $dados[0]["nome"] . "\n";
    };

}
getData($pdo);