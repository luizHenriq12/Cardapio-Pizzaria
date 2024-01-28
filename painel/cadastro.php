<?php
$servername = "robb0254.publiccloud.com.br";
$db_username = "calor_developer";
$db_password = "@Samsung2023";
$dbname = "calorysistemas_delivery";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeResp = $_POST['nomeResp'];
    $cpfResp = $_POST['cpfResp'];
    $celularResp = $_POST['celularResp'];
    $dataNaciResp = $_POST['dataNaciResp'];
    $nome = $_POST['nome'];
    $nomeFantasia = $_POST['nomeFantasia'];
    $telefone = $_POST['telefone'];
    $cnpj = $_POST['cnpj'];
    $inscricaoEstadual = $_POST['inscricaoEstadual'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $logo = $_FILES["logo"];
    $status = "ativo"; // Definindo o status como ativo por padrão

    $target_directory = "./images/";
    $target_file = $target_directory . basename($logo["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verifica se o arquivo é uma imagem real ou uma imagem falsa
    if (isset($_POST["submit"])) {
        $check = getimagesize($logo["tmp_name"]);
        if ($check !== false) {
            echo '<script>alert("Arquivo é uma imagem - " . $check["mime"] . ".");</script>';
            $uploadOk = 1;
        } else {
            echo '<script>alert("O arquivo não é uma imagem.");</script>';
            $uploadOk = 0;
        }
    }

    // Concatenando os dados do endereço
    $enderecoCompleto = "CEP: $cep, RUA: $rua, N: $numero, BAIRRO: $bairro, COMPLEMENTO: $complemento";

    // Inserir no banco de dados após o upload do arquivo
    $sql = "INSERT INTO login (nomeResp, cpfResp, celularResp, dataNaciResp, nome, nomeFanta, telefone, cnpj, inscricaoEstadual, endereco, cidade, estado, email, senha, logo, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da declaração: " . $conn->error);
    }

    $stmt->bind_param("ssssssssssssssss", $nomeResp, $cpfResp, $celularResp, $dataNaciResp, $nome, $nomeFantasia, $telefone, $cnpj, $inscricaoEstadual, $enderecoCompleto, $cidade, $estado, $email, $senha, $target_file, $status);

    if ($stmt->execute()) {
        echo '<script>alert("O cadastro foi um sucesso.");</script>';
        header("Location: login.php");
        exit();
    } else {
        echo '<script>alert("Erro ao cadastrar: ' . $stmt->error . '");</script>';
    }

    $stmt->close();
    $conn->close();
} else {
    echo '<script>alert(""Desculpe, houve um erro ao enviar o arquivo."");</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, red, yellow);
            margin: 0;
            padding: 20px; /* Adicionando um espaçamento ao redor */
        }

        .box {
             max-width: 800px;
            margin: 0 auto; /* Centralizando o conteúdo */
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 15px;
        }

        form {
            color: white;
        }

        fieldset{
            border: 3px solid red;
            border-radius: 5px;
        }

        legend{
            border: 1px solid red;
            padding: 10px;
            text-align: center;
            background-color: red;
            border-radius: 5px;
        }

        .inputBox{
            position: relative;
        }

        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }

        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }

        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: #fff;
        }

        #submit{
            background-image: linear-gradient(to right, red, yellow);
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }

        #submit:hover{
            background-image: linear-gradient(to right, blue, purple);
        }

        #dataNaciResp {
        /* Estilos para o input de data */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 20%;
            cursor: pointer;
            }

            #dataNaciResp:focus {
            /* Estilos quando o input de data está em foco */
            outline: none;
            border-color: #3498db; /* Mudança de cor ao receber foco */
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5); /* Sombra ao receber foco */
        }
    </style>
