<?php

require_once ("./models/Produto.php");
require_once ("./repository/ProductRepository.php");
require_once ("./NovaEstante.php");


$pdo = new PDO("sqlite:" . __DIR__ . "/db.sqlite");
$produtoRepository = new ProductRepository($pdo);

$estante = new NovaEstante($pdo);
$estante->gerarEstante();

$produtoRepository->getAll();

echo var_dump($produtoRepository->getAll());