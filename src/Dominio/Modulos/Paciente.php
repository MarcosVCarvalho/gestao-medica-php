<?php

namespace Luizlins\Projeto01\Dominio\Modulos;

use DateTimeImmutable;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\Telefone;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\CPF;

class Paciente {

    function __construct(
        private ?int $id,
        private CPF $cpf,
        private string $nome,
        private Telefone $telefone,
        private DateTimeImmutable $dataNascimento
    ) {}

    //Getters
    public function recuperarId(): ?int {
        return $this->id;
    }
    public function recuperarNome(): string
    {
        return $this->nome;
    }
    public function recuperarCpf(): CPF
    {
        return $this->cpf;
    }
    public function recuperarTelefone(): Telefone
    {
        return $this->telefone;
    }
    public function recuperarDataNascimento(): DateTimeImmutable
    {
        return $this->dataNascimento;
    }
    
    //Setters
    public function definirId(int $id){
        $this->id = $id;
    }

}