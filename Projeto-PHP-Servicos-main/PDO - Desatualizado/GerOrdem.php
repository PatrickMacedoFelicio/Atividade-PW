<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '_parts/_linkCSS.php'; ?>
    <title>Nova Ordem de Serviço</title>
</head>

<body>
    <header>

    </header>
    <?php include_once '_parts/_header.php'; ?>
    <div class="container mt-3">
        <?php
        spl_autoload_register(function ($class) {
            require_once "./Classes/{$class}.class.php";
        });
        ?>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="row">
                <div class="col-md-2">
                    <label for="txtNumero" class="form-label">N° Ordem de Serviço</label>
                    <input type="text" name="txtNumero" id="txtNumero" readonly class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="txtData" class="form-label"></label>
                    <input type="date" name="txtData" id="txtData" value="<?php echo date('Y-m-d') ?>" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label for="sltCliente" class="form-label"></label>
                    <select name="sltCliente" id="sltCliente" class="form-select">

                        <?php
                        $cliente = new Cliente();
                        foreach ($cliente->listaOrdenada('nomeCliente', 'idCliente') as $key => $row) {
                        ?>
                            <option value="<?php echo $row->idCliente ?>"><?php echo $row->nomeCliente ?></option>
                        <?php
                        };
                        ?>
                        ?>


                        <option value="">Selecione O cliente"</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalOS">
                    Adicionar Serviço
                </button>
            </div>
            <div class="row mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Serviço</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Quantidada</th>
                            <th scope="col">Total</th>
                            <th scope="col">Excluir</th>
                        </tr>
                    </thead>
                    <tbody id=itemOS>
                    </tbody>
                </table>
            </div>
    </div>
    </form>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalOS" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Lista de Serviços</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Serviço</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Adicionar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            spl_autoload_register(function ($class) {
                                require_once "./Classes/{$class}.class.php";
                            });
                            $servicos = new Servico();
                            foreach ($servicos->listaOrdenada('nomeServico') as $key => $row) {

                            ?>
                                <tr>
                                    <th scope="row"><?php echo $row->idServico ?></th>
                                    <td><?php echo $row->nomeServico ?></td>
                                    <td>R$ <?php echo $row->precoServico ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="addServico('<?php echo $row->idServico ?>', '<?php echo $row->nomeServico ?>', '<?php echo $row->precoServico ?>')"><i class="bi bi-plus-circle"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="Js/script.js"></script>
    <?php include '_parts/_linkJS.php'; ?>
</body>

</html>