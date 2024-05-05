<?php

require_once ("./models/Produto.php");
require_once ("./repository/ProductRepository.php");
require_once ("./NovaEstante.php");


$pdo = new PDO("sqlite:" . __DIR__ . "/db.sqlite");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$produtoRepository = new ProductRepository($pdo);

$estante = new NovaEstante($pdo);
$estante->gerarEstante();

