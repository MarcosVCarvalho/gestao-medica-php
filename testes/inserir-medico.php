<?php

use Luizlins\Projeto01\Dominio\Modulos\Medico;
use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioMedico;


require_once __DIR__ . '/../vendor/autoload.php';

$medico = new Medico(null, "CRM/PI 456","Romario", "cardiologista");

$pdoMedico = new RepositorioMedico();
$resposta = $pdoMedico->inserir($medico);

//Aviso de sucesso
if ($resposta) {
    echo "Médico inserido com ID: " . $medico->recuperarId() . PHP_EOL;
} else {
    echo "Erro ao inserir!";
}

var_dump($resposta);        