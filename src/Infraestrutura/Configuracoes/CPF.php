<?php

namespace Luizlins\Projeto01\Infraestrutura\Configuracoes;
use Exception;
class CPF
{
    public function __construct(private string $cpf){

        $digitos = preg_replace('/\D/', '', $cpf);

        if(strlen($digitos) != 11){
            throw new Exception("Formato de CPF inválido");
    }
        $this->cpf = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/' , '$1.$2.$3-$4', $digitos);
    }

    //função para recuperar como String
    public function recuperarNumero(): string
    {
        return $this->cpf;
    }
}