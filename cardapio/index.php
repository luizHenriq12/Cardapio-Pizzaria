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


// Obtém o ID do dono da pizzaria da URL
if (isset($_GET['id_login'])) {
    $id_login = $_GET['id_login'];

    $query_status = "SELECT aberta FROM login WHERE id = ?";
    $stmt_status = $conn->prepare($query_status);
    $stmt_status->bind_param("i", $id_login);
    $stmt_status->execute();
    $result_status = $stmt_status->get_result();

    if ($result_status->num_rows > 0) {
        $row_status = $result_status->fetch_assoc();
        $pizzaria_aberta = $row_status['aberta'];

        if ($pizzaria_aberta == 0) {
            // Se a pizzaria estiver fechada, exiba uma mensagem ou desabilite o cardápio
			echo '<script>';
			echo 'alert("Desculpe, a pizzaria está fechada no momento. \n\nTente Novamente Mais tarde!");';
			echo 'window.location.href = "../index.php";</script>';
            // Você pode optar por não exibir o restante do conteúdo ou desabilitar interações aqui
        } else {
            header("Location: ");
        }

	$query = "SELECT nomeFanta, logo FROM login WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Armazenando informações na sessão
        $_SESSION['nomeFanta'] = $row['nomeFanta'];
        $_SESSION['logo'] = $row['logo'];
    }

    // Consulta SQL para obter os produtos associados a esse ID de login
    $query_products = "SELECT * FROM produtos WHERE id_login = ?";

    $stmt = $conn->prepare($query_products);
    $stmt->bind_param("i", $id_login);
    $stmt->execute();
    $result = $stmt->get_result();

	$_SESSION['id_login'] = $id_login;
?>


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

	.logo-container {
		display: flex;
		align-items: center;
		padding: 10px;
		background-color: #ff5733;
		border-radius: 5px;
	}

	.logo-container img {
		max-width: 100px; /* Ajuste o tamanho máximo conforme desejado */
		margin-right: 10px;
		border-radius: 100px;
	}

	.logo-container h2 {
		color: white;
		margin: 0;
		font-size: 20px; /* Ajuste o tamanho da fonte conforme desejado */
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
	
	<div class="main-content">
		<div class="content">
			<div class="logo-container">
				<?php
				if (isset($_SESSION['nomeFanta']) && isset($_SESSION['logo'])) {
					echo "<img src='" . $_SESSION['logo'] . "' alt='Logo'>";
					echo "<h2>Bem-vindo à " . $_SESSION['nomeFanta'] . "!</h2>";
				} else {
					echo "Informações da pizzaria não encontradas.";
				}
				?>
			</div>
		</div>
	</div>


   
<div class="p-3">

	<h4 style="text-align: center; background: black;">Opções</h4>
	<div class="nav" style="text-align: center;">
		<ul style="display: flex; " class="list-unstyled">
			<li><a class="btn btn-outline-danger" style="text-decoration: none; color: red; background: #fff;" href=''>Topo do Cardapio</a></li>
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
					<?php
					$query_pizzas = "SELECT * FROM produtos WHERE id_categoria = 2 AND id_login = ?";
					$stmt_pizzas = $conn->prepare($query_pizzas);
					$stmt_pizzas->bind_param("i", $id_login);
					$stmt_pizzas->execute();
					$result_pizzas = $stmt_pizzas->get_result();
					while ($item = $result_pizzas->fetch_assoc()) {
					?>
						<div class="col-md-3">
						<form method="post" action="montarPedido.php?action=add&id=<?php echo $item["id"]; ?>&id_login=<?php echo $id_login; ?>" style="align-items: center;">
								<div class="mypanel" style="text-align: center;">
									<img src="images/<?php echo $item["images"]; ?>" alt="" class="img-fluid">
									<h5 class="text-dark"><?php echo $item["name"]; ?></h5>
									<p class="text"><?php echo $item["description"]; ?></p>
									<input type="hidden" name="item_name" value="<?php echo $item["name"]; ?>">
									<input type="hidden" name="item_id" value="<?php echo $item["id"]; ?>">
									<input type="submit" name="add" class="btn btn-danger" value="Monte sua Pizza">
								</div>
							</form>
						</div>
					<?php
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
			<div id="bebidas" class="content" style="display: block;">
				<div class="container-fluid">
					<div class='row'>
						<?php
						$query_bebidas = "SELECT * FROM produtos WHERE id_categoria = 1 AND id_login = ?";
						$stmt_bebidas = $conn->prepare($query_bebidas);
						$stmt_bebidas->bind_param("i", $id_login);
						$stmt_bebidas->execute();
						$result_bebidas = $stmt_bebidas->get_result();
						if ($result_bebidas->num_rows > 0) {
							$count = 0; // Inicialize um contador para controlar as colunas
							while ($item = $result_bebidas->fetch_assoc()) {
						?>
						<div class="col-md-3">
							<form method="post" action="cart.php?action=id_login=<?php echo $id_login; ?>&add&id=<?php echo $item['id']; ?>">
								<div class="mypanel" align="center">
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
								// Verifica se atingiu 4 itens, se sim, fecha a linha e inicia outra
								if ($count % 4 == 0) {
									echo '</div><div class="row">';
								}
								?>
						<?php
							}
							// Completa a linha com espaços em branco para garantir que a última linha tenha 4 itens
							while ($count % 4 != 0) {
								echo '<div class="col-md-3"></div>';
								$count++;
							}
						} else {
							echo "Nenhuma bebida encontrada para este ID de login.";
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
							<?php
							$query_combos = "SELECT * FROM produtos WHERE id_categoria = 5 AND id_login = ?";
							$stmt_combos = $conn->prepare($query_combos);
							$stmt_combos->bind_param("i", $id_login);
							$stmt_combos->execute();
							$result_combos = $stmt_combos->get_result();							
							while ($item = $result_combos->fetch_assoc()) {
							?>
								<div class="col-md-3">
									<form method="post" action="montarCombo.php?action=add&id=<?php echo $item["id"]; ?>">
										<div class="mypanel" align="center">
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
							}
							?>
						</div>
					</div>
				</div>

			<?php include('inc/footer.php'); ?>
</body>
</html>
<?php
       } else {
        echo "Nenhuma informação encontrada para este ID de login.";
    }
} else {
    echo "ID do dono da pizzaria não encontrado na URL.";
}
?>