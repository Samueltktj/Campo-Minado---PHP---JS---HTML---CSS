<?php
$host = "localhost";
$dbname = "campoMinadoGC";
$username = "root";
$password = "";

try {
    
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $fullname = $_POST['nomec'];
    $datanasc = $_POST['datanasc'];
    $cpf = $_POST['cpf'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 

    $campos = [
        'username' => $username,
        'email' => $email,
        'cpf' => $cpf,
        'phone' => $celular
    ];
    foreach ($campos as $campo => $valor) {
        $sql = "SELECT COUNT(*) FROM gameUser WHERE $campo = :valor";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':valor', $valor);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            echo json_encode(['success' => false, 'error' => "O campo '$campo' já está em uso."]);
            exit();
        }
    }

    $sql = "INSERT INTO gameUser (fullname, dtnasc, cpf, phone, email, username, pass)
            VALUES (:fullname, :datanasc, :cpf, :phone, :email, :username, :pass)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':datanasc', $datanasc);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':phone', $celular);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':pass', $senha); 
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Usuário cadastrado com sucesso!']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erro ao cadastrar: ' . $e->getMessage()]);
}
?>
