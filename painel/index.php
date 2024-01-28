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
// O ! inverte a situacao da sessao.
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            background-color: #f0f8ff;
            min-height: 100vh;
            width: 15%; /* Utilizando porcentagem para a largura */
            max-width: 300px; /* Limitando a largura máxima */
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
            border-bottom: 1px solid #ccc; /* Adiciona uma linha de divisão entre os itens */
        }

        .sidebar ul li a {
            text-decoration: none;
            color: black;
            display: block;
            transition: background-color 0.3s ease; /* Adiciona transição para o efeito de hover */
        }

        .sidebar ul li:hover {
            background-color: #f0f0f0; /* Cor de fundo ao passar o mouse */
        }

        .main-content {
            margin-left: 15%; /* Ajustando o espaço para o conteúdo principal */
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

        table img {
            max-width: 100px; /* Defina o tamanho máximo desejado */
            max-height: 100px; /* Defina o tamanho máximo desejado */
            width: auto;
            height: auto;
        }

        .sidebar img {
            max-width: 30%;
            height: auto;
            max-height: 100px; /* Defina a altura máxima desejada */
            margin: 5px auto 10px; /* Centraliza a imagem horizontalmente e adiciona espaçamento abaixo */
            display: block;
            border-radius: 50px;
        }

        .sidebar h2 {
            max-width: 80%;
            height: auto;
            max-height: 100px; /* Defina a altura máxima desejada */
            margin: 5px auto 10px; /* Centraliza a imagem horizontalmente e adiciona espaçamento abaixo */
            display: block;
            text-align: center;
            border-bottom: 5px solid #ccc; /* Adiciona uma linha de divisão entre os itens */
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

        button[type='submit'][data-status='aberta'] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: red;
            color: white;
            transition: background-color 0.3s ease;
        }

        /* Botões quando a pizzaria está fechada */
        button[type='submit'][data-status='fechada'] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: blue;
            color: white;
            transition: background-color 0.3s ease;
        }

        /* Efeito hover para ambos os estados */
        button[type='submit'][data-status='aberta']:hover,
        button[type='submit'][data-status='fechada']:hover {
            background-color: white;
            color: blue; /* Altere para a cor desejada ao passar o mouse */
        }

        @media screen and (max-width: 768px) {
            .sidebar {
                width: 100%;
                max-width: none;
                position: static;
                height: 10px;
            }

            .main-content {
                margin-left: 0; /* Conteúdo principal ocupará toda a largura */
            }

        }
    </style>
