<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cardapio Digital Pizzaria do Luiz</title>
<link rel="stylesheet" type="text/css" href="css/foods.css">
<link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
<!--INICIO CSS ICONES MAYKONSILVEIRA.COM.BR-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!--INICIO CSS SLIDE MAYKONSILVEIRA.COM.BR-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<?php include('inc/container.php'); ?>

<style>
	.img-fluid {
		width: 100%; /* Tamanho máximo para as imagens */
		height: auto; /* Mantém a proporção da imagem */
		display: block; /* Garante que as imagens se comportem corretamente */
		margin: 0 auto; /* Centraliza a imagem horizontalmente */
		border-radius: 5px; /* Borda arredondada */
	}

	/* Estilo para o contêiner dos produtos */
	.mypanel {
		padding: 20px; /* Espaçamento interno para as informações dos produtos */
		text-align: center; /* Centraliza o texto */
		border-radius: 7px; /* Borda arredondada */
		margin-bottom: 20px; /* Espaço entre os produtos */
		background: #fff;
		border: 2px solid red;
	}

	h4{
		padding: 10px; /* Espaçamento interno */
		background-color: red; /* Fundo vermelho */
		color: white; /* Texto branco */
		font-family: Arial, sans-serif; /* Fonte Arial */
		border-radius: 5px;
		width: 40%;
		margin: 20px auto;
	}

	
	.text-center {
		display: flex;
		justify-content: center;
		align-items: center;
		margin-top: 0 auto; 
	}

	#pizzas .col-md-3 {
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh; /* Isso garante que a div ocupe a altura total da tela */
		margin: 0 auto; /* Isso centraliza a div na horizontal */
	}

	#pizzas .mypanel {
		text-align: center;
	}

	#combos .col-md-3 {
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh; /* Isso garante que a div ocupe a altura total da tela */
		margin: 0 auto; /* Isso centraliza a div na horizontal */
	}

	#combos .mypanel {
		text-align: center;
	}

	#toggleBebidas {
        width: 60%;
		margin: 20px auto;
		color: #fff;
		background: blue;
	}

	header {
        background-color: <?php echo $headerBackgroundColor; ?>;
    }

	#editForm {
        display: none;
    }

	.editHeader {
    	display: block;
	}

	header button {
		background-color: #ff5733;
		color: #fff;
		border: none;
		padding: 6px 12px;
		font-size: 14px;
		cursor: pointer;
		border-radius: 4px;
		transition: background-color 0.3s ease;
	}

	header button:hover {
		background-color: #d13c15;
	}

	/* Estilo para o formulário de edição */
	#editForm {
		margin-top: 10px;
		padding: 15px;
		background-color: #fff;
		border-radius: 6px;
		display: none;
		max-width: 300px;
		margin-left: auto;
		margin-right: auto;
	}

	#editForm label {
		display: block;
		margin-bottom: 8px;
		color: #333;
	}

	#editForm input[type="text"],
	#editForm input[type="color"] {
		padding: 6px;
		border-radius: 4px;
		border: 1px solid #ccc;
		width: 100%;
		margin-bottom: 8px;
	}

	#editForm input[type="submit"] {
		padding: 8px 16px;
		border-radius: 4px;
		border: none;
		background-color: #ff5733;
		color: #fff;
		cursor: pointer;
		transition: background-color 0.3s ease;
	}

	#editForm input[type="submit"]:hover {
		background-color: #d13c15;
	}

	#edit {
		background-color: black;
		color: #fff;
		border: none;
		padding: 10px 20px;
		font-size: 16px;
		cursor: pointer;
		border-radius: 5px;
		transition: background-color 0.3s ease;
	}

	#edit:hover {
		background-color: #d13c15;
	}
</style>
</head>
<body>
<?
include_once 'config/Database.php';
include_once 'class/Produto.php';
include_once 'class/Categoria.php';

$database = new Database();
$db = $database->getConexao();
$food = new Produto($db);
$categoria = new Categoria($db);

include('inc/header.php');
?>

<title>Cardapio Digital Pizzaria do luiz</title>
<link rel="stylesheet" type="text/css" href="css/foods.css">
<link rel="shortcut icon" href="images/logo1.jpg" type="image/x-icon">
<?php include('inc/container.php'); ?>
	
