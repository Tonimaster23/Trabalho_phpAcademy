<?php
function registerUser($conn, $username, $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        return $stmt->insert_id;
    } else {
        return false;
    }
}

function loginUser($conn, $username, $password) {
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            return $id;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function getExercicios($conn, $user_id) {
    $stmt = $conn->prepare("SELECT nome_exercicio, descricao FROM exercicios WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $exercicios = [];
    while ($row = $result->fetch_assoc()) {
        $exercicios[] = $row;
    }

    return $exercicios;
}
?>
