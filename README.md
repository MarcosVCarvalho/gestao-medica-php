# 📋 Sistema de Gestão Médica em PHP

Projeto para aula de BackEnd usando PHP.
Autor: **Marcos Vinicius Carvalho da silva**

O foco do projeto é o aprendizado prático de **Programação Orientada a Objetos (POO)** e **Arquitetura de Software** em PHP.


## 📌 O que é este projeto?

Um sistema completo para gerenciar o fluxo de uma clínica, lidando com:
- **Médicos**: Registro de CRM, especialidade e dados pessoais.
- **Pacientes**: Gestão de prontuário com validação robusta de CPF e telefones.
- **Consultas**: Agendamento integrado ligando médicos e pacientes com controle de datas e valores.

---

## 🏗️ Arquitetura e Padrões Aplicados

O projeto segue os princípios do **Domain-Driven Design (DDD)** e **Clean Code**, dividindo a lógica em camadas:

* **Camada de Domínio (`src/Dominio`)**: Contém as entidades (`Medico`, `Paciente`, `Consulta`) e as regras de negócio.
* **Camada de Infraestrutura (`src/Infraestrutura`)**: Contém os detalhes técnicos, como a conexão com o banco de dados **SQLite**, persistência via **PDO** e implementações de repositórios.
* **Value Objects**: Classes como `CPF` e `Telefone` que encapsulam validações específicas.
* **Repository Pattern**: Abstração da camada de dados para centralizar as queries SQL.

## 🚀 Como Iniciar

1. **Instalação e Autoload**:
   ```bash
   composer install
   ```

2. **Criação do Banco de Dados**:
   ```bash
   php sql.php
   ```

3. **Execução do Script de Teste**:
   ```bash
   php popular-banco.php
   ```
   *(Isso criará automaticamente 3 médicos, 3 pacientes e 3 consultas de exemplo)*

## 📝 Licença

Este projeto é de código aberto e destinado a fins educacionais.
Desenvolvido a partir da base do **Professor Luiz Lins**.
