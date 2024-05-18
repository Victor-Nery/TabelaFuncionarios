<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback de Registro Adicionado</title>
    <link rel="stylesheet" type="text/css" href="processa_cadastro.css">
    <style>
        .error-feedback {
            color: red;
           
        }
    </style>
</head>
<body>

<?php

include 'conexao.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $registro = $_POST["registro"];
    $sql_verificar = "SELECT registro FROM funcionarios WHERE registro = '$registro'";
    $resultado_verificar = $conn->query($sql_verificar);
    
    if ($resultado_verificar->num_rows > 0) {
        
        echo "<div class='container'>";
        echo "<h1 class='error-feedback'>Erro ao Adicionar Registro</h1>";
        echo "<div class='feedback'>";
        echo "<p class='error-feedback'>O número de registro '$registro' já está sendo utilizado. Por favor, escolha outro número.</p>";
        echo "</div>";
        echo "<div class='button-container'>";
        echo "<a href='cadastro.php'>Voltar para o Cadastro</a>";
        echo "</div>";
        echo "</div>";
    } else {
        
        $nome = $_POST["nome"];
        $data_admissao = $_POST["data_admissao"];
        $cargo = $_POST["cargo"];
        $qtd_salario_minimo = $_POST["qtd_salario_minimo"];

        $sql = "INSERT INTO funcionarios (registro, nome, data_admissao, cargo, qtd_salario_minimo)
        VALUES ('$registro', '$nome', '$data_admissao', '$cargo', '$qtd_salario_minimo')";

        if ($conn->query($sql) === TRUE) {
            
            echo "<div class='container'>";
            echo "<h1>Registro Adicionado</h1>";
            echo "<div class='feedback'>";
            echo "<p>Novo registro adicionado com sucesso!</p>";
            echo "</div>";
            echo "<div class='button-container'>";
            echo "<a href='cadastro.php'>Voltar para o Cadastro</a>";
            echo "<a href='listagem.php'>Ver Lista de Funcionários</a>";
            echo "</div>";
            echo "</div>";
        } else {
            
            echo "<div class='container'>";
            echo "<h1 class='error-feedback'>Erro ao Adicionar Registro</h1>";
            echo "<div class='feedback'>";
            echo "<p class='error-feedback'>Erro ao adicionar novo registro. Por favor, tente novamente mais tarde.</p>";
            echo "</div>";
            echo "<div class='button-container'>";
            echo "<a href='cadastro.php'>Voltar para o Cadastro</a>";
            echo "</div>";
            echo "</div>";
        }
    }
}


$conn->close();
?>

</body>
</html>
