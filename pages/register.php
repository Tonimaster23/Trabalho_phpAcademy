<?php
session_start();
require '../includes/config.php';
require '../includes/db.php';
require '../includes/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (!empty($username) && !empty($password) && ($password === $password_confirm)) {
        $user_id = registerUser($conn, $username, $password);
        if ($user_id) {
            $_SESSION['user_id'] = $user_id;
            header("Location: treino.php");
            exit;
        } else {
            $error = "Erro ao registrar usuário.";
        }
    } else {
        $error = "Por favor, preencha todos os campos corretamente e certifique-se de que as senhas coincidem.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Registrar-se</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bem-vindo à Academia do Toni</h1>
        </div>
        <h2>Registrar</h2>
        <form method="post" action="">
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
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
