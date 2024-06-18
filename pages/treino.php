<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

require '../includes/config.php';
require '../includes/db.php';
require '../includes/functions.php';

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username']; 
$exercicios = getExercicios($user_id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Treino</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1> Academia do Toni</h1>
        </div>
        <h2>Bem-vindo, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>Seu treino de hoje é este:</p>
        <ul>
            <?php foreach ($exercicios as $exercicio): ?>
                <li>
                    <strong><?php echo $exercicio['nome']; ?>:</strong>
                    <?php echo $exercicio['reps']; ?>, 
                    <?php echo $exercicio['peso']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <form method="post" action="logout.php">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
