<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['new_password'])) {
    $servername = "robb0254.publiccloud.com.br";
    $db_username = "calor_developer";
    $db_password = "@Samsung2023";
    $dbname = "calorysistemas_delivery";

    $con = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($con->connect_error) {
        die("Erro na conexão: " . $con->connect_error);
    }

    $username = $con->real_escape_string($_POST['username']); // Prevenção contra SQL injection
    $new_password = $con->real_escape_string($_POST['new_password']); // Nova senha

    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Atualiza a senha no banco de dados
    $query = "UPDATE login SET senha='$new_password' WHERE email='$username'"; // Supondo que o campo email seja usado para o login
    $result = $con->query($query);

    if ($result) {
        // Senha atualizada com sucesso
        echo "<script>alert('Senha alterada com sucesso!');</script>";
        header("Location: login.php"); // Redireciona de volta para o login
        exit();
    } else {
        // Erro ao atualizar a senha
        echo "<script>alert('Erro ao alterar a senha. Tente novamente.');</script>";
    }

    $con->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Resetar Senha</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, red, yellow);
            text-align: center;
            margin-top: 100px;
        }
        .login-box {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .login-box input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 3px;
            background: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .login-box input[type="submit"]:hover {
            background: #0056b3;
        }
        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<div class="login-box">
        <h2>Resetar Senha</h2>
        <form action="reset_password.php" method="post">
            <label for="username">E-mail:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="new_password">Nova Senha:</label><br>
            <input type="password" id="new_password" name="new_password" required><br><br>
            <input type="submit" value="Redefinir Senha">
            <a href="login.php"><button type="button">Cancelar</button></a> <!-- Botão de cancelar -->
        </form>
    </div>
</body>
</html>
