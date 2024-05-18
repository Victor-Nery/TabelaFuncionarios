<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexao.php';

    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $perfil = $_POST["perfil"];

    // Insira os dados na tabela de contas
    $sql = "INSERT INTO contas (usuario, email, senha, perfil, status_conta) 
            VALUES ('$usuario', '$email', '$senha', '$perfil', 'ativo')";

    if ($conn->query($sql) === TRUE) {
        // Registro bem-sucedido, redirecione o usuário para a página de login
        header("Location: login.php");
        exit();
    } else {
        $erro = "Erro ao registrar a conta: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Registro</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br>
            <label for="perfil">Perfil:</label>
            <select id="perfil" name="perfil">
                <option value="administrador">Administrador</option>
                <option value="usuario">Usuário</option>
            </select><br>
            <input type="submit" value="Registrar">
        </form>
        <?php if(isset($erro)) echo "<p class='error-message'>$erro</p>"; ?>

        <p class="login-link">Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p> <!-- Link para a página de login -->
    </div>
</body>
</html>
