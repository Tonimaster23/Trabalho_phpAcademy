<?php
session_start();
require '../includes/config.php';
require '../includes/db.php';
require '../includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$exercicios = getExercicios($conn, $user_id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Seus Exercícios</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Seus Exercícios</h1>
        <ul>
            <?php foreach ($exercicios as $exercicio): ?>
                <li>
                    <strong><?php echo htmlspecialchars($exercicio['nome_exercicio'], ENT_QUOTES, 'UTF-8'); ?>:</strong>
                    <?php echo htmlspecialchars($exercicio['descricao'], ENT_QUOTES, 'UTF-8'); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
