<?php

namespace configs;

use PDO;

class Database
{
    public const HOST     = "localhost";
    public const PORT     = "3306";
    public const NAME     = "automobilismo";
    public const USER     = "root";
    public const PASSWORD = "dbmysql";
    public const OPTIONS = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        //Define o tipo do erro como exceção 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //Define o tipo do retorno das consultas como array associativo
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
}
