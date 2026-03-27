<?php

namespace Luizlins\Projeto01\Dominio\Modulos;

use Luizlins\Projeto01\Dominio\Modulos\Medico;
use Luizlins\Projeto01\Dominio\Modulos\Paciente;
use DateTimeImmutable;

class Consulta {

    function __construct(
        private ?int $id,
        private Medico $medico,
        private Paciente $paciente,
        private DateTimeImmutable $data,
        private float $valor
    ) {}

    //Getters
    public function recuperarId(): int {
        return $this->id;
    }
    public function recuperarMedico(): Medico 
    {
        return $this->medico;
    }
    public function recuperarPaciente(): Paciente
    {
        return $this->paciente;
    }
    public function recuperarData(): DateTimeImmutable
    {
        return $this->data;
    }
    public function recuperarValor(): float
    {
        return $this->valor;
    }

    //setter
    public function definirId(int $id){
        $this->id = $id;
    }

}