</head>
<body>
    <div class="box">
        <form action="cadastro.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend><b>Informações do Usuário</b></legend><br><br>
                <div class="inputBox">
                    <input type="text" name="nomeResp" id="nomeResp" class="inputUser" required>
                    <label for="nomeResp" class="labelInput">Nome do Responsável</label>
                </div><br><br>

                <div class="inputBox">
                    <input type="text" name="cpfResp" id="cpfResp" class="inputUser" required maxlength="11" oninput="validateCPF(this)">
                    <label for="cpfResp" class="labelInput">CPF do responsável</label>
                    <span id="cpfError" class="error" style="display: none; color: red;">CPF inválido. Por favor, digite um CPF válido.</span>
                </div>
                <script>
                    function validateCPF(input) {
                        const cpf = input.value.replace(/[^\d]/g, ''); // Remove caracteres não numéricos
                        const cpfError = document.getElementById('cpfError');

                        if (cpf.length !== 11 || !validateDigits(cpf)) {
                            cpfError.style.display = 'inline';
                            input.setCustomValidity('CPF inválido'); // Adiciona uma mensagem de validação para o campo
                        } else {
                            cpfError.style.display = 'none';
                            input.setCustomValidity(''); // Campo é válido, remove a mensagem de validação
                        }
                    }

                    function validateDigits(cpf) {
                        const cpfArray = cpf.split('').map(Number);

                        // Validação dos dígitos do CPF
                        let sum = 0;
                        let mod;

                        // Primeiro dígito verificador
                        for (let i = 0; i < 9; i++) {
                            sum += cpfArray[i] * (10 - i);
                        }
                        mod = (sum * 10) % 11;
                        if (mod === 10 || mod === 11) mod = 0;
                        if (mod !== cpfArray[9]) return false;

                        // Segundo dígito verificador
                        sum = 0;
                        for (let i = 0; i < 10; i++) {
                            sum += cpfArray[i] * (11 - i);
                        }
                        mod = (sum * 10) % 11;
                        if (mod === 10 || mod === 11) mod = 0;
                        if (mod !== cpfArray[10]) return false;

                        return true;
                    }
                </script><br><br>
                <div class="inputBox">
                    <input type="text" name="celularResp" id="celularResp" class="inputUser" required pattern="\([0-9]{2}\) [0-9] [0-9]{4}-[0-9]{4}" title="Formato esperado: (xx) x xxxx-xxxx">
                    <label for="celularResp" class="labelInput">Celular do Responsável</label>
                </div><br><br>
                <script>
                    const celularInput = document.getElementById('celularResp');

                    celularInput.addEventListener('input', function () {
                        let celular = celularInput.value.replace(/\D/g, '');
                        let formattedCelular;

                        if (celular.length === 11) {
                            formattedCelular = celular.replace(/^(\d{2})(\d{1})(\d{4})(\d{4})$/, '($1) $2 $3-$4');
                            celularInput.value = formattedCelular;
                        }
                    });
                </script>


                <div class="inputBox">
                    <label for="dataNaciResp"><b>Data de Nascimento</b></label>
                    <input type="date" name="dataNaciResp" id="dataNaciResp" class="inputUser" required>
                </div><br><br>

            </fieldset><br><br>

            <fieldset><br><br>
                <legend><b>Cadastro de Empresas</b></legend><br><br>
                <!-- Campos da Empresa -->
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Razão Social</label>
                </div><br><br>

                <div class="inputBox">
                    <input type="text" name="nomeFantasia" id="nomeFantasia" class="inputUser" required>
                    <label for="nomeFantasia" class="labelInput">Nome Fantasia</label>
                </div><br><br>

                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required pattern="\([0-9]{2}\) [0-9] [0-9]{4}-[0-9]{4}" title="Formato esperado: (xx) x xxxx-xxxx">
                    <label for="telefone" class="labelInput">Telefone</label>
                </div><br><br>
                <script>
                    const telefoneInput = document.getElementById('telefone');

                    telefoneInput.addEventListener('input', function () {
                    const telefone = telefoneInput.value.replace(/\D/g, '');
                    let formattedTelefone;

                    if (telefone.length === 11) {
                        formattedTelefone = telefone.replace(/^(\d{2})(\d{1})(\d{4})(\d{4})$/, '($1) $2 $3-$4');
                    } else if (telefone.length === 8) {
                        formattedTelefone = telefone.replace(/^(\d{4})(\d{4})$/, '$1-$2');
                    } else {
                        formattedTelefone = telefone;
                    }

                    telefoneInput.value = formattedTelefone;
                    });
                </script>
                <div class="inputBox">
                    <input type="text" name="cnpj" id="cnpj" class="inputUser" required maxlength="14" oninput="validateCNPJ(this)">
                    <label for="cnpj" class="labelInput">CNPJ do responsável</label>
                    <span id="cnpjError" class="error" style="display: none; color: red;">CNPJ inválido. Por favor, digite um CNPJ válido.</span>
                </div><br><br>
                <script>
                    function validateCNPJ(input) {
                        const cnpj = input.value.replace(/[^\d]/g, ''); // Remove caracteres não numéricos
                        const cnpjError = document.getElementById('cnpjError');

                        if (cnpj.length !== 14 || !validateDigitsCNPJ(cnpj)) {
                            cnpjError.style.display = 'inline';
                            input.setCustomValidity('CNPJ inválido'); // Adiciona uma mensagem de validação para o campo
                        } else {
                            cnpjError.style.display = 'none';
                            input.setCustomValidity(''); // Campo é válido, remove a mensagem de validação
                        }
                    }

                    function validateDigitsCNPJ(cnpj) {
                        const cnpjArray = cnpj.split('').map(Number);

                        // Validação dos dígitos do CNPJ
                        let size = cnpj.length - 2;
                        let numbers = cnpj.substring(0, size);
                        const digits = cnpj.substring(size);
                        let sum = 0;
                        let position = size - 7;

                        for (let i = size; i >= 1; i--) {
                            sum += numbers.charAt(size - i) * position--;
                            if (position < 2) {
                                position = 9;
                            }
                        }

                        let result = sum % 11 < 2 ? 0 : 11 - (sum % 11);

                        if (result != digits.charAt(0)) {
                            return false;
                        }

                        size = size + 1;
                        numbers = cnpj.substring(0, size);
                        sum = 0;
                        position = size - 7;

                        for (let i = size; i >= 1; i--) {
                            sum += numbers.charAt(size - i) * position--;
                            if (position < 2) {
                                position = 9;
                            }
                        }

                        result = sum % 11 < 2 ? 0 : 11 - (sum % 11);

                        if (result != digits.charAt(1)) {
                            return false;
                        }

                        return true;
                    }
                </script>

                <div class="inputBox">
                    <input type="text" name="inscricaoEstadual" id="inscricaoEstadual" class="inputUser" required>
                    <label for="inscricaoEstadual" class="labelInput">Inscrição Estadual</label>
                </div><br><br>

                <script>
                    function validarInscricaoEstadual(ie) {
                        // Lógica para validar a inscrição estadual aqui
                        // Por exemplo, verifique se a inscrição existe ou segue um padrão específico
                        // Retorna true se for válida e false se for inválida
                        // Aqui você pode fazer uma requisição para validar a inscrição estadual em algum serviço online ou verificar localmente conforme as regras do estado
                        
                        // Simulando uma validação simples (substitua com a validação real)
                        if (ie.length >= 8) {
                            return true; // Inscrição estadual válida (simulação)
                        } else {
                            return false; // Inscrição estadual inválida (simulação)
                        }
                    }

                    document.getElementById('submit').addEventListener('click', function(event) {
                        const inscricaoEstadual = document.getElementById('inscricaoEstadual').value;

                        if (!validarInscricaoEstadual(inscricaoEstadual)) {
                            alert('Inscrição estadual inválida ou inexistente. Por favor, insira uma inscrição válida.');
                            event.preventDefault(); // Impede o envio do formulário se a inscrição estadual for inválida
                        }
                    });
                </script>

                <br><br>
                <legend><b>Detalhes do Endereço</b></legend><br><br>
                <div class="inputBox">
                    <input type="text" name="cep" id="cep" class="inputUser" required>
                    <label for="cep" class="labelInput">CEP</label>
                </div><br><br>

                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" required>
                    <label for="cidade" class="labelInput">Cidade</label>
                </div><br><br>

                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" required>
                    <label for="estado" class="labelInput">Estado</label>
                </div><br><br>

                <div class="inputBox">
                    <input type="text" name="rua" id="rua" class="inputUser" required>
                    <label for="rua" class="labelInput">Rua</label>
                </div><br><br>

                <div class="inputBox">
                    <input type="text" name="numero" id="numero" class="inputUser" required>
                    <label for="numero" class="labelInput">Número</label>
                </div><br><br>

                <div class="inputBox">
                    <input type="text" name="bairro" id="bairro" class="inputUser" required>
                    <label for="bairro" class="labelInput">Bairro</label>
                </div><br><br>

                <div class="inputBox">
                    <input type="text" name="complemento" id="complemento" class="inputUser" required>
                    <label for="complemento" class="labelInput">Complemento</label>
                </div><br><br>

                <script>
                    // Função para fazer a requisição ao ViaCEP
                    function buscaCEP(cep) {
                        fetch(`https://viacep.com.br/ws/${cep}/json/`)
                            .then(response => response.json())
                            .then(data => {
                                // Preencher os campos de cidade e estado com os dados obtidos
                                document.getElementById('cidade').value = data.localidade;
                                document.getElementById('estado').value = data.uf;
                            })
                            .catch(error => console.error('Ocorreu um erro:', error));
                    }

                    // Event listener para detectar mudanças no campo de CEP
                    document.getElementById('cep').addEventListener('blur', function() {
                        const cep = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos do CEP
                        if (cep.length === 8) { // Verifica se o CEP tem o tamanho correto
                            buscaCEP(cep); // Chama a função de busca passando o CEP
                        } else {
                            alert('CEP inválido. Por favor, digite um CEP válido.');
                        }
                    });
                </script>

                <legend><b>Informações de Login</b></legend><br><br>

                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">E-mail</label>
                </div><br><br>

                <div class="inputBox">
                    <input type="text" name="email_confirm" id="email_confirm" class="inputUser" required>
                    <label for="email_confirm" class="labelInput">Confirmar E-mail</label>
                    <span id="emailMatchError" class="error" style="display: none; color: red;">Os e-mails não coincidem. Por favor, insira o mesmo e-mail.</span>
                </div><br><br>

                <div class="inputBox">
                    <input type="text" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div><br><br>

                <div class="inputBox">
                    <input type="text" name="senha_confirm" id="senha_confirm" class="inputUser" required>
                    <label for="senha_confirm" class="labelInput">Confirmar Senha</label>
                    <span id="senhaMatchError" class="error" style="display: none; color: red;">As senhas não coincidem. Por favor, insira a mesma senha.</span>
                </div><br><br>

                <div class="inputBox">
                    <p><label for="logo" class="labelInput" style="position: absolute;">Selecione sua Logo</label><br><br>
                    <input type="file" name="logo" id="logo" class="inputUser" required></p>
                </div><br><br>

            </fieldset><br><br>

            <input type="submit" name="submit" id="submit">
        </form>
    </div>

    <script>
        document.getElementById('submit').addEventListener('click', function(event) {
            const email = document.getElementById('email').value;
            const emailConfirm = document.getElementById('email_confirm').value;
            const senha = document.getElementById('senha').value;
            const senhaConfirm = document.getElementById('senha_confirm').value;
            
            if (email !== emailConfirm) {
                document.getElementById('emailMatchError').style.display = 'inline';
                event.preventDefault(); // Impede o envio do formulário se os emails não coincidirem
            } else {
                document.getElementById('emailMatchError').style.display = 'none';
            }
            
            if (senha !== senhaConfirm) {
                document.getElementById('senhaMatchError').style.display = 'inline';
                event.preventDefault(); // Impede o envio do formulário se as senhas não coincidirem
            } else {
                document.getElementById('senhaMatchError').style.display = 'none';
            }
        });
    </script>
    <script>
        const camposExcetoSenha = document.querySelectorAll('input[type="text"], input[type="tel"], input[type="file"], input[type="date"]');
        
        camposExcetoSenha.forEach(function (campo) {
            if (campo.id !== 'email' && campo.id !== 'senha') {
                campo.addEventListener('input', function (event) {
                    event.target.value = event.target.value.toUpperCase(); // Transforma o texto em maiúsculas
                });
            }
        });
    </script>
</body>
</html>