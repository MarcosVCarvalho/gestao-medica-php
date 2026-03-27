<?php

use Luizlins\Projeto01\Dominio\Modulos\Paciente;
use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioPaciente;

require_once __DIR__ . '/../vendor/autoload.php';

$pdoPaciente = new RepositorioPaciente();
$resposta = $pdoPaciente->listar();

var_dump($resposta);