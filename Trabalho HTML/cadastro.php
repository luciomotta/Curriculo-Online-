<?php
session_start();
require_once "db.php";

// Verificar se o usuário já está autenticado
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verificar se o nome de usuário já existe
    $checkUser = $conn->query("SELECT * FROM usuarios WHERE username='$username'");
    if ($checkUser->num_rows > 0) {
        $error = "Nome de usuário já está em uso!";
    } else {
        // Inserir o novo usuário no banco de dados
        $insertUser = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";

        if ($conn->query($insertUser) === false) {
            $error = "Erro ao cadastrar o usuário: " . $conn->error;
        } else {
            // Cadastro bem-sucedido, redirecionar para a página de login
            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<div class="container">
        <h2>Cadastro de Usuário</h2>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
        <form method="POST" action="">
            <label for="username">Usuário:</label>
            <input type="text" name="username" required><br>
            
            <label for="password">Senha:</label>
            <input type="password" name="password" required><br>

            <button type="submit">Cadastrar</button>
            <br>
            <a href="login.php">Voltar para a página de login</a>
        </form>
    </div>
    </div>
</html>
