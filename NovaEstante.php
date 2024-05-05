<?php

require_once ("./models/Produto.php");
require_once ("./repository/ProductRepository.php");

class NovaEstante
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function gerarEstante()
    {
        try {
            $connection = $this->pdo;
            $produtoRepository = new ProductRepository($connection);
            $connection->beginTransaction();

            $produtoUm = new Produto(5, "TesteUm", 15.12, true);
            $produtoDois = new Produto(6, "TesteDois", 27.12, true);

            $produtoRepository->insertNew($produtoUm);
            $produtoRepository->insertNew($produtoDois);

            $connection->commit();
        } catch (PDOException $e) {
            echo $e->getMessage();
            $connection->rollback();
        }
    }

}