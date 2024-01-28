<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produtos</title>

    <style>
        /* Estilos para a página de edição de produtos */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        #editProductModal {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #editProductModal label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        #editProductModal input[type="text"],
        #editProductModal textarea,
        #editProductModal input[type="number"],
        #editProductModal button {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #editProductModal textarea {
            height: 100px;
            resize: vertical;
        }

        #editProductModal button {
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #editProductModal button:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <div id="editProductModal" class="modal">
        <form id="editProductForm" method="post" action="editar_produto.php">
            <input type="hidden" id="editProductId" name="id" value="">
            <label for="editProductName">Nome:</label>
            <input type="text" id="editProductName" name="nome" required>
                                            
            <label for="editProductImage">URL da Imagem:</label>
            <input type="text" id="editProductImage" name="imagem" required>
                                            
            <label for="editProductDescription">Numeração:</label>
            <textarea id="editProductDescription" name="descricao" required readonly>1</textarea>
                                            
            <label for="editProductPrice">Preço:</label>
            <input type="number" id="editProductPrice" name="preco" step="0.01" required>
                                            
            <button type="submit" name="editar">Salvar Alterações</button>
        </form>
    </div>
    <!-- Adicione este script no final do seu arquivo HTML, antes do fechamento da tag body -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editLinks = document.querySelectorAll(".editLink");

            editLinks.forEach(link => {
                link.addEventListener("click", function(event) {
                    event.preventDefault(); // Evita o comportamento padrão do link (navegar para outra página)

                    const productId = this.getAttribute("data-id");
                    fetch(`editar_produto.php?id=${productId}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('editProductName').value = data.nome;
                            document.getElementById('editProductImage').value = data.imagem;
                            document.getElementById('editProductDescription').value = data.descricao;
                            document.getElementById('editProductPrice').value = data.preco;
                            document.getElementById('editProductId').value = productId;
                        })
                        .catch(error => console.error('Erro:', error));
                });
            });
        });
    </script>


    <?php
include_once '../config/Database.php';

$database = new Database();
$db = $database->getConexao();

if ($db->connect_error) {
    die("Erro na conexão com o banco de dados: " . $db->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $db->prepare($query);

    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $db->error);
    }

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $produto = $result->fetch_assoc();
            $nome = $produto['name']; // Corrigido para 'nome'
            $descricao = $produto['description']; // Corrigido para 'descricao'
            $preco = $produto['price']; // Corrigido para 'preco'
            $imagem = $produto['images']; // Corrigido para 'imagem'
        
            echo "
            <script>
                document.getElementById('editProductName').value = '$nome';
                document.getElementById('editProductImage').value = '$imagem';
                document.getElementById('editProductDescription').value = '$descricao';
                document.getElementById('editProductPrice').value = '$preco';
                document.getElementById('editProductId').value = '$id';
            </script>
            ";
        } else {
            echo "Produto não encontrado.";
        }
    } else {
        echo "Erro na preparação da consulta.";
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['editar'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $imagem = $_POST['imagem'];

        $query = "UPDATE produtos SET name=?, price=?, description=?, images=? WHERE id=?";
        $stmt = $db->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ssdsi", $nome, $preco, $descricao, $imagem, $id);// Ajustar os tipos de dados e a ordem
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Produto atualizado com sucesso!";
            } else {
                echo "Erro ao atualizar o produto: " . $stmt->error;
            }
        } else {
            echo "Erro na preparação da consulta.";
        }

        $stmt->close();
    }
}
?>
</body>
</html>