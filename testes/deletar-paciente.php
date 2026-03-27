<?php

use Luizlins\Projeto01\Dominio\Modulos\Paciente;
use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioPaciente;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\CPF;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\Telefone;


require_once __DIR__ . '/../vendor/autoload.php';

$telefone = new Telefone("86999920976");
$cpf = new CPF("006 237 863 54");
$data = new DateTimeImmutable("2006-04-21");

$paciente = new Paciente(null, $cpf, "Antonio Carlos", $telefone,$data);

$pdoPaciente= new RepositorioPaciente();
$resposta = $pdoPaciente->deletar($paciente);

var_dump($resposta);