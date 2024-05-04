<?php

class Produto
{
    private string $nome;
    private float $valor;
    private bool $disponivel;

    public function __construct(string $nome, float $valor, bool $disponivel)
    {
        $this->nome = $nome;
        $this->valor = $valor;
        $this->disponivel = $disponivel;
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