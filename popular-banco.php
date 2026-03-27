<?php

use Luizlins\Projeto01\Dominio\Modulos\Medico;
use Luizlins\Projeto01\Dominio\Modulos\Paciente;
use Luizlins\Projeto01\Dominio\Modulos\Consulta;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\CPF;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\Telefone;
use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioMedico;
use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioPaciente;
use Luizlins\Projeto01\Infraestrutura\Repositorios\RepositorioConsulta;

require_once "vendor/autoload.php";

// Instanciando os repositórios
$repoMedico = new RepositorioMedico();
$repoPaciente = new RepositorioPaciente();
$repoConsulta = new RepositorioConsulta();

echo "--- INICIANDO POPULAÇÃO DO BANCO DE DADOS ---" . PHP_EOL;

// 1. criando 3 Medicos 
$medicos = [
    new Medico(null, "CRM/CE 1111", "Dr. Marcos Vinicius", "Clínico Geral"),
    new Medico(null, "CRM/CE 2222", "Dra. Ana Julia", "Pediatra"),
    new Medico(null, "CRM/CE 3333", "Dr. Julio Balestrin", "Ortopedista")
];

foreach ($medicos as $m) {
    $repoMedico->inserir($m);
    echo "[OK] Médico inserido: {$m->recuperarNome()} (ID: {$m->recuperarId()})" . PHP_EOL;
}

// 2. criando 3 pacientes
$pacientes = [
    new Paciente(null, new CPF("111.111.111-11"), "Carlos Alberto", new Telefone("(88) 91111-1111"), new DateTimeImmutable("1990-01-01")),
    new Paciente(null, new CPF("222.222.222-22"), "Maria Oliveira", new Telefone("(88) 92222-2222"), new DateTimeImmutable("1985-05-15")),
    new Paciente(null, new CPF("333.333.333-33"), "José Santos", new Telefone("(88) 93333-3333"), new DateTimeImmutable("2000-10-20"))
];

foreach ($pacientes as $p) {
    $repoPaciente->inserir($p);
    echo "[OK] Paciente inserido: {$p->recuperarNome()} (ID: {$p->recuperarId()})" . PHP_EOL;
}

// 3. criando 3 consultas
$consultas = [
    new Consulta(null, $medicos[0], $pacientes[0], new DateTimeImmutable("2026-04-01 14:00"), 150.00),
    new Consulta(null, $medicos[1], $pacientes[1], new DateTimeImmutable("2026-04-02 15:30"), 200.00),
    new Consulta(null, $medicos[2], $pacientes[2], new DateTimeImmutable("2026-04-03 09:00"), 180.00)
];

foreach ($consultas as $c) {
    if ($repoConsulta->inserir($c)) {
        echo "[OK] Consulta agendada: Médico {$c->recuperarMedico()->recuperarNome()} + Paciente {$c->recuperarPaciente()->recuperarNome()} (ID: {$c->recuperarId()})" . PHP_EOL;
    }
}

echo "--- TESTE CONCLUÍDO COM SUCESSO ---" . PHP_EOL;