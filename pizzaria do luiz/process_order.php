<!DOCTYPE html>
<html lang="en">
	<head>

		<style>
			/* Estilo para a parte específica do conteúdo */
			.content {
				background-color: rgba(255, 255, 255, 0.8); /* Cor de fundo com transparência */
				padding: 20px; /* Espaçamento interno */
				border-radius: 10px; /* Borda arredondada */
			}

			.jumbotron {
				padding: 20px; /* Espaçamento interno */
				border-radius: 10px; /* Borda arredondada */
			}

			/* Estilo para o botão de confirmação no fundo azul */
			.d-grid {
				text-align: center;
				background: #00BFFF;
				padding: 10px;
				margin: 10px;
				border-radius: 5px;
			}

			/* Estilo para o botão dentro do bloco d-grid */
			.btn-success {
				background-color: green;
				color: white;
				border: none;
				padding: 10px 20px;
				font-size: 18px;
				border-radius: 5px;
			}

		</style>


		
	</head>
	<body>
		<?php
			include_once 'config/Database.php';
			include_once 'class/Pedido.php';

			$database = new Database();
			$db = $database->getConexao();
			$order = new Pedido($db);

			include('inc/header.php');
			?>


			<title>Pizzaria Calory</title>
			<link rel="stylesheet" type="text/css" href="css/foods.css">
			<link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
			<?php include('inc/container.php'); ?>

			<div class="content">
				<div class="container-fluid">
					<div class='row'>
						<?php
						if (isset($_POST['enviar']) && !empty($_GET['order'])) {
							$endereco = $_POST['rua'] . ", " . $_POST['numero'] . " - " . $_POST['bairro'] . " - " . $_POST['cidade'] . "-" . $_POST['uf'] . " " . $_POST['complemento'];
							$nome = $_POST['nome'];
							$contato = $_POST['celular'];
							$obs = $_POST['obs'];
							$opc_pgto = $_POST['forma_pagamento'];
							$total = 0;
							$orderDate = date('Y-m-d');
							if (isset($_SESSION["cart"])) {
								$cont = 0;
								foreach ($_SESSION["cart"] as $keys => $values) {
									$nomeItem[] = $values["item_name"];
									$preco[] = $values["item_price"];
									$qtd[] = $values["item_quantity"];

									$order->item_id = $values["item_id"];
									$order->item_name = $values["item_name"];
									$order->item_price = $values["item_price"];
									$order->quantity = $values["item_quantity"];
									$order->cliente_nome = $nome;
									$order->cliente_contato = $contato;
									$order->cliente_endereco = $endereco;
									$order->cliente_opc_pgt = $opc_pgto;
									$order->cliente_observacao = $obs;
									$order->order_date = $orderDate;
									$order->order_id = $_GET['order'];
									$cont++;
									$order->insert();
								}
						?>
	<script>
						var texto =
							encodeURIComponent(`
✅ NOVO PEDIDO 
-----------------------------
▶ RESUMO DO PEDIDO 

Pedido #<?php echo $_GET['order']; ?>
 
<?php
	$subtotal = 0;
	for ($i = 0; $i < $cont; $i++) {
		echo "*" . $qtd[$i] . "x* ";
		echo "_" . $nomeItem[$i] . "_ ";
		echo "*(R$ " . $preco[$i] . ")*\n";
		$subtotal += $preco[$i] * $qtd[$i];
	}
?>

Observação: R$ <?php echo $obs . "\n" ?>
SUBTOTAL: R$ <?php echo $subtotal; ?>

------------------------------------------
▶ Dados para entrega 
 
Nome: <?php echo $nome . "\n" ?>
Endereço: <?php echo $_POST['rua'] . ", nº: " . $_POST['numero'] . "\n" ?>
Bairro: <?php echo $_POST['bairro'] . "\n" ?>
Complemento: <?php echo $_POST['complemento'] . "\n" ?>
Telefone: <?php echo $contato . "\n" ?>

Taxa de Entrega: R$ 3,00

🕙 Tempo de Entrega: aprox. 45 min

------------------------------- 
▶ TOTAL = R$ <?php echo ($subtotal + 3). "\n" ?>
------------------------------ 

▶ PAGAMENTO 
<?php
switch($opc_pgto){
	case 1:
		echo "\nPagamento no Pix\nChave: 13648718908 (Luiz Henrique Assumpcao Sampaio)";
		break;
	case 2:
		echo "\nPagamento no cartão\nDébito/Crédito";
		break;
	case 3:
		echo "\nPagamento em Dinheiro\nTroco para: R$ ".$_POST['troco'];
		break;
}
// Pagamento no cartão 
// Cartão: Mastercard
?>`)
						var url = "https://api.whatsapp.com/send?phone=5544988430083&text=%C3%93timo%20pedido" + texto;

						function openInNewTab() {
							var win = window.open(url, '_blank');
							win.focus();
						}
					</script>
								<?php
									unset($_SESSION["cart"]);
								}
								?>
								<div class="container">
									<div class="jumbotron">
										<h1 class="text-center" style="color: #fff;"><span class="glyphicon glyphicon-ok-circle"></span> Pedido Criado.</h1>
									</div>
								</div>
								<br>
								<h2 class="text-center">Seu pedido foi criado</h2>

								<h3 class="text-center" style="color: black;"> <strong>Número do seu pedido:</strong> <span style="color: blue;"><?php echo $_GET['order']; ?></span> </h3>

								<h3 class="text-center" style="color: black;">Desfrute mais do <a href="index.php">Nosso Cardápio!</a></h3>
								<div class="d-grid gap-2 d-md-block" style="text-align: center; background: #00BFFF; padding: 10px; margin: 10px; border-radius: 5px;"> <br>
								<h4>CONFIRME SEU PEDIDO AQUI:</h4>
								<span>🔻🔻🔻🔻 </span> <br>
									<button class="btn btn-success" type="button" onclick="openInNewTab(url)"><i class="bi bi-whatsapp me-2"></i>Confirme seu pedido pelo whatsapp</button>
											
								</div>

							<?php } else { ?>
								<h3 class="text-center">Desfrute mais da <a href="index.php">Nosso Cardápio!</a></h3>
							<?php } ?>
						</div>
				</div> <br> <br>
				<?php include('inc/footer.php'); ?>
	</body>
</html>