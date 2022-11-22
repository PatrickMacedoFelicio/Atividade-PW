<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '_parts/_linkCSS.php'; ?>
    <title>Nova Ordem</title>
    <link rel="icon" type="url" href="https://cdn-icons-png.flaticon.com/512/6917/6917991.png">
</head>

<body>
    <header>

    </header>
    <?php include_once '_parts/_header.php'; ?>
    <div class="container mt-3">

        <section class="container mt-3">
            <?php
            spl_autoload_register(function ($class) {
                require_once "./Classes/{$class}.class.php";
            });
            if (filter_has_var(INPUT_GET, 'id')) {
                $ordem = new OrdemServico();
                $id = filter_input(INPUT_GET, 'id');
                $ordemEdit = $ordem->buscar('idOS', $id);
            }
            if (filter_has_var(INPUT_GET, 'idDel')) {
                $ordem = new OrdemServico();
                $id = filter_input(INPUT_GET, 'idDel');
                $servico->deletar('idOS', $id);

            ?>
                <script>
                    window.location.href = 'ordens.php';
                </script>
            <?php
            }
            if (filter_has_var(INPUT_POST, 'btnGravar')) {
                $ordem = new OrdemServico();
                $id = filter_input(INPUT_POST, 'txtNumero');
                $ordem->setId($id);
                $ordem->setCliente(filter_input(INPUT_POST, 'sltCliente'));
                $ordem->setData(filter_input(INPUT_POST, 'txtData'));
                $ordem->setTotalOS(filter_input(INPUT_POST, 'txtTotal'));
                $ordem->setDescontosOS(filter_input(INPUT_POST, 'txtDesconto'));
                if (empty($id)) {
                    $ordem->inserir();
                } else $ordem->atualizar('idOS', $id);

            ?>
                <script>
                    window.location.href = 'ordens.php';
                </script>
            <?php
            } else {
            ?>

                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="txtNumero" class="form-label">N° Ordem de Serviço</label>
                            <input type="text" name="txtNumero" id="txtNumero" class="form-control" value="<?php echo isset($ordemEdit->idOS) ? $ordemEdit->idOS : null ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="txtData" class="form-label">Data</label>
                            <input type="date" name="txtData" id="txtData" value="<?php echo date('Y-n-d') ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label for="sltCliente" class="form-label"></label>
                            <select name="sltCliente" id="sltCliente" class="form-select">
                                <?php
                                $cliente = new Cliente();
                                foreach ($cliente->listaUnico('nomeCliente', 'idCliente') as $key => $row) {
                                ?>
                                    <option value="<?php echo $row->idCliente ?>"><?php echo $row->nomeCliente ?></option>
                                <?php
                                };
                                ?>
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>

                    <!-- Button t   rigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalOS">
                        adicionar serviço
                    </button>
                    <div class="row mt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Serviço</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Excluir</th>
                                </tr>
                            </thead>
                            <tbody id="itemOS">

                            </tbody>
                        </table>
                    </div>

                </form>
            <?php
            }
            ?>
        </section>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalOS" tabindex="-1" aria-labelledby="modalOSLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">a gente tem esses programas keridaaaah 😘</h1>
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
                            foreach($servicos ->listaOrdenada('nomeServico') as $key=>$row){
                            ?>
                            <tr>
                                <th scope="row"><?php echo $row->idServico?></th>
                                <td><?php echo $row->nomeServico?></td>
                                <td><?php echo $row->precoServico?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="addServico(<?php echo $row->idServico ?>, '<?php echo $row->nomeServico ?>', <?php echo $row->precoServico ?>)"><i class="bi bi-plus-circle"></i></button>
                                </td>
                            </tr>
                            <tr>
                            
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">o fecho da gata 💅</button>
                </div>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
    <?php include '_parts/_linkJS.php'; ?>
</body>

</html>