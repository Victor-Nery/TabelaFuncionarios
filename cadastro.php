<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionários</title>
    <link rel="stylesheet" type="text/css" href="cadastro.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Funcionários</h1>
        <h2>Dados dos Funcionários</h2>

        
        <form method="post" action="processa_cadastro.php">
            <label for="registro">Nº de Registro:</label><br>
            <input type="number" id="registro" name="registro" required><br>
            <label for="nome">Nome do Funcionário:</label><br>
            <input type="text" id="nome" name="nome" required><br>
            <label for="data_admissao">Data da Admissão:</label><br>
            <input type="date" id="data_admissao" name="data_admissao" required><br>
            <label for="cargo">Cargo:</label><br>
            <select id="cargo" name="cargo" required>
                <option value="gerente">Gerente</option>
                <option value="analista">Analista</option>
                <option value="assistente">Assistente</option>
                <option value="outro">Outro</option>
            </select><br>
            <label for="qtd_salario_minimo">Quantidade de Salário Mínimo:</label><br>
            <input type="number" id="qtd_salario_minimo" name="qtd_salario_minimo" required><br><br>
            <input type="submit" value="Cadastrar">
            <a href="listagem.php" class="btn-voltar">Visualizar demonstrativo de pagamento</a>
            <a href="index.html" >Voltar para o Início</a>
           
        </form>
    </div>
</body>
</html>
