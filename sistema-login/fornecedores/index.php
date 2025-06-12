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
    <title>Fornecedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <style>
    body {
        background: #181a1b;
        color: #f8f9fa !important;
        min-height: 100vh;
    }

    .main-container {
        max-width: 1000px;
        margin: 48px auto 0 auto;
    }

    .card {
        background: #23272b;
        border-radius: 12px;
        box-shadow: 0 2px 16px #00000030;
        color: #f8f9fa !important;
    }

    .card-header {
        background: transparent;
        border-bottom: 1px solid #343a40;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        padding: 24px 24px 12px 24px;
        color: #f8f9fa !important;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 0;
        color: #fff !important;
    }

    .action-btns .btn {
        margin-right: 4px;
    }

    .btn-primary,
    .btn-success,
    .btn-danger,
    .btn-warning {
        font-weight: 600;
        letter-spacing: 0.5px;
        color: #fff !important;
    }

    .table th,
    .table td {
        vertical-align: middle;
        color: #f8f9fa !important;
        background: #23272b !important;
    }

    .table-dark {
        --bs-table-bg: #23272b;
        --bs-table-striped-bg: #23272b;
        --bs-table-hover-bg: #343a40;
        color: #f8f9fa !important;
    }

    .table-img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #343a40;
        background: #23272b;
    }

    .dataTable-table>thead {
        position: sticky;
        top: 0;
        background: #23272b;
        z-index: 2;
        color: #fff !important;
    }

    .dataTable-table th {
        color: #fff !important;
    }

    @media (max-width: 900px) {
        .main-container {
            padding: 8px;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            padding: 16px 8px 8px 8px;
        }

        .page-title {
            font-size: 1.2rem;
        }
    }
    </style>
</head>

<body>
    <?php include "../mensagens.php"; include "../navbar.php"; ?>
    <div class="main-container">
        <div class="card">
            <div class="card-header">
                <span class="page-title">Fornecedores Cadastrados</span>
                <div>
                    <a href="/fornecedores/formulario.php" class="btn btn-primary me-1"><i
                            class="bi bi-plus-circle"></i> Novo</a>
                    <a href="exportar.php" class="btn btn-success btn-sm me-1"><i class="bi bi-file-earmark-excel"></i>
                        Excel</a>
                    <a href="exportar_pdf.php" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i>
                        PDF</a>
                </div>
            </div>
            <div class="card-body">
                <table id="myTable" class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Razão Social</th>
                            <th scope="col">CNPJ</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="fornecedorTableBody">
                        <?php
                        $key = null;
                        require("../requests/fornecedores/get.php");
                        if(!empty($response)) {
                            foreach($response["data"] as $key => $fornecedor) {
                                echo '
                                <tr>
                                <th scope="row">' . $fornecedor["id_fornecedor"] . '</th>
                                <td>' . $fornecedor["razao_social"] . '</td>
                                <td>' . $fornecedor["cnpj"] . '</td>
                                <td>' . $fornecedor["telefone"] . '</td>
                                <td>' . $fornecedor["email"] . '</td>
                                <td>
                                 <a href="/fornecedores/formulario.php?key='.$fornecedor["id_fornecedor"].'" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="/fornecedores/remover.php?key='.$fornecedor["id_fornecedor"].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Tem certeza que deseja excluir este fornecedor?\')">Excluir</a>
                                </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                            <td colspan="7">Nenhum fornecedor cadastrado</td>
                            </tr>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
    let table = new DataTable('#myTable', {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'
        }
    });
    </script>
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