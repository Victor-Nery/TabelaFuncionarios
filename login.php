<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexao.php';

    $usuario = ucfirst($_POST["usuario"]);
    $senha = $_POST["senha"];

    // Transformando a primeira letra do e-mail em maiúscula
    $email = ucfirst($_POST["email"]);

    $sql = "SELECT * FROM contas WHERE usuario = '$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Comparando a senha inserida com a senha armazenada
        if ($row["status_conta"] == "ativo" && $senha == $row["senha"]) {
            $_SESSION["usuario"] = $row["usuario"];
            $_SESSION["perfil"] = $row["perfil"];
            header("Location: listagem.php");
            exit();
        } else {
            $erro = "Credenciais inválidas ou conta bloqueada!";
        }
    } else {
        $erro = "Credenciais inválidas!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-container {
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

        .register-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br>
            <input type="submit" value="Entrar">
        </form>
        <?php if(isset($erro)) echo "<p class='error-message'>$erro</p>"; ?>
        <p class="register-link">Não tem uma conta? <a href="registro.php">Crie uma aqui</a>.</p> <!-- Link para a página de registro -->
    </div>
</body>
</html>
