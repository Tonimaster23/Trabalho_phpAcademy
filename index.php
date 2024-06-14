<?php
session_start();
require 'includes/config.php';
require 'includes/db.php';
require 'includes/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        // Registro
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        if (!empty($username) && !empty($password) && ($password === $password_confirm)) {
            $user_id = registerUser($conn, $username, $password);
            if ($user_id) {
                $_SESSION['user_id'] = $user_id;
                header("Location: pages/treino.php");
                exit;
            } else {
                $error = "Erro ao registrar usuário.";
            }
        } else {
            $error = "Por favor, preencha todos os campos corretamente e certifique-se de que as senhas coincidem.";
        }
    } elseif (isset($_POST['login'])) {
        // Login
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
    <h2>Registrar</h2>
    <form method="post" action="">
        <input type="hidden" name="register" value="1">
        <label for="username">Usuário:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="password_confirm">Confirme a Senha:</label>
        <input type="password" name="password_confirm" id="password_confirm" required>
        <br>
        <button type="submit">Registrar</button>
    </form>
    <h2>Login</h2>
    <form method="post" action="">
        <input type="hidden" name="login" value="1">
        <label for="username">Usuário:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Login</button>
    </form>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>
