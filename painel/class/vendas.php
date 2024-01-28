<!DOCTYPE html>
<html>
<head>
    <title>Lista de Vendas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            margin-right: 20px;
            margin: 5px;
            font-size: 20px;
            background-color: red;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .back-button:hover {
            transform: translateX(5px);
        }

    </style>
</head>
<body>

<a href="../index.php" class="back-button" style="background-color: red; color: #fff;">↩Voltar</a>

<div class="tabela"></div>
<?php

session_start();

$servername = "robb0254.publiccloud.com.br";
$db_username = "calor_developer";
$db_password = "@Samsung2023";
$dbname = "calorysistemas_delivery";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
// Consulta para obter todas as vendas da tabela pedidosvendas
$query = "SELECT * FROM pedidosvendas WHERE id_login = ?";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Exibir os resultados em uma tabela
    echo "<table>
            <tr>
                <th>Item ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Nome do Cliente</th>
                <th>Contato do Cliente</th>
                <th>Endereço do Cliente</th>
                <th>Opção de Pagamento</th>
                <th>Observação</th>
                <th>Data do Pedido</th>
                <th>ID do Pedido</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['item_id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['price'] . "</td>
                <td>" . $row['cliente_nome'] . "</td>
                <td>" . $row['cliente_contato'] . "</td>
                <td>" . $row['cliente_endereco'] . "</td>
                <td>" . $row['cliente_opc_pgt'] . "</td>
                <td>" . $row['observacao'] . "</td>
                <td>" . $row['order_date'] . "</td>
                <td>" . $row['order_id'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum resultado encontrado.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
</div>
</body>
</html>
