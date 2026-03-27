<?php

$caminhoBanco = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$caminhoBanco");

$pdo->exec("
    CREATE TABLE medicos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        crm TEXT NOT NULL,
        nome TEXT NOT NULL,
        especialidade TEXT NOT NULL
    );
");
