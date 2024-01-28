<?php
// Verifica se foi enviado um ID válido via GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Exibição da confirmação de exclusão
    echo "<script>
        let confirmar = confirm('Tem certeza que deseja excluir este produto?');

        if (confirmar) {
            window.location = 'excluir_confirmado.php?id={$id}';
        } else {
            window.location = 'cadastrar.php';
        }
    </script>";
} else {
    echo "ID inválido";
}
?>
