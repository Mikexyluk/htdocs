<?php
include "../verificar-autenticacao.php";

$pagina = "fornecedores";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/fornecedores/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        $fornecedor = $response["data"][0];
    } else {
        $fornecedor = null;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: #181a1b;
        color: #f8fafc;
    }

    .card {
        border-radius: 1rem;
        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.3);
        background: #23272b;
        color: #f8fafc;
    }

    .form-label {
        font-weight: 500;
        color: #f8fafc;
    }

    .form-control {
        background: #181a1b;
        color: #f8fafc;
        border: 1px solid #343a40;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, .15);
        background: #23272b;
        color: #f8fafc;
    }

    .btn-primary {
        background-color: #b0b0b0;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.15rem;
        margin-top: 1rem;
        transition: background 0.2s;
        color: #23272b;
    }

    .btn-primary:hover {
        background-color: #e0e0e0;
        color: #23272b;
    }

    .form-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #f8fafc;
    }

    .img-preview {
        border-radius: 0.5rem;
        border: 1px solid #343a40;
        margin-top: 0.5rem;
        background: #181a1b;
    }

    .form-control::placeholder {
        color: #adb5bd;
        opacity: 1;
    }
    </style>

</head>

<body>
    <?php include "../mensagens.php"; include "../navbar.php"; ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="card p-4">
                    <div class="form-title mb-4">
                        <h2 class="mb-0">Cadastrar fornecedor</h2>
                        <a href="/fornecedores/formulario.php" class="btn btn-primary btn-sm">Novo Fornecedores</a>
                    </div>
                    <form id="fornecedorForm" action="/fornecedores/cadastrar.php" method="POST"
                        enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="fornecedorId" class="form-label">Código do Fornecedor</label>

                                <input type="text" class="form-control" id="fornecedorId" name="fornecedorId" readonly
                                    value="<?php echo isset($fornecedor) ? $fornecedor["id_fornecedor"] : ""; ?>">
                            </div>


                            <div class="col-md-8">
                                <label for="fornecedorrazaoSocial" class="form-label">Razão Social</label>
                                <input type="text" class="form-control" id="fornecedorrazaoSocial"
                                    name="fornecedorrazaoSocial" required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["razao_social"] : ""; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="fornecedorCNPJ" class="form-label">CNPJ</label>
                                <input data-mask="00.000.000/0000-00" type="text" class="form-control"
                                    id="fornecedorCNPJ" name="fornecedorCNPJ" required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["cnpj"] : ""; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="fornecedorEmail" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="fornecedorEmail" name="fornecedorEmail"
                                    required value="<?php echo isset($fornecedor) ? $fornecedor["email"] : ""; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="fornecedorPhone" class="form-label">Telefone</label>
                                <input data-mask="(00) 00000-0000" type="text" class="form-control" id="fornecedorPhone"
                                    name="fornecedorPhone" required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["telefone"] : ""; ?>">
                            </div>

                            <div class="col-md-4">
                                <label for="fornecedorCEP" class="form-label">CEP</label>
                                <input data-mask="00000-000" type="text" class="form-control" id="fornecedorCEP"
                                    name="fornecedorCEP" required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["cep"] : ""; ?>">
                            </div>
                            <div class="col-md-8">
                                <label for="fornecedorStreet" class="form-label">Logradouro</label>
                                <input type="text" class="form-control" id="fornecedorStreet" name="fornecedorStreet"
                                    required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["logradouro"] : ""; ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="fornecedorNumber" class="form-label">Número</label>
                                <input type="text" class="form-control" id="fornecedorNumber" name="fornecedorNumber"
                                    required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["numero"] : ""; ?>">
                            </div>
                            <div class="col-md-9">
                                <label for="fornecedorComplement" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="fornecedorComplement"
                                    name="fornecedorComplement"
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["complemento"] : ""; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="fornecedorNeighborhood" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="fornecedorNeighborhood"
                                    name="fornecedorNeighborhood" required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["bairro"] : ""; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="fornecedorCity" class="form-label">Cidade</label>
                                <input type="text" readonly maxlength="2" class="form-control" id="fornecedorCity"
                                    name="fornecedorCity" required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["cidade"] : ""; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="fornecedorState" class="form-label">Estado</label>
                                <input type="text" readonly class="form-control" id="fornecedorState"
                                    name="fornecedorState" required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["estado"] : ""; ?>">
                            </div>
                           <div class="d-flex justify-content-end mt-4">
                            <button type="submit" href='./' class="btn btn-primary px-4">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
    $('#fornecedorCEP').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep.length === 8) {
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/?callback=?', function(data) {
                if (!data.erro) {
                    $('#fornecedorStreet').val(data.logradouro);
                    $('#fornecedorNeighborhood').val(data.bairro);
                    $('#fornecedorCity').val(data.localidade);
                    $('#fornecedorState').val(data.uf);
                } else {
                    alert('CEP não encontrado.');
                    $("#fornecedorCEP").val("");
                    $("#fornecedorStreet").val("");
                    $("#fornecedorNeighborhood").val("");
                    $("#fornecedorCity").val("");
                    $("#fornecedorState").val("");
                }
            });
        } else {
            alert('Formato de CEP inválido.');
            $("#fornecedorCEP").val("");
            $("#fornecedorStreet").val("");
            $("#fornecedorNeighborhood").val("");
            $("#fornecedorCity").val("");
            $("#fornecedorState").val("");
        }
    });
    </script>
</body>

</html>