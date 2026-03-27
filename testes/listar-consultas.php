<?php

use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioConsulta;

require_once __DIR__ . '/../vendor/autoload.php';

$pdoConsulta = new RepositorioConsulta();
$resposta = $pdoConsulta->listar();

var_dump($resposta);