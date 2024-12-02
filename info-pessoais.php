<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$host = "localhost";
$dbname = "campoMinadoGC";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT username, email, dtnasc, cpf, phone, fullname FROM gameUser WHERE username = :username");
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Erro: Usuário não encontrado.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $novoNome = $_POST['nomec'] ?? $user['fullname'];
        $novoEmail = $_POST['email'] ?? $user['email'];
        $novoCelular = $_POST['celular'] ?? $user['phone'];
        $novaSenha = $_POST['senha'];

        $updateStmt = $conn->prepare("UPDATE gameUser SET fullname = :fullname, email = :email, phone = :phone" . 
            (empty($novaSenha) ? "" : ", pass = :pass") . " WHERE username = :username");
        $updateStmt->bindParam(':fullname', $novoNome);
        $updateStmt->bindParam(':email', $novoEmail);
        $updateStmt->bindParam(':phone', $novoCelular);
        if (!empty($novaSenha)) {
            $hashedSenha = password_hash($novaSenha, PASSWORD_DEFAULT);
            $updateStmt->bindParam(':pass', $hashedSenha);
        }
        $updateStmt->bindParam(':username', $_SESSION['username']);
        $updateStmt->execute();

        $user['fullname'] = $novoNome;
        $user['email'] = $novoEmail;
        $user['phone'] = $novoCelular;

        echo "<script>alert('Informações atualizadas com sucesso!');</script>";
    }
} catch (PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Usuário</title>
    <link rel="stylesheet" href="stylesheets/mainstyles.css">
    <link rel="stylesheet" href="stylesheets/infopessoais.css">
    <link rel="shortcut icon" href="Img/GUII.png" type="image/x-icon">
</head>
<body>
    <header>
        <form action="logout.php" method="POST">
            <button type="submit" class="exitButton" style="font-size: 1.5vw">
                Sair
            </button>
        </form>
        <h1>Campo Minado - Zona 401</h1> 
        <nav>
            <ul>
                <li><a href="play-game.php">Game</a></li>
                <li><a href="ranking.php">Ranking</a></li>
                <li><a href="info-pessoais.php">Área do Usuário</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="divcentral" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            <h2>Área do Usuário</h2>
            <div style="text-align:center;position:relative;left:30vw;">
                <h3 style="font-size:2vw;">Informações de Usuário</h3>
                <table style="width: 20%; text-align: left; border-collapse: collapse; margin: 20px auto; background-color: #f4f4f4;">
                    <tr>
                        <th>Nome de Usuário</th>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                    </tr>
                    <tr>
                        <th>CPF</th>
                        <td><?php echo htmlspecialchars($user['cpf']); ?></td>
                    </tr>
                    <tr>
                        <th>Data de Nascimento</th>
                        <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($user['dtnasc']))); ?></td>
                    </tr>
                    <tr>
                        <th>Nome Completo</th>
                        <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                    </tr>
                    <tr>
                        <th>Celular</th>
                        <td><?php echo htmlspecialchars($user['phone']); ?></td>
                    </tr>
                </table>
            </div>

            <div style="position:relative;bottom:25vw; width:35vw;font-size:2vw;">
                <form id="changeInfo" method="POST" style="font-size:1vw;text-align:center;width:25vw;margin-left:5vw;">
                    <label for="nomec">Nome Completo</label>
                    <input type="text" id="nomec" name="nomec" value="<?php echo htmlspecialchars($user['fullname']); ?>">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                    <label for="celular">Celular</label>
                    <input type="text" id="celular" name="celular" value="<?php echo htmlspecialchars($user['phone']); ?>" title="Celular"><br>
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Nova senha (opcional)"><br>
                    <button class="changeButton" type="submit">
                        Alterar Dados
                    </button>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; Site da Disciplina SI401</p>
    </footer>
</body>
</html>
