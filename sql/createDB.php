<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "campoMinadoGC";


$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("erro na conexão: " . $conn->connect_error);
}


$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Banco de dados criado ou já existe.";
} else {
    echo "Erro ao criar banco de dados: " . $conn->error;
}


$conn->select_db($dbname);


$sql = "CREATE TABLE IF NOT EXISTS gameUser (
    id TINYINT NOT NULL AUTO_INCREMENT,
    username CHAR(20) NOT NULL,
    email CHAR(30) NOT NULL,
    dtnasc DATE NOT NULL,
    cpf CHAR(13) NOT NULL,
    phone CHAR(13) NOT NULL,
    fullname CHAR(40) NOT NULL,
    pass VARCHAR(255) NOT NULL, 
    PRIMARY KEY(id),
    UNIQUE(username),
    UNIQUE(email),
    UNIQUE(phone),
    UNIQUE(cpf)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela 'gameUser' criada ou já existe.";
} else {
    echo "Erro ao criar tabela: " . $conn->error;
}

$conn->close();
?>