<header style="background-color: #ff5733">
    <img class="Logo" src="images/logo2.png" alt="">
    <h3>Seja Bem-Vindo a Pizzaria do luiz</h3>
</header><br>

   
<div class="p-3">

	<h4 style="text-align: center; background: black;">Opções</h4>
	<div class="nav" style="text-align: center;">
		<ul style="display: flex; " class="list-unstyled">
			<li><a class="btn btn-outline-danger" style="text-decoration: none; color: red; background: #fff;" href='index.php'>Topo do Cardapio</a></li>
			<li><a class="btn btn-outline-danger" style="text-decoration: none; color: red; background: #fff;" href='#pizzas'>Pizzas</a></li>
			<li><a class="btn btn-outline-danger" style="text-decoration: none; color: red; background: #fff;" href='#bebidas'>Bebidas</a></li>
			<li><a class="btn btn-outline-danger" style="text-decoration: none; color: red; background: #fff;" href='#combos'>Combos</a></li>
		</ul>
	</div>
	<div>

		<form class="box-search" method="GET">
			<input type="text" name="q" class="form-control" placeholder="Pesquisar">
			<button type="submit" name="pesquisar" value="Pesquisar" class="btn btn-primary">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
					<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
				</svg>
			</button>
		</form>

		<?php include('top_menu.php'); ?> <br>
	
		<!-- conteúdo -->
		<h4 style="text-align: center; background: black;">Pizzas</h4>
		<div id="pizzas" class="content">
			<div class="container-fluid">
				<div class='row'>
				</div>


					<?php
					$count = 0;
					if (isset($_GET['q'])) {
						$result = $food->itemsSearch($_GET['q']);
					} else {
						// Obtenha o ID da categoria "Refrigerantes" (suponhamos que seja 1)
						$categoriaPizza = 2;
						$result = $food->itemsCategorie($categoriaPizza);
					}

					while ($item = $result->fetch_assoc()) {
						if ($count == 0) {
							echo "<div class='row'>";
						}
					?>
						<div class="col-md-3">
							<form method="post" action="montarPedido.php?action=add&id=<?php echo $item["id"]; ?>"  style="  align-items: center;">
								<div class="mypanel" style="text-align: center;">
									<img src="images/<?php echo $item["images"]; ?>" alt="" class="img-fluid" >
									<h5 class="text-dark"><?php echo $item["name"]; ?></h5>
									<p class="text"><?php echo $item["description"]; ?></p>
									<input type="hidden" name="item_name" value="<?php echo $item["name"]; ?>">
									<input type="hidden" name="item_id" value="<?php echo $item["id"]; ?>">
									<input type="submit" name="add" class="btn btn-danger" value="Monte sua Pizza">
								</div>
							</form>
						</div>

					<?php
						$count++;
						if ($count == 4) {
							echo "</div>";
							$count = 0;
						}
					}
					?>
				</div>

			</div>
