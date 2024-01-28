<?php
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConexao();

include('inc/header.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Pizzaria Calory</title>
		<link rel="stylesheet" type="text/css" href="css/foods.css">
		<link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">

		<style>
			/* Estilos gerais da página */
			body {
				font-family: Arial, sans-serif;
				background-image: url('images/fundo3.jpeg'); /* Caminho para a imagem de fundo */
				background-size: cover;
				background-repeat: no-repeat;
				background-attachment: fixed;
				color: #333;
				margin: 0;
				padding: 0;
			}

			/* Estilos para o cabeçalho */
			.header {
				background-color: #ff5733;
				padding: 10px;
				text-align: center;
			}

			.header-logo {
				max-width: 100px;
				display: block;
				margin: 0 auto;
			}

			h3 {
				color: #800000;
			}

			.content {
				padding: 20px;
				width: 60%;
				margin: 60px auto;
                background-color: rgba(255, 255, 255, 0.8);
			}

			@media only screen and (max-width: 768px) {
				body {
					background-image: url('./images/fundo3.jpeg'); /* Imagem de fundo específica para dispositivos móveis */
					background-size: cover;
				}

				.content {
					width: 130%; /* Aumente a largura do conteúdo para telas menores */
				}

			
			}

		</style>

	</head>
	<body>
		<?php include('inc/container.php'); ?>
		<div class="content">
			<div class="container-fluid">

				<div class='row'>
					<?php include('top_menu.php'); ?>
				</div>
				<?php
				$cont = 0;
				$orderTotal = 0;
				foreach ($_SESSION["cart"] as $keys => $values) {
					$itens[] = $values['item_name'];
					$precos[] = $values['item_price'];
					$qtd[] = $values['item_quantity'];
					$total = ($values["item_quantity"] * $values["item_price"]);
					$orderTotal = $orderTotal + $total;
					$cont++;
				}


				?>
				<div class='row'>
					<?php
					$randNumber1 = rand(100000, 999999);
					$orderNumber = $randNumber1;
					include('form.php');
					?>
				</div>
			</div>

			<?php include('inc/footer.php'); ?>
	</body>
</html>