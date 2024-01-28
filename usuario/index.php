<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cardapio Digital</title>
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

	<script>
         function toggleEditForm() {
			var editForm = document.getElementById('editForm');
			if (editForm.style.display === 'none' || editForm.style.display === '') {
				editForm.style.display = 'block';
			} else {
				editForm.style.display = 'none';
			}
		}
    </script>

</head>
<body>
<?php
include_once 'config/Database.php';
include_once 'class/Produto.php';
include_once 'class/Categoria.php';

$database = new Database();
$db = $database->getConexao();
$food = new Produto($db);
$categoria = new Categoria($db);

include('inc/header.php');
?>

<title>Cardapio Digital Calory</title>
<link rel="stylesheet" type="text/css" href="css/foods.css">
<link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
<?php include('inc/container.php'); ?>



	<?php
		echo "<script>";
		echo "var storedLogoPath = localStorage.getItem('logoPath');";
		echo "var storedHeaderColor = localStorage.getItem('headerBackgroundColor');";
		echo "var storedRestaurantName = localStorage.getItem('restaurantName');";

		echo "if (storedLogoPath !== null) {";
		echo "    document.getElementById('headerLogo').src = storedLogoPath;";
		echo "}";
		// Faça o mesmo para outras variáveis do header
		echo "</script>";

		
	?>

		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				// Atualizar os valores se o formulário foi enviado
				$logoPath = $_POST['logo'];
				$headerBackgroundColor = $_POST['backgroundColor'];
				$restaurantName = $_POST['restaurantName'];
			
				// Salvar os valores no localStorage
				echo "<script>";
				echo "localStorage.setItem('logoPath', '$logoPath');";
				echo "localStorage.setItem('headerBackgroundColor', '$headerBackgroundColor');";
				echo "localStorage.setItem('restaurantName', '$restaurantName');";
				echo "</script>";
		
				// Salvar os valores no banco de dados também
				// ... (seu código para salvar no banco de dados)
			}
		?>

<header style="background-color: <?php echo $headerBackgroundColor; ?>">
    <img class="Logo" src="<?php echo $logoPath; ?>" alt="">
    <h3><?php echo $restaurantName; ?></h3>
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
									<p class="text"><?php echo $item["description"]; ?></p>
									<h5 class="text"><strong>R$ <?php echo $item["price"]; ?></strong></h5>
									<h6 class="text-center">Qtd.: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"></h6>
									<input type="hidden" name="item_name" value="<?php echo $item["name"]; ?>">
									<input type="hidden" name="item_price" value="<?php echo $item["price"]; ?>">
									<input type="hidden" name="item_id" value="<?php echo $item["id"]; ?>">
									<input type="submit" name="add" class="btn btn-danger" value="Adicionar ao Carrinho">
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
