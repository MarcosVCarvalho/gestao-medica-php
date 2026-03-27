<?php

namespace Luizlins\Projeto01\Infraestrutura\Repositorios;

use Luizlins\Projeto01\Dominio\Modulos\Consulta;
use Luizlins\Projeto01\Dominio\Modulos\Medico;
use Luizlins\Projeto01\Dominio\Modulos\Paciente;
use Luizlins\Projeto01\Dominio\Repositorio\RepositorioConsultaInterface;
use Luizlins\Projeto01\Dominio\Repositorio\RepositorioMedicoInterface;
use Luizlins\Projeto01\Dominio\Repositorio\RepositorioPacienteInterface;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\Telefone;
use Luizlins\Projeto01\Infraestrutura\Configuracoes\CPF;
use Luizlins\Projeto01\Infraestrutura\Persistencia\FabricaConexao;
use PDO;
use PDOStatement;

class RepositorioConsulta implements RepositorioConsultaInterface
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = FabricaConexao::criarConexao();
    }

    public function inserir(Consulta $consulta): bool{
        $inserirQuery = "INSERT INTO consultas (
            medico_id, 
            paciente_id, 
            data_consulta,
            valor
        ) VALUES (
            :medico_id, 
            :paciente_id, 
            :data_consulta,
            :valor
        );";
        $stmt = $this->conexao->prepare($inserirQuery);

        $sucesso = $stmt->execute([
            ':medico_id' => $consulta->recuperarMedico()->recuperarId(),
            ':paciente_id' => $consulta->recuperarPaciente()->recuperarId(),
            ':data_consulta' => $consulta->recuperarData()->format('Y-m-d H:i:s'),
            ':valor' => $consulta->recuperarValor(),
        ]);

        $consulta->definirId($this->conexao->lastInsertId());
        return $sucesso;
    }

    public function listar(): array{
    $sqlQuery = "SELECT 
            c.id AS consulta_id,
            c.data_consulta,
            c.valor,
            m.id AS medico_id,
            m.nome AS nome_medico,
            m.crm,
            m.especialidade,
            p.id AS paciente_id,
            p.nome AS nome_paciente,
            p.cpf,
            p.telefone,
            p.dataNascimento
        FROM consultas c
        JOIN medicos m ON c.medico_id = m.id
        JOIN pacientes p ON c.paciente_id = p.id;";

    $stmt = $this->conexao->query($sqlQuery);

    return $this->hidratacao($stmt);
}
    public function deletar(Consulta $consulta): bool {
        $stmt = $this->conexao->prepare("DELETE FROM consultas WHERE id = ?;");
        $stmt->bindValue(1, $consulta->recuperarId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function atualizar(Consulta $consulta) {
        $atualizarQuery = "UPDATE consultas SET 
                        medico_id = :medico_id, 
                        paciente_id = :paciente_id, 
                        data_consulta = :data_consulta, 
                        valor = :valor 
                      WHERE id = :id;";

        $stmt = $this->conexao->prepare($atualizarQuery);

        $sucesso = $stmt->execute([
            ':medico_id'      => $consulta->recuperarMedico()->recuperarId(),
            ':paciente_id'    => $consulta->recuperarPaciente()->recuperarId(),
            ':data_consulta'  => $consulta->recuperarData()->format('Y-m-d H:i:s'),
            ':valor'          => $consulta->recuperarValor(),
            ':id'             => $consulta->recuperarId() 
        ]); 

        return $sucesso;
    }
    public function recuperar(int $id): ?array {
    $sql = "SELECT c.*, m.nome as nome_medico, p.nome as nome_paciente 
            FROM consultas c
            INNER JOIN medicos m ON c.medico_id = m.id
            INNER JOIN pacientes p ON c.paciente_id = p.id
            WHERE c.id = :id";
            
    $stmt = $this->conexao->prepare($sql);
    $stmt->execute([':id' => $id]);
    
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

    public function hidratacao(PDOStatement $stmt): array
{
    $listaDadosConsultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $listaConsultas = [];

    foreach ($listaDadosConsultas as $dados) {
        //Hidratação do Médico
        $medico = new Medico(
            $dados['medico_id'],
            $dados['crm'],
            $dados['nome_medico'],
            $dados['especialidade']
        );

        //Hidratação do Paciente
        $paciente = new Paciente(
            $dados['paciente_id'],
            new CPF($dados['cpf']),
            $dados['nome_paciente'],
            new Telefone($dados['telefone']),
            new \DateTimeImmutable($dados['data_nascimento'])
        );

        //Hidratação da consulta
        $listaConsultas[] = new Consulta(
            $dados['consulta_id'],
            $medico,
            $paciente,
            new \DateTimeImmutable($dados['data_consulta']),
            (float) $dados['valor']
        );
    }

    return $listaConsultas;
}

    


}