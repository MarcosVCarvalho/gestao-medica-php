<?php

$caminhoBanco = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$caminhoBanco");

$pdo->exec("
    CREATE TABLE pacientes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        cpf TEXT,
        nome TEXT,
        telefone TEXT,
        dataNascimento TEXT
    );
");
