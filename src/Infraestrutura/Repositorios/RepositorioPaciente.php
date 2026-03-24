<?php

namespace Luizlins\Projeto01\Infraestrutura\Repositorios;

use Luizlins\Projeto01\Dominio\Modulos\Paciente;
use Luizlins\Projeto01\Dominio\Repositorio\RepositorioPacienteInterface;
use Luizlins\Projeto01\Infraestrutura\Persistencia\FabricaConexao;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\CPF;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\Telefone;
use PDO;
use PDOStatement;

class RepositorioPaciente implements RepositorioPacienteInterface{
    private PDO $conexao;

    public function __construct(){
        $this->conexao = FabricaConexao::criarConexao();
    }

    public function listar(): array{
        $sqlQuery = "SELECT * FROM pacientes;";
        $stmt = $this->conexao->query($sqlQuery);

        return $this->hidratacao($stmt);
    }

    public function inserir(Paciente $paciente): bool
    {
        $inserirQuery = "INSERT INTO pacientes (
            cpf, 
            nome, 
            telefone,
            dataNascimento
        ) VALUES (
            :cpf, 
            :nome, 
            :telefone,
            :dataNascimento
        );";
        $stmt = $this->conexao->prepare($inserirQuery);

        $sucesso = $stmt->execute([
            ':cpf' => $paciente->recuperarcpf()->recuperarNumero(),
            ':nome' => $paciente->recuperarNome(),
            ':telefone' => $paciente->recuperarTelefone()->recuperarNumero(),
            ':dataNascimento' => $paciente->recuperarDataNascimento(),
        ]);

        $paciente->definirId($this->conexao->lastInsertId());

        return $sucesso;
        
    }

    public function deletar(Paciente $paciente): bool
    {
        $stmt = $this->conexao->prepare("DELETE FROM pacientes WHERE id = ?;");
        $stmt->bindValue(1, $paciente->recuperarId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function atualizar(Paciente $paciente): bool
    {
        $atualizarQuery = "UPDATE pacientes 
                            SET 
                                cpf = :cpf, 
                                nome = :nome, 
                                telefone = :telefone,
                                dataNascimento = :dataNascimento 
                            WHERE 
                                id = :id;";
        $stmt = $this->conexao->prepare($atualizarQuery);
        $stmt->bindValue(':cpf', $paciente->recuperarCpf()->recuperarNumero());
        $stmt->bindValue(':nome', $paciente->recuperarNome());
        $stmt->bindValue(':telefone', $paciente->recuperarTelefone()->recuperarNumero());
        $stmt->bindValue('dataNascimento', $paciente->recuperarDataNascimento());
        $stmt->bindValue(':id', $paciente->recuperarId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function recuperar(Paciente $paciente): bool
    {
        return true;
    }

    public function hidratacao(PDOStatement $stmt): array
    {
        $listaDadosPacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaPacientes = [];

        foreach($listaDadosPacientes as $paciente) {
            $listaPacientes[] = new Paciente(
                $paciente['id'],
                new CPF($paciente['cpf']),
                $paciente['nome'],
                new Telefone($paciente['telefone']),
                $paciente['dataNascimento'],
            );
        }

        return $listaPacientes;
    }
}