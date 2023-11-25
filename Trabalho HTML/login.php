<?php
session_start();
require_once "db.php";

// Verificar se o usuário já está autenticado
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

// Verificar se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar as credenciais do usuário
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consultar o usuário no banco de dados
    $query = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    // Verificar se o usuário foi encontrado
    if ($result->num_rows == 1) {
        // Login bem-sucedido, redirecionar para a página principal
        $_SESSION["username"] = $username;
        header("Location: Index.php");
        exit();
    } else {
        // Credenciais inválidas, exibir uma mensagem de erro
        $error = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tela de Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<div class="container">
        <h2>Tela de Login</h2>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
        <form method="POST" action="">
            <label for="username">Usuário:</label>
            <input type="text" name="username" required><br>
            
            <label for="password">Senha:</label>
            <input type="password" name="password" required><br>

            <input type="submit" value="Entrar">
            <a href="cadastro.php">Criar Conta !!</a>
        </form>
    </div>
    </div>
</html>
