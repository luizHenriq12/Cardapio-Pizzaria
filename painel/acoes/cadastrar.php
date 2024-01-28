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

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Obtém o ID do usuário logado
$id_login = $_SESSION['id_usuario'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            background-color: #f0f8ff;
            height: 100vh;
            width: 200px;
            position: fixed;
            left: 0;
            top: 0;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: black;
            display: block;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li:hover {
            background-color: #f0f0f0;
        }

        .main-content {
            margin-left: 200px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }

        #tabelaProdutos {
        width: 100%;
        }

        #tabelaSabores {
            width: 50%;
        }

        #tabelaBordas {
            width: 50%;
        }

        #tabelaCategoria {
            width: 30%; /* Exemplo de largura específica para a tabela de categorias */
        }

        #tabelaVariedades {
            width: 30%; /* Exemplo de largura específica para a tabela de variedades */
        }

        .botaoCadastrar {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: 2px solid #3498db;
            border-radius: 5px;
            cursor: pointer;
        }

        .botaoCadastrar:hover{
            background-color: #fff;
            color: #3498db;
        }

        .content h2 {
            margin-top: 10px;
        }

        table img {
            max-width: 100px;
            max-height: 100px;
            width: auto;
            height: auto;
        }

        .mostrar {
            padding: 8px 16px;
            font-size: 14px;
            border: 2px solid #FF0000;
            background-color: #FF0000;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            width: 100px; /* largura fixa */
            display: block; /* torna os botões blocos para separá-los */
            margin-bottom: 5px;
            border-radius: 5px;
        }

        button:hover {
            background-color: #fff;
            color: #FF0000;
        }

        td a {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 4px;
        text-decoration: none;
        transition: color 0.3s ease, background-color 0.3s ease, border-color 0.3s ease;
    }

    /* Estilo para o link Editar */
    td a[href*="editar_produto.php"] {
        background-color: #ffc107;
        color: #000;
        border: 1px solid #ffc107;
    }

    /* Estilo para o link Excluir */
    td a[href*="excluir_produto.php"] {
        background-color: #dc3545;
        color: #000;
        border: 1px solid #dc3545;
    }

    /* Efeito de hover para os links */
    td a:hover {
        color: #fff;
    }

    td a[href*="editar_produto.php"]:hover {
        background-color: #ffda80;
        border-color: #ffda80;
    }

    td a[href*="excluir_produto.php"]:hover {
        background-color: #ff5262;
        border-color: #ff5262;
    }

    td a[href*="editar_sabores.php"] {
        background-color: #ffc107;
        color: #000;
        border: 1px solid #ffc107;
    }

    td a[href*="editar_categoria.php"] {
        background-color: #ffc107;
        color: #000;
        border: 1px solid #ffc107;
    }

    td a[href*="editar_categoria.php"]:hover {
        background-color: #ffda80;
        border-color: #ffda80;
    }

    td a[href*="editar_variedade.php"] {
        background-color: #ffc107;
        color: #000;
        border: 1px solid #ffc107;
    }

    td a[href*="editar_variedade.php"]:hover {
        background-color: #ffda80;
        border-color: #ffda80;
    }

    /* Efeito de hover para os links */
    td a:hover {
        color: #fff;
    }

    td a[href*="editar_sabores.php"]:hover {
        background-color: #ffda80;
        border-color: #ffda80;
    }
    #opcoes button {
        background-color: #3498db;
        color: white;
        padding: 10px 20px;
        border: 2px solid #3498db;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 10px;
    }

    #opcoes button:hover {
        background-color: #fff;
        color: #3498db;
    }
    </style>
