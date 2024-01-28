<?php
session_start();

if (isset($_GET['erro']) && $_GET['erro'] == 1) {
  echo '<script>alert("Desculpe, o E-MAIL ou a SENHA estão incorretos! \n\nSe não for cadastrado pesso que se cadastre no botão Cadastrar!");</script>';
}

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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tela de Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
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

    .login-box input[type="email"],
    .login-box input[type="password"],
    .login-box input[type="text"] {
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

    .password-container {
      position: relative;
    }

    .password-options {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .remember-password {
      display: flex;
      align-items: center;
    }

    .cadastro {
      color: blue;
    }

    .reset {
      color: blue;
    }

    .toggle-password {
      position: absolute;
      right: 15px;
      top: 45%;
      transform: translateY(-50%);
      cursor: pointer;
    }

    .cadastro:hover, .reset:hover {
      color: red;
    }

    @media only screen and (max-width: 600px) {
      body {
        margin-top: 150px;
      }
      .login-box {
        width: 80%;
      }
      .login-box input[type="email"],
      .login-box input[type="password"],
      .login-box input[type="text"] {
        padding: 8px;
      }
    }
  </style>
</head>
<body>

      <div class="login-box">
        <h2>Login</h2>
        <form id="loginForm" method="POST"> <!-- Corrigido o action para apontar para 'login.php' -->
            <label for="username">E-MAIL:</label><br>
            <input type="email" id="username" name="username" required><br>

            <label for="password">SENHA:</label><br>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <span toggle="#password" class="toggle-password" onclick="togglePasswordVisibility()">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </span>
            </div>
            <br>
            <div class="password-options">
                <div class="remember-password">
                    <input type="checkbox" id="remember" name="remember"> <!-- Checkbox para lembrar login -->
                    <label for="remember">Lembrar login</label>
                </div>
                <p>Cadastre-se: <a href="cadastro.php" class="cadastro">Cadastrar</a></p>
            </div>
            <br>
            <input type="submit" value="Entrar">
        </form>
        <br>
        <p> Não lembra a senha: <a href="reset_password.php" class="reset">Esqueci a senha</a></p>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Executa após a página ser completamente carregada
            var passwordField = document.getElementById("password");
            var toggleIcon = document.querySelector(".toggle-password i");

            // Verifica o estado inicial do campo de senha e ajusta o ícone
            var initialState = localStorage.getItem("passwordVisibility");
            if (initialState === "text") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        });

        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.querySelector(".toggle-password i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
                localStorage.setItem("passwordVisibility", "text");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
                localStorage.setItem("passwordVisibility", "password");
            }
        }
    </script>
</body>
</html>