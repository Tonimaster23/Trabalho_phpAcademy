<?php
session_start();
require 'includes/config.php';
require 'includes/db.php';
require 'includes/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_id = loginUser($conn, $username, $password);
    if ($user_id) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username; 
        header("Location: pages/treino.php");
        exit;
    } else {
        $error = 'Nome de usuário ou senha incorretos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bem-vindo à Academia do Toni</h1>
        </div>
        <h2>Login</h2>
        <form method="post" action="index.php">
            <label for="username">Nome de usuário:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
        <p>Não é inscrito? <a href="pages/register.php">Inscreva-se</a></p>
    </div>
</body>
</html>