</div>

			<script>
				// Função para mostrar/esconder as bebidas
				function toggleBebidas() {
					var bebidas = document.getElementById('bebidas');
					var toggleButton = document.getElementById('toggleBebidas');

					if (bebidas.style.display === 'none' || bebidas.style.display === '') {
						bebidas.style.display = 'block';
						toggleButton.textContent = 'Esconder Bebidas';
					} else {
						bebidas.style.display = 'none';
						toggleButton.textContent = 'Mostrar Bebidas';
					}
				}

				// Verificar se o dispositivo é um celular
				function isMobileDevice() {
					return (typeof window.orientation !== 'undefined') || (navigator.userAgent.indexOf('IEMobile') !== -1);
				}

				// Adicionar evento de clique no botão para dispositivos móveis
				document.addEventListener('DOMContentLoaded', function () {
					var toggleButton = document.getElementById('toggleBebidas');
					var bebidas = document.getElementById('bebidas');

					if (isMobileDevice()) {
						toggleButton.style.display = 'block'; // Mostrar o botão apenas em dispositivos móveis
						bebidas.style.display = 'none'; // Inicialmente, esconde as bebidas
						toggleButton.addEventListener('click', toggleBebidas);
					}
				});
			</script>

			<!--bebidas-->
			<h4 style="text-align: center; background: black;">Bebidas</h4>
			<button id="toggleBebidas" class="btn btn-outline-danger" style="text-decoration: none; color: red; background: #fff; display: none;">Mostrar Bebidas</button>
			<div id="bebidas" class="content">
				<div class="container-fluid">
					<div class='row'>

						<?php
						$count = 0;
						if (isset($_GET['q'])) {
							$result = $food->itemsSearch($_GET['q']);
						} else {
							// Obtenha o ID da categoria "Refrigerantes" (suponhamos que seja 1)
							$categoriaRefrigerantes = 1;
							$result = $food->itemsCategorieOrdered($categoriaRefrigerantes);
						}

						while ($item = $result->fetch_assoc()) {
							if ($count % 4 == 0) {
								echo "<div class='row'>";
							}
                		?>
						
						<div class="col-md-3">
							<form method="post" action="cart.php?action=add&id=<?php echo $item["id"]; ?>">
								<div class="mypanel" align="center";>
									<img src="images/<?php echo $item["images"]; ?>" alt="" class="img-fluid">
									<h5 class="text-dark"><?php echo $item["name"]; ?></h5>
									<h5 class="text"><strong>R$ <?php echo $item["price"]; ?></strong></h5>
									<h6 class="text-center">Qtd.: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"></h6>
									<input type="hidden" name="item_name" value="<?php echo $item["name"]; ?>">
									<input type="hidden" name="item_price" value="<?php echo $item["price"]; ?>">
									<input type="hidden" name="item_id" value="<?php echo $item["id"]; ?>">
									<input type="submit" name="add" class="btn btn-danger" value="Adicionar ao Carrinho"> <br>
								</div>
							</form>
						</div>
				

						<button id="toggleBebidas" class="btn btn-outline-danger" style="text-decoration: none; color: red; background: #fff; display: none;">Mostrar Bebidas</button>
					<?php
						$count++;
						if ($count == 4) {
							echo "</div>";
							$count = 0;
						}
					}
					?>
				</div>
			</div>
		</div>


		
				
				<!--combos-->	
				<h4 style="text-align: center;  background: black;">Combos</h4>
				<div id="combos" class="content">
						<div class="container-fluid">
									<div class='row'>
									</div>
									<?php
									$count = 0;
									if (isset($_GET['q'])) {
										$result = $food->itemsSearch($_GET['q']);
									} else {
										// Obtenha o ID da categoria "Refrigerantes" (suponhamos que seja 1)
										$categoriaCombo = 5;
										$result = $food->itemsCategorie($categoriaCombo);
									}

									while ($item = $result->fetch_assoc()) {
										if ($count == 0) {
											echo "<div class='row'>";
										}
									?>
								</div>
							</div>
									<div class="col-md-3">
										<form method="post" action="montarCombo.php?action=add&id=<?php echo $item["id"]; ?>">
											<div class="mypanel" align="center";>
												<img src="images/<?php echo $item["images"]; ?>" alt="" class="img-fluid">
												<h5 class="text-dark"><?php echo $item["name"]; ?></h5>
												<p class="text"><?php echo $item["description"]; ?></p>
												<input type="hidden" name="item_name" value="<?php echo $item["name"]; ?>">
												<input type="hidden" name="item_id" value="<?php echo $item["id"]; ?>">
												<input type="submit" name="add" class="btn btn-danger" value="Montar Combo">
											</div>
										</form>
									</div>

								<?php
									$count++;
									if ($count == 4) {
										echo "</div>";
										$count = 0;
									}
								}
								?>
						</div>
						<div class="nav" style="text-align: right;">
							<ul style="display: flex; " class="list-unstyled">
								<li><a class="btn btn-outline-danger" style="text-decoration: none; color: red; background: #fff;" href='index.php'>Topo do Cardapio</a></li>
								<li><a class="btn btn-outline-danger" style="text-decoration: none; color: red; background: #fff;" href='#pizzas'>Pizzas</a></li>
								<li><a class="btn btn-outline-danger" style="text-decoration: none; color: red; background: #fff;" href='#bebidas'>Bebidas</a></li>
								<li><a class="btn btn-outline-danger" style="text-decoration: none; color: red; background: #fff;" href='#combos'>Combos</a></li>
							</ul>
						</div>


			</div> <br><br>

			<?php include('inc/footer.php'); ?>
</body>
</html>






