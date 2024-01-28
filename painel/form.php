<?php
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConexao();
?>

<div class="col">
    <form id="dados" action="process_order.php?order=<?php echo $orderNumber; ?>" method="post">
        <h4 style="color: red; text-align: center;">Dados para entrega</h4>
        <div style="display: flex; text-align: center;">
            <div>
                <h2 style="text-align: left;">informações:</h2>

                <div class="input-group input-group mb-3" style="display: flex; margin-top: 15px">
                    <input class="form-control w-80" type="number" name="nome-do-input" placeholder="CEP" id="cep" value="" required="true" />
                </div>

                <div class="input-group input-group mb-3">   
                    <input class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" type="text" name="rua" placeholder="Rua" id="logradouro" value="" required="true" style="border-radius: 5px;" />
                </div>

                <div class="input-group input-group mb-3">
                    <input class="form-control w-80" type="text" name="bairro" placeholder="Bairro" id="bairro" value="" required="true" />
                </div>

                <div class="input-group input-group mb-3">
                    <input class="form-control w-80" type="number" name="numero" placeholder="Número" id="id-do-input" required="true" required="true" />
                </div>

                <div class="input-group input-group mb-3">
                    <input class="form-control w-80" type="text" name="complemento" placeholder="Complemento" id="id-do-input" value="" />
                </div>

                <div class="input-group input-group mb-3">
                    <input class="form-control w-80" type="text" name="cidade" placeholder="Cidade" id="localidade" value="" required="true" />
                </div>

                <div class="input-group input-group mb-3">
                    <input class="form-control w-80" type="text" name="uf" placeholder="Estado" id="uf" value="" required="true" />
                </div>

                <div class="input-group input-group mb-3">
                    <input class="form-control w-80" type="text" name="nome" placeholder="Nome" id="nome" value="" required="true" />
                </div>

                <div class="input-group mb-3">
                    <input class="form-control w-80" type="tel" name="celular" placeholder="(xx) xxxxx-xxxx" id="celular" required="true" />
                    <div class="invalid-feedback">
                        Numero de 11 digitos (xx) xxxxx-xxxx
                    </div>
                    <script>
                        // Adicione um ouvinte de evento para a mudança no campo de entrada
                        document.getElementById('celular').addEventListener('input', function () {
                            var celularInput = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos
                            var isValidLength = celularInput.length === 11;

                            // Atualiza a classe de validação do Bootstrap
                            this.classList[isValidLength ? 'remove' : 'add']('is-invalid');
                        });
                    </script>
                </div>

            </div>


            <div style="margin-left: 80px;">
                <h4>Forma de pagamento</h4>
                <div>
                <select class="form-select w-80" name="forma_pagamento" id="forma_pagamento" required onchange="verifica(this.value)" style="width: 100%; margin: 20px auto;">
                    <option value="" disabled selected hidden style="display: none;">Selecione a Forma de Pagamento</option>
                    <option value="3">Dinheiro</option>
                    <option value="2">Cartão</option>
                    <option value="1">Pix</option>
                </select>
                <div class="mt-3">
                    <label for=""> Troco para:</label>
                    <input type="text" name="troco" placeholder="R$" id="troco" value="" disabled />
                </div>
                </div>
                <h4 class="mt-3" >Detalhes do pedido</h4>
                <p class="mb-1" id="Itens"><strong>Itens</strong>: <?php for ($i = 0; $i < $cont; $i++) echo " " . $qtd[$i] . " " . $itens[$i] . " - R$ " . $precos[$i] * $qtd[$i] ?></p>
                <p class="mb-1" id="Total-Itens"><strong>Total Itens</strong>: R$ <?php echo $orderTotal; ?></p>
                <p class="mb-1" id="Taxa"><strong>Taxa de entrega</strong>: R$ 3</p>
                <p class="mb-1" id="TotalPedido"><strong>Total pedido</strong>: R$ <?php echo $orderTotal + 3; ?></p>
                <input class="input-group input-group mt-3" name="obs" type="text" name="obs" placeholder="Observação" id="obs">
                <p><button id="btn" form="dados" type="submit" name="enviar" class="btn btn-outline-success mt-3">Confirmar Pedido</button></a></p>
            </div>
        </div>
    </form>

    <script src="./api/consultaCep.js"></script>
    <script>
        function verifica(value) {
            var input = document.getElementById("troco");

            if (value == 3) {
                input.disabled = false;
            } else {
                input.disabled = true;
            }
        };
    </script>
</div>