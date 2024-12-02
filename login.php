<?php
session_start();

$host = "localhost";
$dbname = "campoMinadoGC";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userInput = $_POST['username'];
    $senhaInput = $_POST['senha'];

    $sql = "SELECT id, username, pass FROM gameUser WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $userInput);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $hashDoBanco = $result['pass'];
        if (password_verify($senhaInput, $hashDoBanco)) {

            $_SESSION['username'] = $result['username'];
            $_SESSION['user_id'] = $result['id'];

            echo json_encode(['success' => true, 'message' => 'Login realizado com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Senha incorreta.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Usuário não encontrado.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erro no servidor: ' . $e->getMessage()]);
}
?>
