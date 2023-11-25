<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "");

// Verificar a conexão com o banco de dados
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verificar se o banco de dados existe
$dbExists = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'usuarios'");

// Criar o banco de dados se não existir
if ($dbExists->num_rows == 0) {
    $createDB = "CREATE DATABASE usuarios";

    if ($conn->query($createDB) === false) {
        die("Erro ao criar o banco de dados: " . $conn->error);
    }
}

// Selecionar o banco de dados
$conn->select_db("userhtml");

// Verificar se a tabela de usuários existe
$tableExists = $conn->query("SHOW TABLES LIKE 'usuarios'");

// Criar a tabela de usuários se não existir
if ($tableExists->num_rows == 0) {
    $createTable = "CREATE TABLE usuarios (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL
    )";

    if ($conn->query($createTable) === false) {
        die("Erro ao criar a tabela de usuários: " . $conn->error);
    }
}
?>
