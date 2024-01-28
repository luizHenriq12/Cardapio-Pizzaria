<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cs Delivery</title>
  <link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
  <?php include('inc/container.php'); ?>

  <style>
		/* Estilos básicos - customize conforme necessário */
	body {
	font-family: Arial, sans-serif;
	margin: 0;
	padding: 0;
	background-color: #f8f8f8;
	color: #333;
	}

	header {
	background-color: #fff;
	padding: 20px;
	text-align: center;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}

	header h1 {
	margin: 0;
	font-size: 2em;
	}

	nav ul {
	list-style: none;
	padding: 0;
	margin: 20px 0;
	}

	nav ul li {
	display: inline;
	margin-right: 20px;
	}

	nav ul li a {
	text-decoration: none;
	color: #333;
	font-weight: bold;
	background: #ff0;
	padding: 10px;
	border-radius: 5px;
	}

	nav ul li a:hover {
	background-color: #ff6347; /* Mudança de cor ao passar o mouse */
	}

	main {
	padding: 20px;
	}

	section {
	margin-bottom: 20px;
	}

	/* Estilos para o rodapé */
	footer {
	text-align: center;
	padding: 10px;
	position: fixed;
	bottom: 0;
	width: 100%;
	background-color: #333;
	color: #fff;
	}

	/* Estilos para a descrição */
	.descricao {
	font-family: Arial, sans-serif; /* Definindo a fonte como Arial */
	font-size: 16px;
	color: #333; /* Cor padrão do texto */
	line-height: 1.5;
	margin: 10px;
	}

	/* Estilos para 'Cs' em amarelo */
	.cs {
	color: #f00; /* Amarelo */
	padding: 3px;
	border-radius: 2px;
	}

	/* Estilos para 'Delivery' em vermelho */
	.delivery {
	color: #f00; /* Vermelho */
	padding: #fff 3px;
	border-radius: 2px;
	}


  </style>
</head>
<body>
  <header>
    <h1>Bem-vindo à CS DELIVERY</h1>
    <nav>
      <ul>
        <li><a href="./painel/login.php">painel</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section>
		<h1>Nossas Pizzarias:</h1>
	<nav>
		<ul>
			<li><a href="./cardapio/index.php?id_login=">Pizzaia teste</a></li>
			<li><a href="./cardapio/index.php?id_login=">Pizzaia teste 2</a></li>
		</ul>
	</nav>
      <h2>Informações da Empresa</h2>
      <!-- Adicione informações sobre a sua empresa aqui -->
      <p>Bem-vindo à rede de pizzarias inovadoras e deliciosas da <span class="cs">Cs</span> <span class="delivery">Delivery</span>! <br><br>
	   Com um compromisso inabalável com a excelência gastronômica e a satisfação do cliente, nossa rede de pizzarias oferece uma experiência culinária única.

Cada uma de nossas pizzarias, cuidadosamente desenvolvida pela equipe da <span class="cs">Cs</span> <span class="delivery">Delivery</span>, é um oásis gastronômico onde a arte de fazer pizza encontra tecnologia avançada. Desde os métodos tradicionais de preparo de massa até as combinações mais inovadoras de ingredientes frescos e sabores exclusivos, cada pizza é uma obra-prima artesanal. <br><br>

Nossas pizzarias não são apenas destinos para os amantes de pizza;<br><br>  são centros de inovação culinária. Nossa abordagem focada no cliente e na qualidade se estende não apenas aos produtos que oferecemos, mas também à experiência que proporcionamos. Dos sabores clássicos aos mais experimentais, cada mordida em uma pizza da nossa rede é uma viagem de sabor incomparável. <br><br>

Além disso, estamos comprometidos com a comodidade. Com a plataforma <span class="cs">Cs</span> <span class="delivery">Delivery</span>, você pode explorar todas as nossas pizzarias, fazer pedidos online e ter suas pizzas favoritas entregues diretamente à sua porta, garantindo a frescura e o sabor em cada fatia. <br><br>

Junte-se a nós na <span class="cs">Cs</span> <span class="delivery">Delivery</span> e descubra um mundo de pizzas feitas com paixão, inovação e um toque especial que só a nossa rede pode oferecer.</p>
    </section>
  </main>

  <script src="scripts.js"></script>

  <?php include('inc/footer.php'); ?>
</body>
</html>