<!DOCTYPE html>
<html>
<head>
    <title>cardapio</title>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            background-color: #f0f8ff; /* Azul claro */
            height: 100vh; /* 100% da altura da janela */
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
            margin-left: 200px; /* Ajuste conforme a largura da sidebar */
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
            max-width: 100%;
            height: auto;
            max-height: 100px; /* Defina a altura máxima desejada */
            margin: 5px auto 10px; /* Centraliza a imagem horizontalmente e adiciona espaçamento abaixo */
            display: block;
            border-radius: 50px;
        }

        .sidebar h2 {
            max-width: 100%;
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

		.container form {
        margin-bottom: 20px;
    }

    .container form table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    .container form th,
    .container form td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    .container form th {
        background-color: #f2f2f2;
    }

    .container form tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .container form tr:hover {
        background-color: #f1f1f1;
    }

    .container form img {
        max-width: 100px;
        max-height: 100px;
        width: auto;
        height: auto;
    }

    .container form a {
        text-decoration: none;
        color: #fff;
        padding: 6px 12px;
        border-radius: 5px;
        background-color: #FF0000;
        transition: background-color 0.3s, color 0.3s;
    }

    .container form a:hover {
        background-color: #fff;
        color: #FF0000;
    }

    .container form td a {
        display: block;
        text-align: center;
    }

	.mypanel {
        padding: 20px; /* Espaçamento interno para as informações dos produtos */
        text-align: center; /* Centraliza o texto */
        border-radius: 7px; /* Borda arredondada */
        margin-bottom: 20px; /* Espaço entre os produtos */
        background: #fff;
        border: 2px solid red;
        display: inline-block; /* Faz com que cada mypanel seja exibido em linha */
        width: calc(25% - 40px); /* Define a largura de cada quadrado (25% de largura com margem de 20px) */
        margin: 10px;
        box-sizing: border-box; /* Considera a borda dentro do cálculo do tamanho */
    }

    /* Estilo para criar um layout de 4 colunas */
    .container::after {
        content: '';
        display: table;
        clear: both;
    }

    .container {
        column-count: 4; /* Divide a container em 4 colunas */
        column-gap: 0; /* Espaço entre as colunas */
    }

    .mypanel {
        width: 100%; /* Cada item ocupará toda a largura da coluna */
        margin-bottom: 20px;
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
            <li><a href="">Home</a></li>
            <li><a href="./cart.php">carrinho</a></li>
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
                }
            ?>

            <h2>Produtos Cadastrados</h2>

            <ul>
                <li><button class="mostrar" onclick="mostrarProdutos('pizza')">pizza</button></li>
                <li><button class="mostrar" onclick="mostrarProdutos('bebidas')">bebidas</button></li>
                <li><button class="mostrar" onclick="mostrarProdutos('combos')">combos</button></li>
            </ul>

			<div class="container">
						<?php
						// Executar a consulta para obter os produtos
						$query_products = "SELECT * FROM produtos WHERE id_categoria IN (1, 2, 5) AND id_login = ? ORDER BY
						CASE 
							WHEN id_categoria = 2 THEN 1
							WHEN id_categoria = 1 THEN 2
							WHEN id_categoria = 5 THEN 3
						END";            
						$stmt = $conn->prepare($query_products);
						$stmt->bind_param("i", $id_login);
						$stmt->execute();
						$result_products = $stmt->get_result();
						?>
				<form method="post" id="tabelaProdutos" action="montarPedido.php?action=add&id=<?php echo $item["id"]; ?>"  style="  align-items: center;">
					<div class="mypanel" align="center";>	
						<?			
						if ($result_products->num_rows > 0) {
							while ($row = $result_products->fetch_assoc()) {
								echo "<tr class='produto'>";
								echo "<td><img src='./images/" . $row['images'] . "' alt=''></td>";
								echo "<td class='produto-nome'>" . $row['name'] . "</td>";
								echo "<td class='produto-descricao'>" . $row['description'] . "</td>";
								echo "<td class='produto-preco'>" . $row['price'] . "</td>";
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='4'>Nenhum produto cadastrado.</td></tr>";
						}
						?>
					</div>
				</form>

				<form id="tabelaPizza" style="display: none;">
					<div class="mypanel" align="center";>
						<?php
							$query_pizzas = "SELECT * FROM produtos WHERE id_categoria = 2 AND id_login = ?";
							$stmt_pizzas = $conn->prepare($query_pizzas);
							$stmt_pizzas->bind_param("i", $id_login);
							$stmt_pizzas->execute();
							$result_pizzas = $stmt_pizzas->get_result();

							if ($result_pizzas->num_rows > 0) {
								while ($row = $result_pizzas->fetch_assoc()) {
									echo "<tr class='produto'>";
									echo "<td><img src='./images/" . $row['images'] . "' alt=''></td>";
									echo "<td>" . $row['name'] . "</td>";
									echo "<td>" . $row['description'] . "</td>";
									echo "<td>" . $row['price'] . "</td>";
									echo "<td>
										<a href='./montarPedido.php'>Monte sua Pizza</a>
									</td>";
									echo "</tr>";
								}
							} else {
								echo "<tr><td colspan='4'>Nenhum produto cadastrado.</td></tr>";
							}
						?>
					</div>
				</form>
				<form method="post" id="tabelaBebidas" action="cart.php?action=add&id=<?php echo $item["id"]; ?>" style="display: none;">
					<div class="mypanel" align="center";>
				
						<?php
							$query_bebidas = "SELECT * FROM produtos WHERE id_categoria = 1 AND id_login = ?";
							$stmt_bebidas = $conn->prepare($query_bebidas);
							$stmt_bebidas->bind_param("i", $id_login);
							$stmt_bebidas->execute();
							$result_bebidas = $stmt_bebidas->get_result();

							if ($result_bebidas->num_rows > 0) {
								while ($row = $result_bebidas->fetch_assoc()) {
									echo "<tr class='produto'>";
									echo "<td><img src='./images/" . $row['images'] . "' alt=''></td>";
									echo "<td>" . $row['name'] . "</td>";
									echo "<td>" . $row['price'] . "</td>";
									echo "<td>
										<a href='./cart.php'>Adicionar ao carrinho</a>
									</td>";
									echo "</tr>";
								}
							} else {
								echo "<tr><td colspan='3'>Nenhum produto cadastrado.</td></tr>";
							}
						?>
					</div>
				</form>

				<form id="tabelaCombos" style="display:none;">
					<div class="mypanel" align="center";>
						<?php
							$query_combos = "SELECT * FROM produtos WHERE id_categoria = 5 AND id_login = ?";
							$stmt_combos = $conn->prepare($query_combos);
							$stmt_combos->bind_param("i", $id_login);
							$stmt_combos->execute();
							$result_combos = $stmt_combos->get_result();

							if ($result_combos->num_rows > 0) {
								while ($row = $result_combos->fetch_assoc()) {
									echo "<tr class='produto'>";
									echo "<td><img src='./images/" . $row['images'] . "' alt=''></td>";
									echo "<td>" . $row['name'] . "</td>";
									echo "<td>" . $row['price'] . "</td>";
									echo "</tr>";
								}
							} else {
								echo "<tr><td colspan='3'>Nenhum produto cadastrado.</td></tr>";
							}
						?>
					</div>
				</form>
			</div>

            <script>
                function mostrarProdutos(tipo) {
                    if (tipo === 'pizza') {
						document.getElementById('tabelaProdutos').style.display = 'none';
                        document.getElementById('tabelaPizza').style.display = 'block';
                        document.getElementById('tabelaBebidas').style.display = 'none';
                        document.getElementById('tabelaCombos').style.display = 'none';
                    } else if (tipo === 'bebidas') {
						document.getElementById('tabelaProdutos').style.display = 'none';
                        document.getElementById('tabelaPizza').style.display = 'none';
                        document.getElementById('tabelaBebidas').style.display = 'block';
                        document.getElementById('tabelaCombos').style.display = 'none';
                    }else if (tipo === 'combos') {
						document.getElementById('tabelaProdutos').style.display = 'none';
                        document.getElementById('tabelaPizza').style.display = 'none';
                        document.getElementById('tabelaBebidas').style.display = 'none';
                        document.getElementById('tabelaCombos').style.display = 'block';
                    }
                }
            </script>
        </div>
    </div>
</body>
</html>
<?php
} else {
    echo "ID do dono da pizzaria não encontrado na URL.";
}
?>
