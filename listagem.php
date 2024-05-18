<?php
session_start();

// Se o usuário clicar em "Sair", encerra a sessão e redireciona para a página de login
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!-- Se o usuário estiver logado, exibe o link "Sair" -->
<?php if (isset($_SESSION['usuario'])): ?>
    <a href="?logout">Sair da conta</a>
<?php endif; 




if (!isset($_SESSION["usuario"]) || empty($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

include 'conexao.php';

if ($_SESSION["perfil"] == "administrador") {
    // Funcionalidades do Administrador
    // Implemente aqui as funcionalidades de cadastro e gerenciamento de contas para o perfil de administrador
} else {
    // Funcionalidades do Usuário
    // Implemente aqui as funcionalidades específicas para o perfil de usuário
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem</title>
    <link rel="stylesheet" type="text/css" href="listagem.css">
</head>
<body>
    <div class="container">
        <h1>DEMONSTRATIVOS DE RENDIMENTOS MENSAIS</h1>

        <?php if ($_SESSION["perfil"] == "administrador"): ?>
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="search">Pesquisar Funcionário:</label>
            <input type="text" id="search" name="search" placeholder="Digite o nome do funcionário">
            <input type="submit" value="Pesquisar">
        </form>
        <?php endif; ?>

        <?php
        $salario_minimo = 1412;

        include 'conexao.php';

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
            $search = $_GET['search'];

            $sql = "SELECT * FROM funcionarios WHERE nome LIKE '%$search%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2>Resultado da Pesquisa:</h2>";
                echo "<table>";
                echo "<tr><th>Nº de Registro</th><th>Nome do Funcionário</th><th>Data de Admissão</th><th>Cargo</th><th>Salário Bruto</th><th>Desconto INSS</th><th>Salário Líquido</th>";
                if ($_SESSION["perfil"] == "administrador") {
                    echo "<th>Ação</th>";
                }
                echo "</tr>";
                while($row = $result->fetch_assoc()) {
                    $salario_bruto = $row["qtd_salario_minimo"] * $salario_minimo;
                    $desconto_inss = ($salario_bruto > 1550) ? $salario_bruto * 0.11 : 0;
                    $salario_liquido = $salario_bruto - $desconto_inss;
                    $desconto_formatado = ($desconto_inss == 0) ? "ISENTO" : "R$ " . $desconto_inss;
                    echo "<tr>";
                    echo "<td>".$row["registro"]."</td>";
                    echo "<td>".$row["nome"]."</td>";
                    echo "<td>".$row["data_admissao"]."</td>";
                    echo "<td>".$row["cargo"]."</td>";
                    echo "<td>R$ ".$salario_bruto."</td>";
                    echo "<td>".$desconto_formatado."</td>";
                    echo "<td>R$ ".$salario_liquido."</td>";
                    if ($_SESSION["perfil"] == "administrador") {
                        echo "<td><form method='post' action='delete.php'>";
                        echo "<input type='hidden' name='registro' value='".$row["registro"]."'>";
                        echo "<input type='submit' value='Excluir'></form></td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Nenhum funcionário encontrado com o nome '$search'.</p>";
            }
        }


        if (!isset($_GET['search'])) {
            $sql = "SELECT * FROM funcionarios";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2>Todos os Funcionários:</h2>";
                echo "<table>";
                echo "<tr><th>Nº de Registro</th><th>Nome do Funcionário</th><th>Data de Admissão</th><th>Cargo</th><th>Salário Bruto</th><th>Desconto INSS</th><th>Salário Líquido</th>";
                if ($_SESSION["perfil"] == "administrador") {
                    echo "<th>Ação</th>";
                }
                echo "</tr>";
                while($row = $result->fetch_assoc()) {
                    $salario_bruto = $row["qtd_salario_minimo"] * $salario_minimo;
                    $desconto_inss = ($salario_bruto > 1550) ? $salario_bruto * 0.11 : 0;
                    $salario_liquido = $salario_bruto - $desconto_inss;
                    $desconto_formatado = ($desconto_inss == 0) ? "ISENTO" : "R$ " . $desconto_inss;
                    echo "<tr>";
                    echo "<td>".$row["registro"]."</td>";
                    echo "<td>".$row["nome"]."</td>";
                    echo "<td>".$row["data_admissao"]."</td>";
                    echo "<td>".$row["cargo"]."</td>";
                    echo "<td>R$ ".$salario_bruto."</td>";
                    echo "<td>".$desconto_formatado."</td>";
                    echo "<td>R$ ".$salario_liquido."</td>";
                    if ($_SESSION["perfil"] == "administrador") {
                        echo "<td><form method='post' action='delete.php'>";
                        echo "<input type='hidden' name='registro' value='".$row["registro"]."'>";
                        echo "<input type='submit' value='Excluir'></form></td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Nenhum funcionário cadastrado.</p>";
            }
        }

        $conn->close();
        ?>

        <?php if ($_SESSION["perfil"] == "administrador"): ?>
        <a href="cadastro.php">Voltar para o formulário de cadastro</a>
        <?php endif; ?>
    </div>
</body>
</html>
