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

    $Id = $_POST['Id']; // Ajuste para corresponder ao nome do campo enviado pelo formulário
    $nome = $_POST['nome'];

    $sql = "UPDATE variedade SET nome='$nome' WHERE Id='$Id'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Categoria atualizada com sucesso!"); window.location.href = "../cadastrar.php";</script>';
    } else {
        echo "Erro ao atualizar a categoria: " . $conn->error;
    }

    $conn->close();
}
?>
