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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $novo_status = $_POST['novo_status'];

    $queryUpdate = "UPDATE login SET aberta = ? WHERE id = ?";
    $stmt = $conn->prepare($queryUpdate);
    $stmt->bind_param("ii", $novo_status, $id_usuario);
    $stmt->execute();

    // Redirecionar de volta ao painel após atualizar o status
    header("Location: ../index.php");
    exit();
}
?>
