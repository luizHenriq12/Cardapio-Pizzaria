<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        textarea,
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
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
    <a href="../cadastrar.php" class="back-button" style="background-color: red; color: #fff;">↩Voltar</a>
    <div class="container">
        <?php
        // Verificar se foi enviado um ID válido via GET
        if(isset($_GET['id'])) {
            session_start(); // Inicia a sessão para manter os dados do usuário
            $servername = "robb0254.publiccloud.com.br";
            $db_username = "calor_developer";
            $db_password = "@Samsung2023";
            $dbname = "calorysistemas_delivery";
            
            $conn = new mysqli($servername, $db_username, $db_password, $dbname);
            
            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }
            

            // Prepare e execute a consulta SQL para obter as informações do sabor ou borda
            $sabor_borda_Id = $_GET['id'];
            $sql = "SELECT * FROM montar WHERE Id = $sabor_borda_Id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Exibir o formulário com os dados do sabor ou borda para edição
                $row = $result->fetch_assoc();
        ?>
                <form action="atualizar_sabores.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="Id" value="<?php echo $row['Id']; ?>">
                    Nome: <input type="text" name="nome" value="<?php echo $row['nome']; ?>"><br>
                    Preço: <input type="text" name="preco" value="<?php echo $row['price']; ?>"><br>
                    Imagem: <input type="file" name="imagem"><br>
                    <input type="submit" value="Editar Sabor/Borda">
                </form>
        <?php
            } else {
                echo "Nenhum sabor ou borda encontrado com o ID fornecido.";
            }
            $conn->close();
        } else {
            echo "ID do sabor ou borda não fornecido.";
        }
        ?>
    </div>
</body>
</html>
