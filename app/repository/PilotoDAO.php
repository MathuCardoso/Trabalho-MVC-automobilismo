<?php

namespace App\repository;

use App\model\Piloto;
use App\database\Connection;
use App\model\Equipe;
use PDO;

class PilotoDAO
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::getConn();
    }

    public function findById($id)
    {
        $sql = "SELECT p.*, e.id AS id_equipe, e.nome_equipe, e.cor1, e.cor2
        FROM pilotos p
        JOIN equipes e on id_equipe = e.id
        WHERE p.id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":id", $id);
        $stm->execute();
        $result = $this->map($stm->fetchAll());
        if (!$result) {
            return null;
        }

        return $result[0];
    }

    public function findByNumber(int $num)
    {
        $sql = "SELECT p.numero
        FROM pilotos p
        WHERE p.numero = :numero";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":numero", $num);
        $stm->execute();
        $result = $this->map($stm->fetchAll());
        if (!$result) {
            return false;
        }

        return true;
    }

    public function list(): array
    {
        $sql = "SELECT p.*, e.id AS id_equipe, e.nome_equipe, e.cor1, e.cor2
                FROM pilotos p
                JOIN equipes e on id_equipe = e.id
                ORDER BY p.id DESC;";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $this->map($stm->fetchAll());
        return $result;
    }

    public function insert(Piloto $piloto): void
    {
        $sql = "INSERT INTO pilotos(nome_piloto, idade, nacionalidade, numero, foto_piloto, id_equipe) 
        VALUES (:nome, :idade, :nacional, :numero, :foto, :equipe) ";

        $stm = $this->conn->prepare($sql);

        $stm->bindValue(":nome", $piloto->getNome());
        $stm->bindValue(":idade", $piloto->getIdade());
        $stm->bindValue(":nacional", $piloto->getNacionalidade());
        $stm->bindValue(":numero", $piloto->getNumero());
        $stm->bindValue(":foto", $piloto->getFotoPerfil());
        $stm->bindValue(":equipe", $piloto->getEquipe()->getId());

        $stm->execute();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM pilotos WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":id", $id);
        $stm->execute();
    }

    public function update(Piloto $piloto)
    {
        $sql = "UPDATE pilotos
        SET nome_piloto = :nome, 
        idade           = :idade, 
        nacionalidade   = :nacional, 
        numero          = :numero, 
        foto_piloto     = :foto, 
        id_equipe       = :equipe
        WHERE id        = :id";

        $stm = $this->conn->prepare($sql);

        $stm->bindValue(":id", $piloto->getId());
        $stm->bindValue(":nome", $piloto->getNome());
        $stm->bindValue(":idade", $piloto->getIdade());
        $stm->bindValue(":nacional", $piloto->getNacionalidade());
        $stm->bindValue(":numero", $piloto->getNumero());
        $stm->bindValue(":foto", $piloto->getFotoPerfil());
        $stm->bindValue(":equipe", $piloto->getEquipe()->getId());

        $stm->execute();
    }

    private function map(array $result): array
    {
        $pilotos = [];

        foreach ($result as $r) {
            $piloto = new Piloto();
            $piloto->setId($r['id'] ?? 0);
            $piloto->setNome($r['nome_piloto'] ?? null);
            $piloto->setIdade($r['idade'] ?? null);
            $piloto->setNacionalidade($r['nacionalidade'] ?? null);
            $piloto->setNumero($r['numero'] ?? null);
            $piloto->setFotoPerfil($r['foto_piloto'] ?? null);
            $equipe = new Equipe();
            $equipe->setId($r['id_equipe'] ?? 0);
            $equipe->setNome($r['nome_equipe'] ?? null);
            $equipe->setCor1($r['cor1'] ?? null);
            $equipe->setCor2($r['cor2'] ?? null);
            $piloto->setEquipe($equipe);
            array_push($pilotos, $piloto);
        }
        return $pilotos;
    }
}
