<?php

use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioPaciente;

require_once __DIR__ . '/../vendor/autoload.php';

$pdoPaciente = new RepositorioPaciente();
$resposta = $pdoPaciente->recuperar(1);

var_dump($resposta);