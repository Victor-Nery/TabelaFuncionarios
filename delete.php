<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback de Exclusão</title>
    <link rel="stylesheet" type="text/css" href="delete.css">
</head>
<body>

<?php
include 'conexao.php';

if(isset($_POST['registro'])) {
    $registro = $_POST['registro'];
    
    $sql = "DELETE FROM funcionarios WHERE registro = '$registro'";

    if ($conn->query($sql) === TRUE) {
        
        echo "<div class='container'>";
        echo "<h1>Feedback de Exclusão</h1>";
        echo "<div class='feedback'>";
        echo "<p>Funcionário excluído com sucesso!</p>";
        echo "</div>";
        echo "<div class='button-container'>";
        echo "<a href='listagem.php'>Voltar para a lista de funcionários</a>";
        echo "</div>";
        echo "</div>";
    } else {
        
        echo "Erro ao excluir funcionário: " . $conn->error;
    }
} else {
    
    echo "Número de registro não recebido.";
}

$conn->close();
?>

</body>
</html>
