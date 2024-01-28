<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>

    <style>
        #addProductModal {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #addProductModal label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        #addProductModal input[type="text"],
        #addProductModal textarea,
        #addProductModal input[type="number"],
        #addProductModal button {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #addProductModal textarea {
            height: 100px;
            resize: vertical;
        }

        #addProductModal button {
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #addProductModal button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    
    <div id="addProductModal" class="modal">
        <form id="addProductForm" method="post" action="adicionar_produto.php">
            <label for="addProductName">Nome:</label>
            <input type="text" id="addProductName" name="nome" required>
                                            
            <label for="addProductImage">URL da Imagem:</label>
            <input type="text" id="addProductImage" name="imagem" required>
           
            <label for="addProductPrice">Preço:</label>
            <input type="number" id="addProductPrice" name="preco" step="0.01" required>
                                            
            <button type="submit" name="adicionar">Adicionar Produto</button>
        </form>
    </div>

    <?php
    include_once '../config/Database.php'; // Caminho para o arquivo Database.php

    $database = new Database();
    $db = $database->getConexao();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['adicionar'])) {
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];
            $imagem = $_POST['imagem'];

            // Preparar a consulta SQL com consultas preparadas (prepared statements) para evitar injeção de SQL
            $query = "INSERT INTO produtos (name, description, price, images, id_categoria, status) VALUES (?, 0, ?, ?, 1, 1)";

            $stmt = $db->prepare($query);

            if ($stmt === false) {
                die(var_dump($db->error)); // Exibir detalhes do erro SQL
            }
            
            // Verificar se a preparação da consulta foi bem-sucedida
            if ($stmt) {
                $stmt->bind_param("ssds", $nome, $preco, $imagem,);
                $stmt->execute();

                // Verificar se a inserção foi realizada com sucesso
                if ($stmt->affected_rows > 0) {
                    echo "Novo produto adicionado com sucesso!";
                } else {
                    echo "Erro ao adicionar o produto.";
                }
            } else {
                echo "Erro na preparação da consulta.";
            }

            // Fechar o statement após o uso
            $stmt->close();
        }
    }
    ?>
</body>
</html>