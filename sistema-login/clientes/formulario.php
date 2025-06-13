<?php
include "../verificar-autenticacao.php";

$pagina = "clientes";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/clientes/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        $client = $response["data"][0];
    } else {
        $client = null;
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
                        <h2 class="mb-0">Cadastrar Cliente</h2>
                        <a href="/clientes/formulario.php" class="btn btn-primary btn-sm">Novo Cliente</a>
                    </div>
                    <form id="clientForm" action="/clientes/cadastrar.php" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="clientId" class="form-label">Código</label>

                                <input type="text" class="form-control" id="clientId" name="clientId" readonly
                                    value="<?php echo isset($client) ? $client["id_cliente"] : ""; ?>">
                            </div>


                            <div class="col-md-8">
                                <label for="clientName" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="clientName" name="clientName" required
                                    value="<?php echo isset($client) ? $client["nome"] : ""; ?>">
                            </div>


                            <div class="col-md-6">
                                <label for="clientCPF" class="form-label">CPF</label>
                                <input data-mask="000.000.000-00" type="text" class="form-control" id="clientCPF"
                                    name="clientCPF" required
                                    value="<?php echo isset($client) ? $client["cpf"] : ""; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="clientEmail" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="clientEmail" name="clientEmail" required
                                    value="<?php echo isset($client) ? $client["email"] : ""; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="clientWhatsapp" class="form-label">Whatsapp</label>
                                <input data-mask="(00) 0 0000-0000" type="text" class="form-control" id="clientWhatsapp"
                                    name="clientWhatsapp" required
                                    value="<?php echo isset($client) ? $client["whatsapp"] : ""; ?>">
                            </div>

                            <div class="col-md-4">
                                <label for="clientImage" class="form-label">Imagem</label>
                                <input type="file" class="form-control" id="clientImage" name="clientImage"
                                    accept="image/*">
                                <?php
                                if (isset($client["imagem"])) {
                                    echo '
                                    <input type="hidden" name="currentClientImage" value="' . $client["imagem"] . '">
                                    <img width="100" class="img-preview" src="imagens/' . $client["imagem"] . '">
                                    ';
                                }
                                ?>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="clientCEP" class="form-label">CEP</label>
                                <input data-mask="00000-000" type="text" class="form-control" id="clientCEP"
                                name="clientCEP" required
                                value="<?php echo isset($client) ? $client["endereco"]["cep"] : ""; ?>">
                            </div>
                            
                            <div class="col-md-8">
                                <label for="clientStreet" class="form-label">Logradouro</label>
                                <input type="text" class="form-control" id="clientStreet" name="clientStreet" required
                                value="<?php echo isset($client) ? $client["endereco"]["logradouro"] : ""; ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="clientNumber" class="form-label">Número</label>
                                <input type="text" class="form-control" id="clientNumber" name="clientNumber" required
                                value="<?php echo isset($client) ? $client["endereco"]["numero"] : ""; ?>">
                            </div>
                            <div class="col-md-5">
                                <label for="clientComplement" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="clientComplement" name="clientComplement"
                                value="<?php echo isset($client) ? $client["endereco"]["complemento"] : ""; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="clientNeighborhood" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="clientNeighborhood"
                                name="clientNeighborhood" required
                                value="<?php echo isset($client) ? $client["endereco"]["bairro"] : ""; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="clientCity" class="form-label">Cidade</label>
                                <input type="text" readonly class="form-control" id="clientCity" name="clientCity"
                                required value="<?php echo isset($client) ? $client["endereco"]["cidade"] : ""; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="clientState" class="form-label">Estado</label>
                                <input type="text" readonly class="form-control" id="clientState" name="clientState"
                                required value="<?php echo isset($client) ? $client["endereco"]["estado"] : ""; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex align-items-end">
                            <?php
                            if (isset($produto["imagem"]) && $produto["imagem"]) {
                                echo '
                                <input type="hidden" name="currentClientImage" value="' . htmlspecialchars($produto["imagem"]) . '">
                                <img id="imgPreview" class="img-preview" src="clientes/imagens/' . htmlspecialchars($produto["imagem"]) . '" alt="Imagem do produto">';
                            } else {
                                echo '<img id="imgPreview" class="img-preview" style="display:none;" alt="Preview da imagem">';
                            }
                            ?>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" href='./' class="btn btn-primary px-4">Salvar</button>
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
    $('#clientCEP').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep.length === 8) {
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/?callback=?', function(data) {
                if (!data.erro) {
                    $('#clientStreet').val(data.logradouro);
                    $('#clientNeighborhood').val(data.bairro);
                    $('#clientCity').val(data.localidade);
                    $('#clientState').val(data.uf);
                } else {
                    alert('CEP não encontrado.');
                    $("#clientCEP").val("");
                    $("#clientStreet").val("");
                    $("#clientNeighborhood").val("");
                    $("#clientCity").val("");
                    $("#clientState").val("");
                }
            });
        } else if (cep.length > 0) {
            alert('Formato de CEP inválido.');
            $("#clientCEP").val("");
            $("#clientStreet").val("");
            $("#clientNeighborhood").val("");
            $("#clientCity").val("");
            $("#clientState").val("");
        }
    });
    </script>
</body>

</html>