</head>
<body>
    <div class="sidebar">
        <?php if(isset($_SESSION['logo'])): ?>
            <img src="<?php echo $_SESSION['logo']; ?>" alt="Logo">
        <?php endif; ?>

        <?php if(isset($_SESSION['nomeFanta'])): ?>
            <h2><?php echo $_SESSION['nomeFanta']; ?></h2>
        <?php endif; ?>
    
        <!-- Links da barra lateral -->
        <ul>
            <li>
                <?php
                // Verificar e exibir o botão para controlar o status de abertura/fechamento
                $queryStatus = "SELECT aberta FROM login WHERE id = ?";
                $stmtStatus = $conn->prepare($queryStatus);
                $stmtStatus->bind_param("i", $id_login);
                $stmtStatus->execute();
                $resultStatus = $stmtStatus->get_result();

                if ($resultStatus->num_rows > 0) {
                    $pizzariaStatus = $resultStatus->fetch_assoc();
                    $aberta = $pizzariaStatus['aberta'];
                    $acao = $aberta == 1 ? 'fechar' : 'abrir';
                    $textoAcao = $aberta == 1 ? 'Fechar' : 'Abrir';

                    $status = $aberta == 1 ? 'aberta' : 'fechada';

                    echo "<form method='POST' action='./acoes/alterar_status.php'>"; // Supondo que o arquivo para processar essa ação seja 'alterar_status.php'
                    echo "<input type='hidden' name='id_usuario' value='$id_login'>";
                    echo "<input type='hidden' name='novo_status' value='" . ($aberta == 1 ? 0 : 1) . "'>";
                    echo "<button type='submit' name='submit' data-status='$status'><i class='fas fa-store'></i> $textoAcao Estabelecimento</button>";
                    echo "</form>";
                }
                ?>
            </li>

            <li>
                <a href="./perfil.php">
                    <i class='fas fa-user'></i>
                    <span class="btn-text">Perfil</span>
                </a>
            </li>

            <li>
                <a href="">
                    <i class='fas fa-home'></i>
                    <span class="btn-text">Home</span>
                </a>
            </li>
            <li>
                <a href="./acoes/cadastrar.php">
                    <i class='fas fa-file-alt'></i>
                    <span class="btn-text">Cadastro</span>
                </a>
            </li>
            <li>
                <a href="./class/vendas.php">
                    <i class='fas fa-list'></i>
                    <span class="btn-text">Pedidos</span>
                </a>
            </li>
            <li>
                <a href="./legout.php">
                    <i class='fas fa-arrow-left'></i>
                    <span class="btn-text">Logout</span>
                </a>
            </li>
        </ul>

    </div>

    <div class="main-content">
        <!-- Listagem de produtos -->
        <div class="content">
            <?php
                
                // Verificar se o usuário está logado
                if (isset($_SESSION['username'])) {
                    // Exibir mensagem de boas-vindas com o nome do usuário
                    echo "<h2>Bem-vindo, " . $_SESSION['nome'] . "!</h2>";
                } else {
                    // Se não estiver logado, redirecionar para a página de login
                    header("Location: login.php");
                    exit();
                }
            ?>

            <h2>Produtos Cadastrados</h2>
            <ul>
                <li><button class="mostrar" onclick="mostrarProdutos('produtos')">Produtos</button></li>
                <li><button class="mostrar" onclick="mostrarProdutos('sabores')">Sabores</button></li>
                <li><button class="mostrar" onclick="mostrarProdutos('bordas')">Bordas</button></li>
            </ul>

            <table id="tabelaProdutos">
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                </tr>
                <?php
                // Executar a consulta para obter os produtos
                $query_products = "SELECT * FROM produtos WHERE id_categoria IN (1, 3, 4) AND id_login = ? ORDER BY
                    CASE 
                        WHEN id_categoria = 1 THEN 1
                        WHEN id_categoria = 3 THEN 2
                        WHEN id_categoria = 4 THEN 3
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
                        echo "<tr>";
                        echo "<td><img src='./images/" . $row['images'] . "' alt=''></td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $categories[$row['id_categoria']] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum produto cadastrado.</td></tr>";
                }
                ?>
            </table>


            <table id="tabelaSabores" style="display:none;">
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Preço</th>
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
                        echo "<td><img src='./images/" . $row['imagem'] . "' alt=''></td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
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
                        echo "<td><img src='./images/" . $row['imagem'] . "' alt=''></td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                    
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum produto cadastrado.</td></tr>";
                }
                ?>
            </table>

            <script>
                function mostrarProdutos(tipo) {
                    if (tipo === 'produtos') {
                        document.getElementById('tabelaProdutos').style.display = 'block';
                        document.getElementById('tabelaSabores').style.display = 'none';
                        document.getElementById('tabelaBordas').style.display = 'none';
                    } else if (tipo === 'sabores') {
                        document.getElementById('tabelaProdutos').style.display = 'none';
                        document.getElementById('tabelaSabores').style.display = 'block';
                        document.getElementById('tabelaBordas').style.display = 'none';
                    }else if (tipo === 'bordas') {
                        document.getElementById('tabelaProdutos').style.display = 'none';
                        document.getElementById('tabelaSabores').style.display = 'none';
                        document.getElementById('tabelaBordas').style.display = 'block';
                    }
                }
            </script>
</body>
</html>