<?php
//registrar 
function registerUser($conn, $username, $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    return $stmt->insert_id;
}

// login 
function loginUser($conn, $username, $password) {
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);
    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        return $user_id;
    } else {
        return false;
    }
}

//  exercícios 
function getExercicios($user_id) {
    // Array 
    $exercicios = [
        ["nome" => "Supino", "reps" => "3x10", "peso" => "50kg"],
        ["nome" => "Agachamento", "reps" => "3x15", "peso" => "60kg"],
        ["nome" => "Flexão", "reps" => "3x20", "peso" => "Peso corporal"],
        ["nome" => "Pull-up", "reps" => "3x8", "peso" => "Peso corporal"]
    ];
    return $exercicios;
}
