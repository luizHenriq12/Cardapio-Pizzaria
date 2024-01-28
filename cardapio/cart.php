
<?php
include_once 'config/Database.php';
$database = new Database();
$db = $database->getConexao();


	session_start();
	if (isset($_SESSION['id_login'])) {
		$id_login = $_SESSION['id_login'];
		// Restante do seu código...
	} else {
		echo "ID do dono da pizzaria não encontrado na sessão.";
	}

	function pagarpreco(string $tamanhoPizza, $conexao) {
		$query = "SELECT price FROM produtos WHERE id_categoria = 4 AND name = ?";
		
		$stmt = $conexao->prepare($query);
		$stmt->bind_param("s", $tamanhoPizza);
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row['price'];
		} else {
			return null;
		}
	}

	function pagarprecoC(string $tamanhoPizza, $conexao) {
		$query = "SELECT price FROM produtos WHERE id_categoria = 3 AND name = ?";
		
		$stmt = $conexao->prepare($query);
		$stmt->bind_param("s", $tamanhoPizza);
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row['price'];
		} else {
			return null;
		}
	}

if (isset($_POST["add"])) {
	if (isset($_SESSION["cart"])) {
		$item_array_id = array_column($_SESSION["cart"], "food_id");
		if (!in_array($_GET["id"], $item_array_id)) {
			$count = count($_SESSION["cart"]);
			$item_array = array(
				'food_id' => $_GET["id"],
				'item_name' => $_POST["item_name"],
				'item_price' => $_POST["item_price"],
				'item_id' => $_POST["item_id"],
				'item_quantity' => $_POST["quantity"]
			);
			$_SESSION["cart"][$count] = $item_array;
			echo '<script>window.location="cart.php"</script>';
		} else {
			echo '<script>window.location="cart.php"</script>';
		}
	} else {
		$item_array = array(
			'food_id' => $_GET["id"],
			'item_name' => $_POST["item_name"],
			'item_price' => $_POST["item_price"],
			'item_id' => $_POST["item_id"],
			'item_quantity' => $_POST["quantity"]
		);
		$_SESSION["cart"][0] = $item_array;
	}
} else if (isset($_POST["montarpizza"])) {
	if (isset($_SESSION["cart"])) {

		// Montar o nome da pizza com sabores
        $saboresSelect = $_POST['sabor'];
        $saboresText = "Sabor: ";
        foreach ($saboresSelect as $sabor) {
            $saboresText .= $sabor . ", ";
        }
        $saboresText = rtrim($saboresText, ", ");
		
		$item_array_id = array_column($_SESSION["cart"], "food_id");
			$count = count($_SESSION["cart"]);
			$item_array = array(
				'food_id' => $count,
				'item_name' => 'PIZZA:   ' . $_POST["item_name"] . ' * BORDA: ' . $borda = $_POST["bordas"] . ' *   SABOR: ' . $saboresSelect = $_POST["sabor"],
				'item_price' => pagarpreco($_POST["item_name"], $db),
				'item_id' => $count,
				'item_quantity' => 1
			);
			$_SESSION["cart"][$count] = $item_array;
			echo '<script>window.location="cart.php"</script>';
	} else {
		$item_array = array(
			'food_id' => 1,
			'item_name' => 'PIZZA   ' . $_POST["item_name"] . ' * BORDA ' . $borda = $_POST["bordas"] . ' *  SABOR ' . $saboresSelect = $_POST["sabor"],
			'item_price' => pagarpreco($_POST["item_name"], $db),
			'item_id' => 1,
			'item_quantity' => 1
		);
		$_SESSION["cart"][0] = $item_array;
	}
} if (isset($_POST["montarcombo"])) {
    if (isset($_SESSION["cart"])) {
        // Montar o nome da pizza com sabores
        $saboresSelect = $_POST['sabor'];
        $saboresText = "Sabor: ";
        foreach ($saboresSelect as $sabor) {
            $saboresText .= $sabor . ", ";
        }
        $saboresText = rtrim($saboresText, ", ");

        // Captura do refrigerante
        $refri = $_POST["refri"];

        $count = count($_SESSION["cart"]);
        $item_array = array(
            'food_id' => $count,
            'item_name' => 'COMBO-> ' . 'PIZZA:   ' .  $_POST["item_name"] . ' * BORDA: ' . $_POST["bordas"] . ' *   SABOR: ' . $saboresSelect = $_POST["sabor"] . ' * REFRIGERANTE: ' . $refri = $_POST["refri"],
            'item_price' => pagarprecoC($_POST["item_name"], $db),
            'item_id' => $count,
            'item_quantity' => 1
        );
        $_SESSION["cart"][$count] = $item_array;
        echo '<script>window.location="cart.php"</script>';
    } else {
        // Se a sessão do carrinho não estiver configurada
        $saboresSelect = $_POST['sabor'];
        $saboresText = "Sabor: ";
        foreach ($saboresSelect as $sabor) {
            $saboresText .= $sabor . ", ";
        }
        $saboresText = rtrim($saboresText, ", ");

        $refrigerante = $_POST["refrigerante"];

        $item_array = array(
            'food_id' => 1,
            'item_name' => 'COMBO-> ' . 'PIZZA   ' . $_POST["item_name"] . ' * BORDA: ' . $_POST["bordas"] . ' *   SABOR: ' . $saboresSelect = $_POST["sabor"] . ' * REFRIGERANTE: ' . $refri = $_POST["refri"],
            'item_price' => pagarprecoC($_POST["item_name"], $db),
            'item_id' => 1,
            'item_quantity' => 1
        );
        $_SESSION["cart"][0] = $item_array;
    }
}
if (isset($_GET["action"])) {
	if ($_GET["action"] == "delete") {
		foreach ($_SESSION["cart"] as $keys => $values) {
			if ($values["food_id"] == $_GET["id"]) {
				unset($_SESSION["cart"][$keys]);
				echo '<script>window.location="cart.php"</script>';
			}
		}
	}
}

