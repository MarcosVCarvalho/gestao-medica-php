<?php

$caminhoBanco = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$caminhoBanco");

$pdo->exec("
    CREATE TABLE pacientes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        cpf TEXT NOT NULL,
        nome TEXT NOT NULL,
        telefone TEXT NOT NULL,
        dataNascimento TEXT NOT NULL
    );
");
