<?php

use Luizlins\Projeto01\Dominio\Modulos\Medico;
use Luizlins\Projeto01\Dominio\Modulos\Paciente;
use Luizlins\Projeto01\Dominio\Modulos\Consulta;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\CPF;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\Telefone;
use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioMedico;
use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioPaciente;
use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioConsulta;

require_once __DIR__ . '/../vendor/autoload.php';

//criando medico
$medico = new Medico(null, "CRM/PI 1234", "Marcos Vinicius", "Clinico Geral");
$pdoMedico = new RepositorioMedico();
$resposta = $pdoMedico->inserir($medico);

//criando paciente
$cpf = new CPF("227.418.874-20");
$telefone = new Telefone("(88) 98454-5019");
$data = new DateTimeImmutable("2006-04-21");

$paciente = new Paciente(
    null, 
    $cpf,
    "Ana Julia",
    $telefone,
    $data);

$pdoPaciente = new RepositorioPaciente();
$resposta = $pdoPaciente->inserir($paciente);

//criando consulta
$valor = (float) 30.00;
$dataconsulta = new DateTimeImmutable("2026-03-21");

$consulta = new Consulta(
    null,
    $medico,
    $paciente,
    $dataconsulta,
    $valor,
);
$pdoConsulta = new RepositorioConsulta();
$resposta = $pdoConsulta->inserir($consulta);

//Aviso de sucesso
if ($resposta){
    echo "Consulta inserida com sucesso! ID gerado: " . $consulta->recuperarId() . PHP_EOL;

} else{
    echo "Erro" . PHP_EOL;
}