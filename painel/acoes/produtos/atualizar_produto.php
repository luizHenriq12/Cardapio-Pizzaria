<!-- atualizar_produto.php -->
<?php
// Verifique se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['produto_id'])) {
    session_start(); // Inicia a sessão para manter os dados do usuário
    $servername = "robb0254.publiccloud.com.br";
    $db_username = "calor_developer";
    $db_password = "@Samsung2023";
    $dbname = "calorysistemas_delivery";
    
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
    
    // Receba os dados do formulário
    $produto_id = $_POST['produto_id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];

    // Processar a imagem
    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagem_nome = $_FILES['imagem']['name'];
        $imagem_temp = $_FILES['imagem']['tmp_name'];
        $imagem_destino = "../images/".$imagem_nome; // Substitua pelo caminho desejado
        
        // Move a imagem para o diretório desejado
        move_uploaded_file($imagem_temp, $imagem_destino);
    } else {
        // Se não foi enviado um novo arquivo, mantenha a imagem existente no banco de dados
        $sql_select_imagem = "SELECT images FROM produtos WHERE id=$produto_id";
        $result_select_imagem = $conn->query($sql_select_imagem);
        
        if ($result_select_imagem->num_rows > 0) {
            $row = $result_select_imagem->fetch_assoc();
            $imagem_nome = $row['imagem'];
        }
    }

    // Atualize as informações no banco de dados, incluindo a imagem
    $sql = "UPDATE produtos SET name='$nome', price='$preco', description='$descricao', images='$imagem_nome' WHERE id=$produto_id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Produto atualizado com sucesso!"); window.location.href = "../cadastrar.php";</script>';
    } else {
        echo "Erro ao atualizar o produto: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Erro: Dados do formulário não recebidos.";
}
?>
