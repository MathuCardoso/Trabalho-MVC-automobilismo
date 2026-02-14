<?php

namespace App\repository;

use App\database\Connection;
use App\model\Categoria;
use PDO;

class CategoriaDAO
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::getConn();
    }

    public function findById(int $id)
    {
        $sql = "SELECT * FROM categorias c
        WHERE c.id = :id";
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
        $sql = "SELECT * FROM categorias c
        ORDER BY c.id";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $this->map($stm->fetchAll());
        return $result;
    }

    public function insert(Categoria $c)
    {
        $sql = "INSERT INTO categorias(
        nome_categoria, logo)
        VALUES(:nome, :logo);";
        $stm = $this->conn->prepare($sql);

        $stm->bindValue(":nome", $c->getNome());
        $stm->bindValue(":logo", $c->getLogo());
        $stm->execute();
    }

    public function update(Categoria $categoria)
    {
        $sql = "UPDATE categorias
        SET nome_categoria = :nome, 
        logo               = :logo
        WHERE id           = :id";

        $stm = $this->conn->prepare($sql);

        $stm->bindValue(":id", $categoria->getId());
        $stm->bindValue(":nome", $categoria->getNome());
        $stm->bindValue(":logo", $categoria->getLogo());

        $stm->execute();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM categorias WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":id", $id);
        $stm->execute();
    }

    private function map(array $result)
    {
        $categorias = [];
        foreach ($result as $r) {
            $categoria = new Categoria();
            $categoria->setId($r['id']);
            $categoria->setNome($r['nome_categoria']);
            $categoria->setLogo($r['logo']);
            array_push($categorias, $categoria);
        }

        return $categorias;
    }
}
