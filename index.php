<?php
session_start();
require 'includes/config.php';
require 'includes/db.php';
require 'includes/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $user_id = loginUser($conn, $username, $password);
        if ($user_id) {
            $_SESSION['user_id'] = $user_id;
            header("Location: pages/treino.php");
            exit;
        } else {
            $error = "Usuário ou senha inválidos.";
        }
    } else {
        $error = "Por favor, preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Academia</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bem-vindo à Academia do Toni</h1>
        </div>
        <h2>Login</h2>
        <form method="post" action="">
            <label for="username">Usuário:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <button type="submit">Login</button>
        </form>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <h3> <a href="pages/register.php">Não é inscrito?Inscreva-se</a></h3>
    </div>
</body>
</html>
