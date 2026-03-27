<?php

namespace Luizlins\Projeto01\Infraestrutura\Repositorios;

use Luizlins\Projeto01\Dominio\Modulos\Medico;
use Luizlins\Projeto01\Dominio\Repositorio\RepositorioMedicoInterface;
use Luizlins\Projeto01\Infraestrutura\Persistencia\FabricaConexao;
use PDO;
use PDOStatement;

class RepositorioMedico implements RepositorioMedicoInterface
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = FabricaConexao::criarConexao();
    }

    public function listar(): array
    {
        $sqlQuery = "SELECT * FROM medicos;";
        $stmt = $this->conexao->query($sqlQuery);

        return $this->hidratacao($stmt);
    }

    public function inserir(Medico $medico): bool
    {
        $inserirQuery = "INSERT INTO medicos (
            crm, 
            nome, 
            especialidade
        ) VALUES (
            :crm, 
            :nome, 
            :especialidade
        );";
        $stmt = $this->conexao->prepare($inserirQuery);

        $sucesso = $stmt->execute([
            ':crm' => $medico->recuperarCRM(),
            ':nome' => $medico->recuperarNome(),
            ':especialidade' => $medico->recuperarEspecialidade(),
        ]);

        $medico->definirId($this->conexao->lastInsertId());

        return $sucesso;
        
    }

    public function deletar(Medico $medico): bool
    {
        $stmt = $this->conexao->prepare("DELETE FROM medicos WHERE id = ?;");
        $stmt->bindValue(1, $medico->recuperarId(), PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function atualizar(Medico $medico): bool
    {
        $atualizarQuery = "UPDATE medicos 
                            SET 
                                crm = :crm, 
                                nome = :nome, 
                                especialidade = :especialidade 
                            WHERE 
                                id = :id;";
        $stmt = $this->conexao->prepare($atualizarQuery);
        $stmt->bindValue(':crm', $medico->recuperarCRM());
        $stmt->bindValue(':nome', $medico->recuperarNome());
        $stmt->bindValue(':especialidade', $medico->recuperarEspecialidade());
        $stmt->bindValue(':id', $medico->recuperarId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function recuperar(Medico $medico): ?Medico
    { 
        //pegar o id do medico
        $id = $medico->recuperarId();

        $sqlQuery = "SELECT * FROM medicos where id = $id;";
        $stmt = $this->conexao->prepare($sqlQuery);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        //validar a busca
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if($resultado){
            return new Medico($resultado["id"], $resultado["crm"],$resultado["nome"],$resultado["especialidade"]);
        } else {
            return null;
        }
    }

    public function hidratacao(PDOStatement $stmt): array
    {
        $listaDadosMedicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaMedicos = [];

        foreach($listaDadosMedicos as $medico) {
            $listaMedicos[] = new Medico(
                $medico['id'],
                $medico['crm'],
                $medico['nome'],
                $medico['especialidade']
            );
        }
        return $listaMedicos;
    }

}