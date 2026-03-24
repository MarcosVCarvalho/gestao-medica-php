<?php

use Luizlins\Projeto01\Dominio\Modulos\Medico;
use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioMedico;

require_once "vendor/autoload.php";

$medico = new Medico(5, "CRM/PI 1234", "Marcos Vinicius", "Clinico Geral");

$pdoMedico = new RepositorioMedico();
$resposta = $pdoMedico->inserir($medico);

var_dump($resposta);