<?php
    session_start(); // Inicia a sessão

    // Verifica se o id_login foi passado como um parâmetro na URL
    if (isset($_GET['id_login'])) {
        $id_login = $_GET['id_login'];
    } else {
        // Caso não tenha sido passado o id_login, pode-se redirecionar para alguma página de erro ou página inicial, dependendo do seu fluxo
        header("Location: erro.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cardapio Digital</title>
        <link rel="stylesheet" type="text/css" href="css/foods.css">
        <link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style>
            
            /* Estilos gerais da página */
            body {
                font-family: Arial, sans-serif;
                background-image: url('./images/fundo3.jpeg'); /* Substitua 'background.jpg' pela sua imagem de fundo */
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed;
                color: #333; /* Cor do texto principal */
            }

            /* Estilos para o cabeçalho */
            header {
                display: flex;
				justify-content: space-between;
				align-items: center;
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
                color: #fff;
            }

            /* Estilos para o título principal */
            h1 {
                width: 40%;
                margin: 20px auto;
                text-align: center;
                color: #fff;
                font-size: 24px;
                margin-top: 20px;
            }

            /* Estilos para a seção de observação */
            .obs {
                background-color: rgba(255, 87, 51, 0.7);
                width: 30%;
                border-radius: 5px;
                padding: 10px;
                margin: 0 auto;
                text-align: center;
                color: #fff;
            }

            /* Estilos para os itens de observação */
            .obs h3 {
                color: #800000;
            }

            /* Estilos para a seção de seleção de tamanhos de pizza */
            label[for="tamanhoPizza"] {
                display: block;
                width: 40%;
                margin: 20px auto;
                margin-top: 20px;
                color: #800000;
            }

            select[name="item_name"] {
                width: 40%;
                margin: 20px auto;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            /* Estilos para a seção de seleção de sabores e bordas */
            .saborEborda {
                text-align: center;
                margin: 20px auto; /* Centraliza horizontalmente com margens automáticas */
                padding: 10px 20px;
                width: 40%;
                background-color: rgba(255, 255, 255, 0.8);
                border-radius: 5px;
            }


            /* Estilos para os rótulos de seleção de sabores e bordas */
            .saborEborda h3 {
                color: #800000;
            }

            /* Estilos para a lista de sabores selecionados */
            #saboresSelecionados, #bordasSelecionados {
                color: #333;
                margin-top: 10px;
            }

            .saborCheckbox, .bordasCheckbox {
                width: auto; /* Define a largura máxima para os checkboxes */
            }

            /* Estilos para os botões de envio */
            .my-btn {
                display: block;
                width: 50%; /* Defina a largura máxima desejada */
                margin: 20px auto; /* Centralize horizontalmente com margens automáticas e margem superior de 20px */
                padding: 10px;
                background-color: #800000;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }

            .my-btn:hover {
                background-color: #ff5733;
            }

            /* Estilos para o cabeçalho */
            header {
                background-color: #ff5733;
                padding: 10px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .header-content {
                display: flex;
                align-items: center;
            }

            .home-button {
                text-decoration: none;
                color: red;
                background: #fff;
                padding: 5px 10px;
                border: 1px solid red;
                border-radius: 5px;
                margin-left: 30px auto; /* Espaçamento entre o botão "Home" e o logotipo */
            }

            .home-button:hover {
                background: red;
                color: #fff;
            }

            .Logo {
                max-width: 100px;
            }

            h3 {
                color: #fff;
            }

            @media (max-width: 768px) {
                
                h1 {
                    font-size: 18px; 
                    margin: 10px auto;
                    width: 95%;
                }

                .obs {
                    width: 90%; 
                    font-size: 14px; 
                }

                .saborEborda {
                    width: 90%; 
                    font-size: 14px; 
                }

                .my-btn {
                    width: 70%; 
                    font-size: 14px; 
                }

            }
            .saboresContainer input[type="checkbox"] {
                display: inline-block;
                vertical-align: middle;
                width: 15px; /* Ajuste o tamanho conforme necessário */
                height: 15px; /* Ajuste o tamanho conforme necessário */
            }
            .saboresContainer label {
                display: inline-block;
                vertical-align: middle;
            }

            #error-message {
                display: none;
                color: red;
                text-align: center;
                margin-bottom: 10px;
            }
        </style>

    </head>
    <body>


            <?php include('inc/container.php'); ?>
        <div class="pizzas">
            <form class="MontarP" method="post" action="cart.php?action=montarpizza">

                    <input type="hidden" name="item_name" value="">
                    <input type="hidden" name="tamanhoPizza" id="tamanhoPizzaHidden">
                    <input type="hidden" name="sabores" id="saboresHidden">
                    <input type="hidden" name="bordas" id="bordasHidden">

                    <h1>Selecione o Tamanho da Pizza</h1>


                    <select name="item_name" id="tamanhoPizza" onchange="showHideFlavors()">
                        <option value="" disabled selected hidden style="display: flex; width: 100%;">TAMANHOS</option>
                        <?php
                        $conn = new mysqli("robb0254.publiccloud.com.br", "calor_developer", "@Samsung2023", "calorysistemas_delivery");
                        if ($conn->connect_error) {
                            die("Falha na conexão: " . $conn->connect_error);
                        }

                        // Query para buscar os tamanhos das pizzas
                        $sqlPizzas = "SELECT name, price FROM produtos WHERE id_categoria = 4 AND status = 1 ORDER BY name ASC";
                        $resultPizzas = $conn->query($sqlPizzas);

                        if ($resultPizzas->num_rows > 0) {
                            while ($rowPizza = $resultPizzas->fetch_assoc()) {
                                echo '<option value="' . $rowPizza['name']  .  '">' . 'Pizza '  . $rowPizza['name'] . ' - R$ ' . $rowPizza['price'] . '</option>';
                            }
                        }

                        $conn->close();
                        ?>
                    </select>

                    <!--DESABILITA OS CHECKBOX ANTES DE SELECIONAR ALGUM SABOR-->
                    <script>
                        function disableCheckboxes() {
                            const tamanhoPizzaSelect = document.getElementById('tamanhoPizza');
                            const saborCheckboxes = document.querySelectorAll('.saborCheckbox');
                            const bordasCheckboxes = document.querySelectorAll('.bordasCheckbox');

                            saborCheckboxes.forEach(checkbox => {
                                checkbox.disabled = true;
                            });

                            bordasCheckboxes.forEach(checkbox => {
                                checkbox.disabled = true;
                            });

                            tamanhoPizzaSelect.addEventListener('change', () => {
                                saborCheckboxes.forEach(checkbox => {
                                    checkbox.disabled = false;
                                });

                                bordasCheckboxes.forEach(checkbox => {
                                    checkbox.disabled = false;
                                });
                            });
                        }

                        window.addEventListener('load', () => {
                            disableCheckboxes();
                        });
                    </script>

               <p id="limitMessage" style="color: red; background: #fff; width:40%; margin: 20px auto; border-radius: 10px;"></p>
                
               <!--LIMITE DE SABORES-->
                <script>
                  window.addEventListener('load', () => {
                        const tamanhoPizzaSelect = document.getElementById('tamanhoPizza');
                        const saborCheckboxes = document.querySelectorAll('.saborCheckbox');
                        const limitMessage = document.getElementById('limitMessage');
                        let maxAllowedFlavors = 2; // Define um valor padrão

                        tamanhoPizzaSelect.addEventListener('change', () => {
                            const tamanhoPizza = tamanhoPizzaSelect.value;

                            // Mapeia o número máximo de sabores permitidos para cada tamanho
                            const maxFlavors = {
                                'P': 2,
                                'M': 3,
                                'G': 4,
                                'Big': 5
                            };

                            maxAllowedFlavors = maxFlavors[tamanhoPizza];

                            if (maxAllowedFlavors) {
                                limitMessage.textContent = `Selecione até ${maxAllowedFlavors} sabores.`;
                                // Reseta a seleção dos sabores
                                saborCheckboxes.forEach(checkbox => {
                                    checkbox.checked = false;
                                    checkbox.disabled = false; // Habilita todos os checkboxes
                                });
                            } else {
                                limitMessage.textContent = 'Selecione um tamanho válido.';
                            }
                        });

                        saborCheckboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', () => {
                                const selectedFlavors = document.querySelectorAll('.saborCheckbox:checked');

                                if (selectedFlavors.length >= maxAllowedFlavors) {
                                    // Desabilita os checkboxes restantes quando atingir o limite
                                    saborCheckboxes.forEach(cb => {
                                        if (!cb.checked) {
                                            cb.disabled = true;
                                        }
                                    });
                                } else {
                                    // Habilita todos os checkboxes se estiver abaixo do limite
                                    saborCheckboxes.forEach(cb => {
                                        cb.disabled = false;
                                    });
                                }

                                if (selectedFlavors.length > maxAllowedFlavors) {
                                    checkbox.checked = false;
                                    limitMessage.textContent = `Limite de ${maxAllowedFlavors} sabores atingido.`;
                                } else {
                                    limitMessage.textContent = `Selecione até ${maxAllowedFlavors} sabores.`;
                                }
                            });
                        });
                    });

                </script> 

                    <p id="sizeSelectMessage" style="display: none; color: red; text-align: center; margin-bottom: 10px;">
                        Selecione algum tamanho antes.
                    </p>


                <div class="saborEborda"> 
                            <!-- Sabores Salgados -->
                            <label for="sabor">
                                    <span style="color: #800000;">
                                        <h3 style="color: #800000;">SABORES:</h3>
                                    </span>
                            </label>

                                <h3 style="color: black;">
                                    <span style="color: red;">SELECIONE</span> os sabores que você deseja aqui 🔻
                                </h3>
                               
                                <!-- Adicione um container para os checkboxes -->
                                <div id="saboresContainer">
                                    <?php
                                     $conn = new mysqli("robb0254.publiccloud.com.br", "calor_developer", "@Samsung2023", "calorysistemas_delivery");
                                     if ($conn->connect_error) {
                                         die("Falha na conexão: " . $conn->connect_error);
                                     }
                                 
                                     $sqlSabores = "SELECT * FROM montar WHERE id_login = $id_login AND id_variedades = 2";
                                     $resultSabores = $conn->query($sqlSabores);
                                 
                                     if ($resultSabores->num_rows > 0) {
                                         // Exibe os sabores associados ao id_login da URL
                                         while ($rowSabor = $resultSabores->fetch_assoc()) {
                                             echo '<input type="checkbox" class="saborCheckbox" value="' . $rowSabor["nome"] . '"> ' . $rowSabor["nome"] . '<br>';
                                         }
                                     }

                                    // Sabores salgados
                                    $sqlSalgados = "SELECT * FROM montar WHERE id_login = $id_login AND id_variedades = 1";
                                    $resultSalgados = $conn->query($sqlSalgados);

                                    if ($resultSalgados->num_rows > 0) {
                                        echo '<h4>Doces:</h4>';
                                        while ($rowSalgados = $resultSalgados->fetch_assoc()) {
                                            echo '<input type="checkbox" class="saborCheckbox saborSalCheckbox" value="' . $rowSalgados["nome"] . '"> ' . $rowSalgados["nome"] . '<br>';
                                        }
                                    }


                                    $conn->close();
                                    ?>
                                </div>



                                <input type="hidden" style="width: 30%; padding: 5px; " class="form-select" name="sabor" id="sabor">
                                <p id="saboresSelecionados" style="color: black;"></p>

                                <script>
                                    const saborCheckboxes = document.querySelectorAll('.saborCheckbox');
                                    const saborInput = document.getElementById('sabor');
                                    const saboresSelecionados = document.getElementById('saboresSelecionados');

                                    saborCheckboxes.forEach(checkbox => {
                                        checkbox.addEventListener('change', () => {
                                            const saboresSelecionadosArray = Array.from(saborCheckboxes)
                                                .filter(checkbox => checkbox.checked)
                                                .map(checkbox => checkbox.value);

                                            saborInput.value = saboresSelecionadosArray.join('* ');
                                        });
                                    });
                                </script>

                            <!-- Bordas Salgadas -->
                            <label for="bordas">
                            <span style="color: #800000;">
                                <h3 style="color: #800000;">BORDAS:</h3>
                            </span>
                        </label>
                        <h3 style="color: black;">
                            <span style="color: red;">SELECIONE</span> as bordas que você deseja aqui 🔻
                        </h3>

                        <!-- Adicione um container para os checkboxes -->
                        <div id="bordasContainer">
                            <?php
                                $conn = new mysqli("robb0254.publiccloud.com.br", "calor_developer", "@Samsung2023", "calorysistemas_delivery");
                                if ($conn->connect_error) {
                                    die("Falha na conexão: " . $conn->connect_error);
                                }
                                
                                $sqlBordas = "SELECT * FROM montar WHERE id_login = $id_login AND id_variedades = 4"; // Substitua id_variedades pelo valor correto das bordas
                                $resultBordas = $conn->query($sqlBordas);
                                
                                if ($resultBordas->num_rows > 0) {
                                    // Exibe as bordas associadas ao id_login da URL
                                    while ($rowBorda = $resultBordas->fetch_assoc()) {
                                        echo '<input type="checkbox" class="bordasCheckbox" value="' . $rowBorda["nome"] . '"> ' . $rowBorda["nome"] . '<br>';
                                    }
                                }
                                
                                $conn->close();
                            ?>
                        </div>

                        <input type="hidden" style="width: 30%; padding: 5px;" class="form-select" name="bordas" id="bordas">
                        <p id="bordasSelecionados" style="color: black;"></p>

                                                

                        <script>
                            const bordasCheckboxes = document.querySelectorAll('.bordasCheckbox');
                            const bordasInput = document.getElementById('bordas');
                            const bordasSelecionados = document.getElementById('bordasSelecionados');

                            bordasCheckboxes.forEach(checkbox => {
                                checkbox.addEventListener('change', () => {
                                    const bordasSelecionadosArray = Array.from(bordasCheckboxes)
                                        .filter(checkbox => checkbox.checked)
                                        .map(checkbox => checkbox.value);


                                    bordasInput.value = bordasSelecionadosArray.join('* ');
                                });
                            });

                            const maxBordas = 2;

                                bordasCheckboxes.forEach(checkbox => {
                                    checkbox.addEventListener('change', () => {
                                        const checkedBordas = document.querySelectorAll('.bordasCheckbox:checked');

                                        if (checkedBordas.length >= maxBordas) {
                                            bordasCheckboxes.forEach(cb => {
                                                if (!cb.checked) {
                                                    cb.disabled = true;
                                                }
                                            });
                                        } else {
                                            bordasCheckboxes.forEach(cb => {
                                                cb.disabled = false;
                                            });
                                        }
                                    });
                                });
                        </script>

                    
                    <input class="my-btn" name="montarpizza" type="submit" value="Finalizar Pizza">
                </div>
                </form>
        </div><br><br>
            <?php include('inc/footer.php'); ?>
    </body>
</html>


