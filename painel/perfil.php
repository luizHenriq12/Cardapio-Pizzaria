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
            margin-top: 20px;
            border-radius: 10px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 20px;
            width: 50%;
            margin: 5px;
            border-radius: 10px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        table img {
            max-width: 100%;
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

        .info-container {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            overflow: hidden;
        }
        .info-container h3 {
            margin-top: 0;
        }
        .info-container img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .tabelaPerfil {
            border-radius: 10px;
            margin-top: 5px;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            margin-right: 20px;
            margin: 5px;
            font-size: 20px;
            background-color: red;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .back-button:hover {
            transform: translateX(5px);
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

            <li>
                <a href="">
                    <i class='fas fa-user'></i>
                    <span class="btn-text">Perfil</span>
                </a>
            </li>

            <li>
                <a href="./index.php">
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
            <a href="./index.php" class="back-button" style="background-color: red; color: #fff;">↩Voltar</a>
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

            <h2>Seu Perfil</h2>

            <table id="tabelaPerfil">
                <tr>
                    <th>Suas Informações</th>
                </tr>
                <?php
                // Executar a consulta para obter os produtos
                $query_products = "SELECT * FROM login WHERE id = ?";
                $stmt = $conn->prepare($query_products);
                $stmt->bind_param("i", $id_login);
                $stmt->execute();
                $result_products = $stmt->get_result();

                if ($result_products->num_rows > 0) {
                    while ($row = $result_products->fetch_assoc()) {

                        echo "<tr>";
                        echo "<td><strong>Nome do Responsável:</strong> " . $row['nomeResp'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>CPF do Responsável:</strong> " . $row['cpfResp'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Celular do Responsável:</strong> " . $row['celularResp'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Data de Nascimento do Responsável:</strong> " . $row['dataNaciResp'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Razão Social:</strong> " . $row['nome'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Nome Fantasia:</strong> " . $row['nomeFanta'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Telefone da Empresa:</strong> " . $row['telefone'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>CNPJ:</strong> " . $row['cnpj'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Inscrição Estadual:</strong> " . $row['inscricaoEstadual'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Endereço:</strong> " . $row['endereco'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Cidade:</strong> " . $row['cidade'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Estado:</strong> " . $row['estado'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Logo:</strong> <img src='" . $row['logo'] . "' alt='Logo' style='max-width: 100px; max-height: 100px;'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Nenhum perfil encontrado.</td></tr>";
                }
                ?>
            </table>

</body>
</html>