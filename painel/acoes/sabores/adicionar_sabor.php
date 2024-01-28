<?
session_start();

$servername = "robb0254.publiccloud.com.br";
$db_username = "calor_developer";
$db_password = "@Samsung2023";
$dbname = "calorysistemas_delivery";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_SESSION['id_usuario'])) {
        $idUsuarioLogado = $_SESSION['id_usuario'];
        if (isset($_POST['adicionar_sabor_borda'])) {
            $nomeSabor = $_POST['nome_sabor'];
            $precoSabor = $_POST['preco_sabor'];
            $logo = $_FILES["logo"]["name"];
            $tipo = $_POST['tipo'];

            $uploadDirectory = "../images/"; // Diretório onde as imagens serão salvas
            $targetFile = $uploadDirectory . basename($_FILES["logo"]["name"]);

            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFile)) {
                echo "Arquivo válido e enviado com sucesso.";
            } else {
                echo "Erro ao enviar arquivo.";
            }

            // Preparar e executar a inserção na tabela de sabores/bordas
            $querySaborBorda = "INSERT INTO montar (nome, price, imagem, id_variedades, status, id_login) VALUES (?, ?, ?, ?, 1, ?)";
            $stmtSaborBorda = $conn->prepare($querySaborBorda);

            if ($stmtSaborBorda === false) {
                die(var_dump($conn->error));
            }

            // Vincule os parâmetros, incluindo o id_login
            $stmtSaborBorda->bind_param("ssssi", $nomeSabor, $precoSabor, $logo, $tipo, $idUsuarioLogado);

                // Executar a consulta
                $stmtSaborBorda->execute();

                // Verificar se a inserção foi bem-sucedida
                if ($stmtSaborBorda->affected_rows > 0) {
                    echo "Novo sabor/borda adicionado com sucesso!";
                } else {
                    echo "Erro ao adicionar o novo sabor/borda.";
                }

                // Fechar o statement
                $stmtSaborBorda->close();
        }
    } else {
        echo "Usuário não está logado."; // Pode tratar isso de forma mais específica conforme sua lógica de autenticação
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>

    <style>
        #addProductModal {
            font-family: Arial, sans-serif;
            max-width: 900px;
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

        select {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px; /* Ajuste conforme necessário */
            margin-bottom: 10px;
            /* Adicione outros estilos conforme desejado */
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            background-color: #007bff; /* Cor de fundo do botão */
            color: white; /* Cor do texto do botão */
            cursor: pointer;
            /* Adicione outros estilos conforme desejado */
        }

            /* Estilo para quando o cursor está sobre o botão */
        input[type="submit"]:hover {
            background-color: #0056b3; /* Cor de fundo alterada no hover */
        }

        h2 {
            text-align: center;
            margin-top: 0;
        }

        .form-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .form-container form {
            width: 100%; /* Ajuste conforme necessário */
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
    
    <div id="addProductModal" class="modal">
        <div class="form-container">
            <h2>SABORES E BORDAS</h2><br><br>
            <form method="post" enctype="multipart/form-data">
                <!-- Campos para os sabores e bordas -->
                <label for="nome_sabor">Nome do Sabor/Borda:</label>
                <input type="text" name="nome_sabor" id="nome_sabor" required><br><br>

                <label for="preco_sabor">Preço do Sabor/Borda:</label>
                <input type="text" name="preco_sabor" id="preco_sabor" required><br><br>

                <label for="logo">Logo:</label>
                <input type="file" name="logo" id="logo" required><br><br>
                
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo">
                    <option value="1">Sabor Doce</option>
                    <option value="2">Sabor Salgado</option>
                    <option value="4">Borda</option>
                </select><br><br>
                
                <input type="submit" name="adicionar_sabor_borda" value="Adicionar Sabor/Borda">
            </form>
        </div>
    </div>
</body>
</html>