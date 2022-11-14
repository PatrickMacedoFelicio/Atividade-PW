<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '_parts/_linkCSS.php'; ?>
    <title>Novo Cliente</title>
</head>

<body>
    <?php include_once '_parts/_header.php'; ?>

    <section class="container mt-3">
        <?php
        spl_autoload_register(function ($class) {
            require_once "./Classes/{$class}.class.php";
        });
        if (filter_has_var(INPUT_GET, 'id')) {
            $cliente = new Cliente();
            $id = filter_input(INPUT_GET, 'id');
            $clienteEdit = $cliente->buscar('idCliente', $id);
        }
        if (filter_has_var(INPUT_GET, 'idDel')) {
            $cliente = new Cliente();
            $id = filter_input(INPUT_GET, 'idDel');
            $cliente->deletar('idCliente', $id);
        ?>
            <script>
                window.location.href = 'cliente.php';
            </script>
        <?php
        }
        if (filter_has_var(INPUT_POST, 'btnGravar')) {
            $cliente = new Cliente();
            $id = filter_input(INPUT_POST, 'txtId');
            $cliente->setId($id);
            $cliente->setNome(filter_input(INPUT_POST, 'txtNomeCliente'));
            $cliente->setEndereco(filter_input(INPUT_POST, 'txtEndereco'));
            $cliente->setTelefone(filter_input(INPUT_POST, 'txtTelefone'));
            $cliente->setNascimento(filter_input(INPUT_POST, 'txtDataNasc'));
            $cliente->setBairro(filter_input(INPUT_POST, 'txtBairro'));
            $cliente->setCidade(filter_input(INPUT_POST, 'txtCidade'));
            $cliente->setEstado(filter_input(INPUT_POST, 'txtBairro'));
            if (empty($id)) {
                $cliente->inserir();
            } else {
                $cliente->atualizar('idCliente', $id);
            }
        } else {
        ?>

            <div class="container mt-3">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div>
                        <div class="row align-items-start">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="txtNomeCliente" name="txtNomeCliente" placeholder="Nome" value="<?php echo isset($clienteEdit->nomeCliente) ? $clienteEdit->nomeCliente : null ?>">
                                    <label for="txtNomeCliente">Nome</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="txtEndereco" name="txtEndereco" placeholder="Endereço" value="<?php echo isset($clienteEdit->enderecoCliente) ? $clienteEdit->enderecoCliente : null ?>">
                                    <label for="txtEndereco">Endereco</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="txtTelefone" name="txtTelefone" placeholder="Telefone" value="<?php echo isset($clienteEdit->telefoneCliente) ? $clienteEdit->telefoneCliente : null ?>">
                                    <label for="txtTelefone">Telefone</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row align-items-start">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="txtDataNasc" name="txtDataNasc" placeholder="Data de Nascimento" value="<?php echo date('Y-m-d'), isset($clienteEdit->nascimentoCliente) ? $clienteEdit->nascimentoCliente : null ?>">
                                    <label for="txtDataNasc">Data de Nascimento</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="txtBairro" name="txtBairro" placeholder="Bairro" value="<?php echo isset($clienteEdit->bairroCliente) ? $clienteEdit->bairroCliente : null ?>">
                                    <label for="txtBairro">Bairro</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="txtCidade" name="txtCidade" placeholder="CidadetxtCidade" value="<?php echo isset($clienteEdit->cidadeCliente) ? $clienteEdit->cidadeCliente : null ?>">
                                    <label for="txtCidade">Cidade</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="txtEstado" name="txtBairro" placeholder="Estado" value="<?php echo isset($clienteEdit->estadoCliente) ? $clienteEdit->estadoCliente : null ?>">
                                <label for="txtEstado">Estado</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btnGravar">Salvar</button>
                </form>
            </div>
        <?php
        }
        ?>
    </section>
    <?php include '_parts/_linkJS.php'; ?>
</body>

</html>