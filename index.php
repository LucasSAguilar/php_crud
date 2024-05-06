<?php

require_once ("./models/Produto.php");
require_once ("./repository/ProductRepository.php");
require_once ("./NovaEstante.php");


//$pdo = new PDO("sqlite:" . __DIR__ . "/db.sqlite");
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$produtoRepository = new ProductRepository($pdo);
//$estante = new NovaEstante($pdo);


$rota = $_SERVER['REQUEST_URI'];

// Verifica a rota e inclui a view correspondente
switch ($rota) {
    case '/mostrarPessoa':
        $produto_nome = "Teste";
        require_once("./views/mostrarPessoa.php");
        break;
    case '/mostrarOla':
        require_once("./views/mostrarOla.php");
        break;
    // Adicione mais rotas conforme necessário
    default:
        echo "Rota não encontrada";
        break;
}