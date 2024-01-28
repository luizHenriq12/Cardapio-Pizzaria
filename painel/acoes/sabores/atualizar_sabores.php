<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "robb0254.publiccloud.com.br";
    $db_username = "calor_developer";
    $db_password = "@Samsung2023";
    $dbname = "calorysistemas_delivery";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $Id = $_POST['Id'];
    $nome = $_POST['nome'];
    $price = $_POST['price'];

    // Verificar se uma nova imagem foi enviada
    if ($_FILES['imagem']['error'] == 0) {
        $imagem = $_FILES['imagem']['name'];
        $imagem_tmp = $_FILES['imagem']['tmp_name'];
        $destino = "../images/" . $imagem;
        move_uploaded_file($imagem_tmp, $destino);

        // Atualizar os dados do produto, incluindo a nova imagem
        $sql = "UPDATE montar SET nome='$nome', price='$price', imagem='$destino' WHERE Id='$Id'";
    } else {
        // Se nenhuma nova imagem foi enviada, atualizar apenas os dados textuais
        $sql = "UPDATE montar SET nome='$nome', price='$price' WHERE Id='$Id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Produto atualizado com sucesso!"); window.location.href = "../cadastrar.php";</script>';
    } else {
        echo "Erro ao atualizar o produto: " . $conn->error;
    }

    $conn->close();
}
?>
