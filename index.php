<?php

use Luizlins\Projeto01\Dominio\Modulos\Medico;
use Luizlins\Projeto01\Dominio\Modulos\Paciente;
use Luizlins\Projeto01\Dominio\Modulos\Consulta;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\CPF;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\Telefone;

require_once "./vendor/autoload.php";

$medico = new Medico(
    null,
    "CRM/PI 24546",
    "Luiz Lins",
    "Oftomologista"
);

$telefone = new Telefone("86999920976");
$cpf = new CPF("006 237 863 54");
$data = new DateTimeImmutable("2006-04-21");

$paciente = new Paciente(
    null,
    $cpf,
    "Maria Antonia",
    $telefone,
    $data
);

$dataConsulta = new DateTimeImmutable("2026-03-01 13:00"); 
$consulta = new Consulta(
    $medico,
    $paciente,
    $dataConsulta,
    400.00
);

var_dump($consulta);