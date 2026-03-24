<?php

use Luizlins\Projeto01\Dominio\Modulos\Paciente;
use Luizlins\Projeto01\Infraestrutura\Persistencia\FabricaConexao;
use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioPaciente;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\CPF;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\Telefone;

require_once "vendor/autoload.php";

$pdo = FabricaConexao::criarConexao();

$cpf = new CPF("227.418.874-20");
$telefone = new Telefone("(88) 98454-5019");

$paciente = new Paciente(
    null, 
    $cpf,
    "Ana Julia",
    $telefone,
    "2006-04-21");

$pdoPaciente = new RepositorioPaciente();
$resposta = $pdoPaciente->inserir($paciente);

//Aviso de sucesso
if ($resposta){
    echo "Paciente inserido com sucesso! ID gerado: " . $paciente->recuperarId() . PHP_EOL;;
} else{
    echo "Erro" . PHP_EOL;
}
