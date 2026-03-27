<?php

use Luizlins\Projeto01\Infraestrutura\Persistencia\FabricaConexao;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $pdo = FabricaConexao::criarConexao();

    // SQL para criar as tabelas
    $sql = "
        CREATE TABLE IF NOT EXISTS medicos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            crm TEXT NOT NULL,
            nome TEXT NOT NULL,
            especialidade TEXT NOT NULL
        );

        CREATE TABLE IF NOT EXISTS pacientes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            cpf TEXT NOT NULL UNIQUE,
            nome TEXT NOT NULL,
            telefone TEXT NOT NULL,
            dataNascimento TEXT NOT NULL
        );

        CREATE TABLE IF NOT EXISTS consultas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            medico_id INTEGER NOT NULL,
            paciente_id INTEGER NOT NULL,
            data_consulta TEXT NOT NULL,
            valor REAL NOT NULL,
            FOREIGN KEY (medico_id) REFERENCES medicos (id),
            FOREIGN KEY (paciente_id) REFERENCES pacientes (id)
        );
    ";

    $pdo->exec($sql);
    echo "[SUCESSO] Tabelas criadas ou já existentes no banco.sqlite!" . PHP_EOL;

} catch (PDOException $e) {
    echo "[ERRO] Falha ao criar tabelas: " . $e->getMessage() . PHP_EOL;
}