if (isset($_GET["action"])) {
	if ($_GET["action"] == "empty") {
		foreach ($_SESSION["cart"] as $keys => $values) {
			unset($_SESSION["cart"]);
			echo '<script>window.location="cart.php"</script>';
		}
	}
}

include('inc/header.php');
?>
<title>Carapio Digital</title>
<link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
<?php include('inc/container.php'); ?>
<div class="content">
	<div class="container-fluid">
		<div class='row'>
			<?php include('top_menu.php'); ?>
		</div>
		<div class='row'>
			<?php
			if (!empty($_SESSION["cart"])) {
				
			?>
				<h3>Seu Carrinho:</h3>
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th width="40%">Nome</th>
							<th width="10%">Qtd</th>
							<th width="20%">Preço Uni.</th>
							<th width="25%">Subtotal</th>
							<th width="5%">Acão</th>
						</tr>
					</thead>
					<?php
					$total = 0;
					foreach ($_SESSION["cart"] as $keys => $values) {
					?>
						<tr>
    						<td><?php echo $values["item_name"]; ?></td>
    						<td><?php echo $values["item_quantity"]; ?></td>
    						<td>R$ <?php echo $values["item_price"]; ?></td>
    						<td>R$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
    						<td><a href="cart.php?action=delete&id=<?php echo $values["food_id"]; ?>"><span class="text-danger">Remover</span></a></td>
						</tr>

					<?php
						$total = $total + ($values["item_quantity"] * $values["item_price"]);
					}
					?>
					<tr>
						<td colspan="3" align="right">Total:</td>
						<td align="right"><strong>R$ <?php echo number_format($total, 2); ?></strong></td>
						<td></td>
					</tr>
				</table>
				<?php
				echo '<div><a href="cart.php?action=empty&id_login=' . $_SESSION['id_login'] . '"><button class="btn btn-danger"><span class="bi bi-trash-fill"></span> Limpar Carrinho</button></a>&nbsp;<a href="index.php?id_login=' . $_SESSION['id_login'] . '"><button class="btn btn-warning">Adicionar mais itens</button></a>&nbsp;<a href="checkout.php?id_login=' . $_SESSION['id_login'] . '"><button class="btn btn-success float-end"><span class="bi bi-arrow-right"></span> Confirmar</button></a></div>';
				?>
			<?php
			} elseif (empty($_SESSION["cart"])) {
			?>
				<div class="container">
					<div class="jumbotron">
					<h3>Seu carrinho está vazio. Escolha seus <a href="index.php?id_login=<?php echo $_SESSION['id_login']; ?>">produtos!</a></h3>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>

<br><br>
<?php include('inc/footer.php'); ?>