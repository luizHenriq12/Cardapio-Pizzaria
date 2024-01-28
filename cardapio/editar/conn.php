<?php
session_start();

function setRememberMe($email, $password) {
  $cookie_name = "remember_me_email";
  $cookie_value = $email;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Cookie válido por 30 dias

  $cookie_name = "remember_me_password";
  $cookie_value = $password;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Cookie válido por 30 dias
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
  $servername = "robb0254.publiccloud.com.br";
  $db_username = "calor_developer";
  $db_password = "@Samsung2023";
  $dbname = "calorysistemas_delivery";

  $con = new mysqli($servername, $db_username, $db_password, $dbname);

  if ($con->connect_error) {
      die("Erro na conexão: " . $con->connect_error);
  }

  $email = $_POST['username'];
  $password = $_POST['password'];

  // Consulta preparada para verificar as credenciais do usuário
  $query = "SELECT * FROM login WHERE email=?";
  $stmt = $con->prepare($query);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    // Obtendo a linha do resultado
    $row = $result->fetch_assoc();
    
    // Verificando se a senha fornecida coincide com o hash no banco de dados
    if (password_verify($password, $row['senha'])) {
        // Login correto
        $_SESSION['username'] = $email;
        $_SESSION['nome'] = $row['nomeResp'];
        $_SESSION['logo'] = $row['logo'];
        $_SESSION['nomeFanta'] = $row['nomeFanta']; 
        $_SESSION['id_usuario'] = $row['Id'];

        if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
            // Se a opção 'Lembrar login' estiver marcada, chama a função para configurar os cookies
            setRememberMe($email, $password);
        }

        header("Location: index.php"); // Redireciona para o painel administrativo
        exit;
    }
  }

  // Login ou senha incorretos, redireciona de volta para o formulário de login com uma mensagem de erro
  header("Location: login.php?erro=1");
  exit();

  $con->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tela de Login</title>
  <style>
    
  </style>
</head>
<body>

</body>
</html>
