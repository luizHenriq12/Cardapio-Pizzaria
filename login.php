<div class="login-box">
        <h2>Login</h2>
        <form id="loginForm" method="POST">
            <div class="textbox">
                <input type="text" placeholder="Login" name="login" required>
            </div>
            <div class="textbox">
                <input type="password" placeholder="Senha" name="senha" required>
            </div>
            <input type="submit" class="btn" value="Login" name="submit">
            <button class="btn" onclick="entrarComoCliente()">Entrar como cliente</button>
        </form>
    </div>

	<script>
		function entrarComoCliente() {
			window.location.href = 'usuario/index.php';
		}
	</script>

<?php
session_start();
include 'config/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "SELECT id FROM usuarios WHERE login = '$login' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login bem-sucedido, redireciona para a página correta com base no tipo de usuário
        $row = $result->fetch_assoc();
        $_SESSION['usuario_id'] = $row['id'];

        if ($login == 'dono') {
            header("Location: index.php");
        } else {
            header("Location: usuario/index.php");
        }
    } else {
        echo "Login ou senha incorretos!";
    }
}
?>
