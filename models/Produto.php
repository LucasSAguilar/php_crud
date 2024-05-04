<?php

class Produto
{
    private int $id;
    private string $nome;
    private float $valor;
    private bool $disponivel;

    public function __construct(int $id, string $nome, float $valor, bool $disponivel)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->valor = $valor;
        $this->disponivel = $disponivel;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getdisponivel(): bool
    {
        return $this->disponivel;
    }
}