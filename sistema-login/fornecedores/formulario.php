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
    <title>Dashboard - Cadastro de Fornecedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(135deg, #181a1b 0%, #23272b 100%);
        color: #f8fafc;
        min-height: 100vh;
        font-family: 'Segoe UI', Arial, sans-serif;
    }
    .card {
        border-radius: 1.25rem;
        box-shadow: 0 4px 32px rgba(0,0,0,0.6);
        background: #22262a;
        color: #f8fafc;
        border: 1px solid #343a40;
        transition: box-shadow 0.2s;
    }
    .form-label {
        font-weight: 600;
        color: #f8fafc;
        letter-spacing: 0.02em;
    }
    .form-control, .form-select {
        background: #181a1b;
        color: #f8fafc;
        border: 1.5px solid #343a40;
        border-radius: 0.5rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.10);
        background: #23272b;
        color: #f8fafc;
    }
   .btn-primary {
        background: linear-gradient(135deg, #b0b0b0 0%, #6e6e6e 100%);
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        padding: 0.45rem 1.4rem;
        color: #23272b;
        box-shadow: 0 2px 10px rgba(60,60,60,0.13);
        letter-spacing: 0.01em;
        transition: background 0.18s, box-shadow 0.18s, transform 0.10s;
        position: relative;
        overflow: hidden;
    }
    .btn-primary:hover, .btn-primary:focus {
        background: linear-gradient(135deg, #d3d3d3 0%, #b0b0b0 100%);
        color: #23272b;
        box-shadow: 0 4px 18px rgba(60,60,60,0.18);
        transform: translateY(-1px) scale(1.02);
        outline: none;
    }
    .btn-primary:active {
        background: linear-gradient(135deg, #8a8a8a 0%, #5a5a5a 100%);
        box-shadow: 0 1px 4px rgba(60,60,60,0.10);
        transform: scale(0.97);
    }
    .form-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #f8fafc;
        font-weight: 700;
        letter-spacing: 0.01em;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .img-preview {
        border-radius: 0.7rem;
        border: 2px solid #343a40;
        margin-top: 0.5rem;
        background: #181a1b;
        max-width: 120px;
        max-height: 120px;
        object-fit: cover;
        box-shadow: 0 2px 12px rgba(0,0,0,0.25);
    }
    .form-control::placeholder {
        color: #adb5bd;
        opacity: 1;
    }
    @media (max-width: 767.98px) {
        .img-preview {
            max-width: 90px;
            max-height: 90px;
        }
        .form-title {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
    </style>
</head>

<body>
    <?php include "../mensagens.php"; include "../navbar.php"; ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card p-4">
                    <div class="form-title mb-4">
                        <h2 class="mb-0 text-center flex-grow-1">Cadastrar fornecedor</h2>
                        <a href="/fornecedores/formulario.php" class="btn btn-primary btn-sm ms-auto">Novo Fornecedor</a>
                    </div>
                    <form id="fornecedorForm" action="/fornecedores/cadastrar.php" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
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
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">Salvar</button>
                        </div>
                    </form>
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
        } else if (cep.length > 0) {
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
