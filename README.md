📋 Sistema de Gestão Médica (Projeto Acadêmico)
Este projeto é uma implementação prática de Programação Orientada a Objetos (POO) e Arquitetura de Software em PHP, desenvolvida para a disciplina de Desenvolvimento de Sistemas.

O foco principal não é apenas o CRUD, mas a aplicação de padrões de projeto que garantam a manutenibilidade e escalabilidade do código.

🏗️ Arquitetura e Padrões Aplicados
O projeto segue os princípios do Domain-Driven Design (DDD) e Clean Code, dividindo a lógica em camadas:

Camada de Domínio (src/Dominio): Contém as entidades (Medico, Paciente, Consulta) e as regras de negócio. Esta camada é independente de tecnologias externas.

Camada de Infraestrutura (src/Infraestrutura): Contém os detalhes técnicos, como a conexão com o banco de dados SQLite, persistência via PDO e implementações de repositórios.

Value Objects: Classes como CPF e Telefone que encapsulam validações específicas, garantindo que o objeto de domínio nunca receba dados inválidos.

Repository Pattern: Abstração da camada de dados, permitindo que a lógica de negócio não saiba "como" os dados são salvos, apenas "que" eles são salvos.

📂 Estrutura de Pastas
Plaintext
PROJETO-01/
├── src/
│   ├── Dominio/
│   │   ├── Modulos/           # Entidades (Medico, Paciente, Consulta)
│   │   └── Repositorios/      # Interfaces (Contratos)
│   └── Infraestrutura/
│       ├── Configuracoes/     # Value Objects (CPF, Telefone)
│       ├── Persistencia/      # Fabrica de Conexão (PDO)
│       └── Repositorios/      # Implementações SQL (SQLite)
├── testes/                    # Scripts de teste
├── vendor/                    # Autoload do Composer
├── composer.json              # Definição de Namespaces (PSR-4)
└── sql.php                    # Script de criação das tabelas
🚀 Como Executar o Teste Completo
Para facilitar a avaliação, foi criado um script que limpa o banco de dados e gera dados fictícios automaticamente.

1. Instalação e Autoload
Certifique-se de ter o Composer instalado e execute:

Bash
composer install
2. Criação do Banco de Dados
Gere as tabelas necessárias no SQLite:

Bash
php sql.php
3. Execução do Script de Teste
Este script irá inserir 3 Médicos, 3 Pacientes e 3 Consultas, exibindo o log de sucesso no terminal:

Bash
php popular-banco.php
🛠️ Tecnologias Utilizadas
PHP 8.0+ (utilizando Promoção de Propriedades de Construtor e Tipagem Estrita).

SQLite: Banco de dados relacional leve que dispensa configuração de servidor.

PDO (PHP Data Objects): Para interação segura com o banco via Prepared Statements.

Composer (PSR-4): Para gerenciamento de pacotes e carregamento automático de classes.

📚 Conceitos Demonstrados
Encapsulamento: Uso de propriedades privadas e métodos recuperar... (getters).

Injeção de Dependência: Repositórios recebendo a conexão PDO via construtor.

Tratamento de Datas: Uso da classe nativa DateTimeImmutable.

Prevenção de SQL Injection: Uso obrigatório de parâmetros vinculados (bindValue) em todas as queries.

👨‍💻 Autor
Marcos Vinicius Carvalho da Silva Estudante de Análise e Desenvolvimento de Sistemas (ADS) Uninassau - Piauí
