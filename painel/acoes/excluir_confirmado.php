<?php
// Verifica se foi enviado um ID válido via GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Conexão com o banco de dados (substitua essas variáveis pelas suas credenciais)
    $servername = "robb0254.publiccloud.com.br";
    $db_username = "calor_developer";
    $db_password = "@Samsung2023";
    $dbname = "calorysistemas_delivery";
    
    $conexao = new mysqli($servername, $db_username, $db_password, $dbname);

    // Verifica a conexão com o banco de dados
    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Tentativa de exclusão na tabela 'produtos'
    $queryProdutos = "DELETE FROM produtos WHERE id = ?";
    $stmtProdutos = $conexao->prepare($queryProdutos);
    $stmtProdutos->bind_param("i", $id);
    $stmtProdutos->execute();

    // Verifica se a exclusão ocorreu na tabela 'produtos'
    if ($stmtProdutos->affected_rows > 0) {
        echo '<script>alert("Produto excluído com sucesso!"); window.location.href = "cadastrar.php";</script>';
    } else {
        // Tentativa de exclusão na tabela 'montar'
        $queryMontar = "DELETE FROM montar WHERE id = ?";
        $stmtMontar = $conexao->prepare($queryMontar);
        $stmtMontar->bind_param("i", $id);
        $stmtMontar->execute();

        // Verifica se a exclusão ocorreu na tabela 'montar'
        if ($stmtMontar->affected_rows > 0) {
            echo '<script>alert("Produto excluído com sucesso!"); window.location.href = "cadastrar.php";</script>';
        } else {
            // Tentativa de exclusão na tabela 'categorias'
            $queryCategorias = "DELETE FROM categorias WHERE id = ?";
            $stmtCategorias = $conexao->prepare($queryCategorias);
            $stmtCategorias->bind_param("i", $id);
            $stmtCategorias->execute();

            // Verifica se a exclusão ocorreu na tabela 'categorias'
            if ($stmtCategorias->affected_rows > 0) {
                echo '<script>alert("Produto excluído com sucesso!"); window.location.href = "cadastrar.php";</script>';
            } else {
                // Tentativa de exclusão na tabela 'variedades'
                $queryVariedade = "DELETE FROM variedade WHERE id = ?";
                $stmtVariedade = $conexao->prepare($queryVariedade);
                $stmtVariedade->bind_param("i", $id);
                $stmtVariedade->execute();

                // Verifica se a exclusão ocorreu na tabela 'variedades'
                if ($stmtVariedade->affected_rows > 0) {
                    echo '<script>alert("Produto excluído com sucesso!"); window.location.href = "cadastrar.php";</script>';
                } else {
                    echo "Erro ao excluir o produto: " . $conexao->error;
                }

                // Fecha a declaração para a tabela 'variedades'
                $stmtVariedade->close();
            }

            // Fecha a declaração para a tabela 'categorias'
            $stmtCategorias->close();
        }

        // Fecha a declaração para a tabela 'montar'
        $stmtMontar->close();
    }

    // Fecha a declaração para a tabela 'produtos' e a conexão com o banco de dados após a utilização
    $stmtProdutos->close();
    $conexao->close();
} else {
    echo "ID inválido";
}
?>