</head>
<body>
    <div class="sidebar">

        <?php if(isset($_SESSION['nomeFanta'])): ?>
            <h2><?php echo $_SESSION['nomeFanta']; ?></h2>
        <?php endif; ?>
        <!-- Links da barra lateral -->
        <ul>
            <li><a href="../perfil.php"><i class='fas fa-user'></i><span class="btn-text">Perfil</span></a>
            </li>
            <li><a href="../index.php"><i class='fas fa-home'></i> Home</a></li>
            <li><a href=""><i class='fas fa-file-alt'></i> Cadastro</a></li>
            <li><a href="../class/vendas.php"><i class='fas fa-list'></i> Pedidos</a></li>
            <li><a href="../legout.php"><i class='fas fa-arrow-left'></i> Logout</a></li>
        </ul>
    </div>

    <!-- Conteúdo principal -->
    <div class="main-content">
        <!-- Listagem de produtos -->
        <div class="content">
        <h2>Produtos Cadastrados</h2>

        <!-- Botão para exibir as opções -->
        <button class="botaoCadastrar" onclick="toggleOpcoes()">Adicionar</button><br><br>

        <!-- Menu de opções oculto por padrão -->
        <div id="opcoes" style="display: none;">
            <button onclick="redirecionar('./produtos/adicionar_produto.php')">Adicionar Produtos</button><br><br>
            <button onclick="redirecionar('./sabores/adicionar_sabor.php')">Adicionar Sabores</button><br><br>
            <button onclick="redirecionar('./categoria/adicionar_categoria.php')">Adicionar Categoria</button><br><br>
            <button onclick="redirecionar('./variedade/adicionar_variedade.php')">Adicionar Variedade</button><br><br>
        </div>

        <script>
            // Função para alternar a visibilidade do menu de opções
            function toggleOpcoes() {
                var opcoes = document.getElementById('opcoes');
                if (opcoes.style.display === 'none') {
                    opcoes.style.display = 'block';
                } else {
                    opcoes.style.display = 'none';
                }
            }

            // Função para redirecionar para a página selecionada
            function redirecionar(pagina) {
                window.location.href = pagina;
            }
        </script>

            <ul>
                <li><button class="mostrar" onclick="mostrarProdutos('produtos')">Produtos</button></li>
                <li><button class="mostrar" onclick="mostrarProdutos('sabores')">Sabores</button></li>
                <li><button class="mostrar" onclick="mostrarProdutos('bordas')">Bordas</button></li>
                <li><button class="mostrar" onclick="mostrarProdutos('categoria')">Categorias</button></li>
                <li><button class="mostrar" onclick="mostrarProdutos('variedades')">Variedades</button></li>
            </ul>

            <table id="tabelaProdutos">
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
                <?php
                // Executar a consulta para obter os produtos
                $query_products = "SELECT * FROM produtos WHERE id_categoria IN (1, 4, 5) AND id_login = ? ORDER BY
                CASE 
                    WHEN id_categoria = 1 THEN 1
                    WHEN id_categoria = 4 THEN 2
                    WHEN id_categoria = 5 THEN 3
                END";            
                $stmt = $conn->prepare($query_products);
                $stmt->bind_param("i", $id_login);
                $stmt->execute();
                $result_products = $stmt->get_result();

                $categories = array(
                    1 => 'Bebidas',
                    3 => 'Pizzas',
                    4 => 'Combos'
                );

                if ($result_products->num_rows > 0) {
                    while ($row = $result_products->fetch_assoc()) {
                        // Aqui, você deve substituir pelos nomes corretos das colunas da sua tabela de produtos
                        echo "<tr>";
                        echo "<td><img src='../images/" . $row['images'] . "' alt=''></td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $categories[$row['id_categoria']] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        
                         //Adicione as ações conforme necessário (editar, excluir)
                        echo "<td>
                               <a href='./produtos/editar_produto.php?id=" . $row['id'] . "'>Editar</a>
                               <a href='excluir_produto.php?id=" . $row['id'] . "'>Excluir</a>
                               </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum produto cadastrado.</td></tr>";
                }
                ?>
            </table>

            <table id="tabelaSabores" style="display:none;">
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
                <?php
                // Executar a consulta para obter os produtos
                $query_products = "SELECT * FROM montar WHERE id_variedades IN (1, 2) AND id_login = ? ORDER BY
                CASE 
                    WHEN id_variedades = 2 THEN 1
                    WHEN id_variedades = 1 THEN 2
                END";            
                $stmt = $conn->prepare($query_products);
                $stmt->bind_param("i", $id_login);
                $stmt->execute();
                $result_products = $stmt->get_result();

                if ($result_products->num_rows > 0) {
                    while ($row = $result_products->fetch_assoc()) {
                        // Aqui, você deve substituir pelos nomes corretos das colunas da sua tabela de produtos
                        echo "<tr>";
                        echo "<td><img src='../images/" . $row['imagem'] . "' alt=''></td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        
                         //Adicione as ações conforme necessário (editar, excluir)
                         echo "<td>
                                    <a href='./sabores/editar_sabores.php?id=" . $row['Id'] . "'>Editar</a>
                                    <a href='excluir_produto.php?id=" . $row['Id'] . "'>Excluir</a>
                                </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum produto cadastrado.</td></tr>";
                }
                ?>
            </table>

            <table id="tabelaBordas" style="display:none;">
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
                <?php
                // Executar a consulta para obter os produtos
                $query_products = "SELECT * FROM montar WHERE id_variedades IN (4) AND id_login = ? ORDER BY
                CASE 
                    WHEN id_variedades = 4 THEN 1
                END";            
                $stmt = $conn->prepare($query_products);
                $stmt->bind_param("i", $id_login);
                $stmt->execute();
                $result_products = $stmt->get_result();

                if ($result_products->num_rows > 0) {
                    while ($row = $result_products->fetch_assoc()) {
                        // Aqui, você deve substituir pelos nomes corretos das colunas da sua tabela de produtos
                        echo "<tr>";
                        echo "<td><img src='../images/" . $row['imagem'] . "' alt=''></td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        
                         //Adicione as ações conforme necessário (editar, excluir)
                         echo "<td>
                                    <a href='./sabores/editar_sabores.php?id=" . $row['Id'] ."'>Editar</a>
                                    <a href='excluir_produto.php?id=" . $row['Id'] . "'>Excluir</a>
                                </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum produto cadastrado.</td></tr>";
                }
                ?>
            </table>

            <table id="tabelaCategoria" style="display:none;">
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
                <?php
                // Executar a consulta para obter os produtos
                $query_products = "SELECT * FROM categorias WHERE id_login = ?";         
                $stmt = $conn->prepare($query_products);
                $stmt->bind_param("i", $id_login);
                $stmt->execute();
                $result_products = $stmt->get_result();

                if ($result_products->num_rows > 0) {
                    while ($row = $result_products->fetch_assoc()) {
                        // Aqui, você deve substituir pelos nomes corretos das colunas da sua tabela de produtos
                        echo "<tr>";
                        echo "<td>" . $row['nome'] . "</td>";
                        
                         //Adicione as ações conforme necessário (editar, excluir)
                         echo "<td>
                                    <a href='./categoria/editar_categoria.php?id=" . $row['id'] . "'>Editar</a>
                                    <a href='excluir_produto.php?id=" . $row['id'] . "'>Excluir</a>
                                </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhuma categoria cadastrado.</td></tr>";
                }
                ?>
            </table>

            <table id="tabelaVariedades" style="display:none;">
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
                <?php
                    // Executar a consulta para obter as variedades
                    $query_variedades = "SELECT * FROM variedade WHERE id_login = ?";
                    $stmt_variedades = $conn->prepare($query_variedades);
                    $stmt_variedades->bind_param("i", $id_login);
                    $stmt_variedades->execute();
                    $result_variedades = $stmt_variedades->get_result();

                    if ($result_variedades->num_rows > 0) {
                        while ($row = $result_variedades->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['nome'] . "</td>";
                            echo "<td>
                                    <a href='./variedade/editar_variedade.php?id=" . $row['Id'] . "'>Editar</a>
                                    <a href='excluir_produto.php?id=" . $row['Id'] . "'>Excluir</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>Nenhuma variedade cadastrada.</td></tr>";
                    }
                ?>
            </table>


            <script>
                function mostrarProdutos(tipo) {
                    const tabelas = ['Produtos', 'Sabores', 'Bordas', 'Categoria', 'Variedades'];
                    tabelas.forEach(tabela => {
                        const elementoTabela = document.getElementById(`tabela${tabela}`);
                        if (tipo.toLowerCase() === tabela.toLowerCase()) {
                            elementoTabela.style.display = 'table';
                            if (tipo.toLowerCase() === 'variedades') {
                                verificaConsultaVariedades();
                            }
                        } else {
                            elementoTabela.style.display = 'none';
                        }
                    });
                }

                function verificaConsultaVariedades() {
                    // Executar a mesma consulta que na tabela de variedades
                    fetch('cadastrar.php') // Substitua pelo arquivo que executa a consulta SQL para variedades
                        .then(response => response.json())
                        .then(data => {
                            console.log('Quantidade de resultados:', data.length);
                        })
                        .catch(error => {
                            console.error('Erro ao verificar as variedades:', error);
                        });
                }

            </script>
        </div>
    </div>
</body>
</html>