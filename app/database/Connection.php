<?php

namespace App\database;

use PDO;
use configs\Database;
use PDOException;

require_once __DIR__ . "/../../configs/Database.php";


class Connection
{
    private static $conn;


    public static function getConn()
    {

        if (self::$conn == null) {

            try {
                self::$conn = new PDO(
                    dsn: "mysql:host=" . Database::HOST .
                        ";dbname=" . Database::NAME .
                        ";port=" . Database::PORT,
                    username: Database::USER,
                    password: Database::PASSWORD,
                    options: Database::OPTIONS
                );
            } catch (PDOException $e) {
                echo "ERRO AO SE CONECTAR COM O BANCO DE DADOS!";
                echo $e->getMessage();
            }
        }

        return self::$conn;
    }
}
