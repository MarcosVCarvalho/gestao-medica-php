<?php

$caminhoBanco = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$caminhoBanco");

$pdo->exec("
    CREATE TABLE IF NOT EXISTS consultas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        medico_id INTEGER NOT NULL,
        paciente_id INTEGER NOT NULL,
        data_consulta TEXT NOT NULL,
        valor REAL NOT NULL,
        FOREIGN KEY (medico_id) REFERENCES medicos (id),
        FOREIGN KEY (paciente_id) REFERENCES pacientes (id)
    );
");

echo "Tabela 'consultas' criada com sucesso!" . PHP_EOL;