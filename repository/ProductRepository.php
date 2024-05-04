<?php

require_once (dirname(__FILE__) . "/../interfaces/ProductInterface.php");
require_once (dirname(__FILE__) . "/../models/Produto.php");

class ProductRepository implements ProductInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    function delete(int $id): bool
    {
        $statement = $this->pdo->prepare("DELETE FROM produtos WHERE id = ?");
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        return $statement->execute();
    }
    function getAll(): array
    {
        $statement = $this->pdo->query("SELECT * FROM produtos");
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $listaProdutos[] = new Produto($row["id"], $row["nome"], $row["valor"], $row["disponivel"]);
        }
        return $listaProdutos;
    }
    function getById(int $id): Produto | string
    {
        $statement = $this->pdo->prepare("SELECT * FROM produtos WHERE id = ?");
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
        $produto = $statement->fetch(PDO::FETCH_ASSOC);
        if ($produto > 0) {
            return new Produto($produto["id"], $produto["nome"], $produto["valor"], $produto["disponivel"]);
        }
        return "Nenhum aluno encontrado";

    }
    function insertNew(Produto $newProduct): bool
    {
        $statement = $this->pdo->prepare("INSERT INTO produtos (id, nome, valor, disponivel) VALUES (?, ?, ?, ?)");
        $statement->bindValue(1, $newProduct->getId(), PDO::PARAM_INT);
        $statement->bindValue(2, $newProduct->getNome(), PDO::PARAM_STR);
        $statement->bindValue(3, $newProduct->getValor(), PDO::PARAM_INT);
        $statement->bindValue(4, $newProduct->getDisponivel(), PDO::PARAM_BOOL);
        return $statement->execute();
    }


}