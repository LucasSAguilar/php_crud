<?php

require_once ("./models/Produto.php");
require_once ("./repository/ProductRepository.php");
require_once ("./interfaces/ProductInterface.php");


$pdo = new PDO("sqlite:" . __DIR__ . "/db.sqlite");
$produtoRepository = new ProductRepository($pdo);
$produtoQuatro = new Produto(4, "Cebola", 20.00, false);


echo var_dump($produtoRepository->getAll());