<?php
include "../verificar-autenticacao.php";
$pagina = "clientes";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    $client = $_SESSION["clientes"][$key];
}
?>
<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background: #f4f6fa;
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            transition: background 0.3s, color 0.3s;
        }
        .dark-mode {
            background: #181a1b !important;
            color: #f8f9fa !important;
        }
        .dark-mode .card, .dark-mode .table, .dark-mode .form-control, .dark-mode .modal-content {
            background: #23272b !important;
            color: #f8f9fa !important;
        }
        .dark-mode .form-label, .dark-mode .table th, .dark-mode .table td {
            color: #f8f9fa !important;
        }
        .toggle-dark {
            float: right;
        }
        .card {
            border: none;
            border-radius: 1rem;
        }
        .card-body {
            padding: 2rem;
        }
        .form-control, .form-select {
            border-radius: 0.5rem;
        }
        .btn-primary, .btn-success, .btn-danger, .btn-warning {
            border-radius: 0.5rem;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table img {
            border-radius: 0.5rem;
            border: 2px solid #dee2e6;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }
        .dark-mode .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #23272b !important;
        }
        .section-title {
            font-weight: 700;
            letter-spacing: 1px;
        }
        .btn-group-export {
            gap: 0.5rem;
        }
        @media (max-width: 991px) {
            .card-body {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="section-title mb-0 flex-grow-1">
                        <i class="bi bi-person-plus-fill me-2"></i> Cadastrar Cliente
                    </h2>
                    <a href="./" class="btn btn-primary btn-sm ms-2" title="Novo Cliente">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                    <button class="btn btn-outline-secondary btn-sm toggle-dark ms-2" id="toggleDarkBtn" title="Alternar modo escuro">
                        <span id="darkIcon" class="bi bi-moon"></span>
                        <span id="darkText">Modo Escuro</span>
                    </button>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <form id="clientForm" action="/clientes/cadastrar.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="clientId" class="form-label">Código do Cliente</label>
                                <input type="text" class="form-control" id="clientId" name="clientId" readonly value="<?php echo isset($key) ? $key : ""; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="clientName" class="form-label">Nome do Cliente</label>
                                <input onblur="teste()" type="text" class="form-control" id="clientName" name="clientName" required value="<?php echo isset($client) ? $client["clientName"] : ""; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="clientCPF" class="form-label">CPF</label>
                                <input data-mask="000.000.000-00" type="text" class="form-control" id="clientCPF" name="clientCPF" required value="<?php echo isset($client) ? $client["clientCPF"] : ""; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="clientEmail" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="clientEmail" name="clientEmail" required value="<?php echo isset($client) ? $client["clientEmail"] : ""; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="clientWhatsapp" class="form-label">Whatsapp</label>
                                <input data-mask="(00) 0 0000-0000" type="text" class="form-control" id="clientWhatsapp" name="clientWhatsapp" required value="<?php echo isset($client) ? $client["clientWhatsapp"] : ""; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="clientImage" class="form-label">Imagem</label>
                                <input type="file" class="form-control" id="clientImage" name="clientImage" accept="image/*">
                            </div>
                            <?php
                            if (isset($client["clientImage"])) {
                                echo '
                                <div class="mb-3">
                                    <input type="hidden" name="currentClientImage" value="' . $client["clientImage"] . '">
                                    <img width="100" src="imagens/' . $client["clientImage"] . '" class="rounded shadow">
                                </div>
                                ';
                            }
                            ?>
                            <div class="mb-3">
                                <label for="clientCEP" class="form-label">CEP</label>
                                <input data-mask="00000-000" type="text" class="form-control" id="clientCEP" name="clientCEP" required value="<?php echo isset($client) ? $client["clientCEP"] : ""; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="clientStreet" class="form-label">Logradouro</label>
                                <input type="text" class="form-control" id="clientStreet" name="clientStreet" required value="<?php echo isset($client) ? $client["clientStreet"] : ""; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="clientNumber" class="form-label">Número</label>
                                <input type="text" class="form-control" id="clientNumber" name="clientNumber" required value="<?php echo isset($client) ? $client["clientWhatsapp"] : ""; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="clientComplement" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="clientComplement" name="clientComplement" value="<?php echo isset($client) ? $client["clientComplement"] : ""; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="clientNeighborhood" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="clientNeighborhood" name="clientNeighborhood" required value="<?php echo isset($client) ? $client["clientNeighborhood"] : ""; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="clientCity" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="clientCity" name="clientCity" required value="<?php echo isset($client) ? $client["clientCity"] : ""; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="clientState" class="form-label">Estado</label>
                                <input type="text" class="form-control" id="clientState" name="clientState" required value="<?php echo isset($client) ? $client["clientState"] : ""; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-2">
                                <i class="bi bi-save me-1"></i> Salvar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="section-title mb-0 flex-grow-1">
                        <i class="bi bi-people-fill me-2"></i> Clientes Cadastrados
                    </h2>
                    <div class="btn-group-export d-flex">
                        <a href="exportar.php" class="btn btn-success btn-sm" title="Exportar Excel">
                            <i class="bi bi-file-earmark-excel"></i>
                        </a>
                        <a href="exportar_pdf.php" class="btn btn-danger btn-sm" title="Exportar PDF">
                            <i class="bi bi-file-earmark-pdf"></i>
                        </a>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Imagem</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">CPF</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Whatsapp</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="clientTableBody">
                                    <?php
                                    require("../requests/clientes/get.php");
                                    if(!empty($response)) {
                                        foreach($response["data"] as $key => $client) {
                                            echo '
                                            <tr>
                                                <th scope="row">'.$client["id_cliente"].'</th>
                                                <td><img width="60" src="imagens/'.$client["imagem"].'" class="rounded"></td>
                                                <td>'.$client["nome"].'</td>
                                                <td>'.$client["cpf"].'</td>
                                                <td>'.$client["email"].'</td>
                                                <td>'.$client["whatsapp"].'</td>
                                                <td>
                                                    <a href="./?key='.$client["id_cliente"].'" class="btn btn-warning btn-sm" title="Editar"><i class="bi bi-pencil"></i></a>
                                                    <a href="remover.php?key='.$client["id_cliente"].'" class="btn btn-danger btn-sm" title="Excluir"><i class="bi bi-trash"></i></a>
                                                </td>
                                            </tr>
                                            ';
                                        }
                                    } else {
                                        echo '
                                        <tr>
                                            <td colspan="7" class="text-center">Nenhum cliente cadastrado</td>
                                        </tr>
                                        ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, jQuery, Mask Plugin, Bootstrap Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
    // Modo escuro
    const toggleBtn = document.getElementById('toggleDarkBtn');
    const darkIcon = document.getElementById('darkIcon');
    const darkText = document.getElementById('darkText');
    function setDarkMode(enabled) {
        if (enabled) {
            document.body.classList.add('dark-mode');
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            darkIcon.className = 'bi bi-brightness-high';
            darkText.textContent = 'Modo Claro';
            localStorage.setItem('darkMode', '1');
        } else {
            document.body.classList.remove('dark-mode');
            document.documentElement.setAttribute('data-bs-theme', 'light');
            darkIcon.className = 'bi bi-moon';
            darkText.textContent = 'Modo Escuro';
            localStorage.setItem('darkMode', '0');
        }
    }
    toggleBtn.onclick = function() {
        setDarkMode(!document.body.classList.contains('dark-mode'));
    };
    if(localStorage.getItem('darkMode') === '1') setDarkMode(true);

    // CEP auto-complete
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
                    $("#clientCEP, #clientStreet, #clientNeighborhood, #clientCity, #clientState").val("");
                }
            });
        } else if(cep.length > 0) {
            alert('Formato de CEP inválido.');
            $("#clientCEP, #clientStreet, #clientNeighborhood, #clientCity, #clientState").val("");
        }
    });
    </script>
</body>
</html>