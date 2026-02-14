-- Active: 1755488169082@@127.0.0.1@3306@automobilismo
CREATE DATABASE automobilismo;

CREATE TABLE categorias (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_categoria VARCHAR(50) NOT NULL,
    logo VARCHAR(100)
);

CREATE TABLE equipes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_equipe VARCHAR(70) NOT NULL,
    cor1 CHAR(9) NOT NULL,
    cor2 CHAR(9) NOT NULL,
    id_categoria INT NOT NULL,
    Foreign Key (id_categoria) REFERENCES categorias(id)
);

CREATE TABLE pilotos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_piloto VARCHAR(100) NOT NULL,
    idade int NOT NULL,
    nacionalidade VARCHAR(20) NOT NULL,
    foto_piloto VARCHAR(100),
    id_equipe INT NOT NULL,
    Foreign Key (id_equipe) REFERENCES equipes(id)
);