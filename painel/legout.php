<?php
// Inicia a sessão (caso não tenha sido iniciada ainda)
session_start();

// Encerra a sessão
session_unset();
session_destroy();

// Redireciona de volta para a tela de login
header("Location: ./login.php");
exit();
?>
