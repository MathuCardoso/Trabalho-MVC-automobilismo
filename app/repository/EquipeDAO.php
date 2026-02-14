<?php

namespace App\repository;

use App\database\Connection;
use App\model\Categoria;
use App\model\Equipe;
use PDO;

class EquipeDAO
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::getConn();
    }

    public function findById(int $id)
    {
        $sql = "SELECT e.*, c.id AS id_categoria, c.nome_categoria
        FROM equipes e
        JOIN categorias c on id_categoria = c.id
        WHERE e.id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":id", $id);
        $stm->execute();
        $result = $this->map($stm->fetchAll());
        if (!$result) {
            return null;
        }

        return $result[0];
    }

    public function list()
    {
        $sql = "SELECT e.*, c.id AS id_categoria, c.nome_categoria
        FROM equipes e
        JOIN categorias AS c on e.id_categoria = c.id
        ORDER BY e.id DESC;";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $this->map($stm->fetchAll());
        return $result;
    }

    public function insert(Equipe $e)
    {
        $sql = "INSERT INTO equipes(nome_equipe, sede, cor1, cor2, id_categoria) VALUES(:nome, :sede, :cor1, :cor2, :categoria)";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":nome", $e->getNome());
        $stm->bindValue(":sede", $e->getSede());
        $stm->bindValue(":cor1", $e->getCor1());
        $stm->bindValue(":cor2", $e->getCor2());
        $stm->bindValue(":categoria", $e->getCategoria()->getId());
        $stm->execute();
    }

    public function update(Equipe $equipe)
    {
        $sql = "UPDATE equipes
        SET nome_equipe = :nome, 
        sede            = :sede, 
        cor1            = :cor1, 
        cor2            = :cor2, 
        id_categoria    = :id_categoria
        WHERE id        = :id";

        $stm = $this->conn->prepare($sql);

        $stm->bindValue(":id", $equipe->getId());
        $stm->bindValue(":nome", $equipe->getNome());
        $stm->bindValue(":sede", $equipe->getSede());
        $stm->bindValue(":cor1", $equipe->getCor1());
        $stm->bindValue(":cor2", $equipe->getCor2());
        $stm->bindValue(":id_categoria", $equipe->getCategoria()->getId());

        $stm->execute();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM equipes WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":id", $id);
        $stm->execute();
    }

    private function map(array $result)
    {
        $equipes = [];

        foreach ($result as $r) {
            $equipe = new Equipe();
            $equipe->setId($r['id'] ?? 0);
            $equipe->setNome($r['nome_equipe'] ?? null);
            $equipe->setSede($r['sede'] ?? null);
            $equipe->setCor1($r['cor1'] ?? null);
            $equipe->setCor2($r['cor2'] ?? null);
            $categoria = new Categoria();
            $categoria->setId($r['id_categoria'] ?? 0);
            $categoria->setNome($r['nome_categoria'] ?? null);
            $equipe->setCategoria($categoria);
            array_push($equipes, $equipe);
        }

        return $equipes;
    }
}
