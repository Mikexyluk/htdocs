<?php
include "../verificar-autenticacao.php";
$pagina = "clientes";
?>
<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <style>
        body {
            background: #181a1b;
            color: #f8f9fa;
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
        }
        .card-header {
            background: transparent;
            border-bottom: 1px solid #343a40;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 24px 24px 12px 24px;
        }
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 0;
        }
        .action-btns .btn {
            margin-right: 4px;
        }
        .btn-primary, .btn-success, .btn-danger {
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #343a40;
            background: #23272b;
        }
        .dataTable-table > thead {
            position: sticky;
            top: 0;
            background: #23272b;
            z-index: 2;
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
                <span class="page-title">Clientes Cadastrados</span>
                <div>
                    <a href="/clientes/formulario.php" class="btn btn-primary me-1"><i class="bi bi-plus-circle"></i> Novo</a>
                    <a href="exportar.php" class="btn btn-success btn-sm me-1"><i class="bi bi-file-earmark-excel"></i> Excel</a>
                    <a href="exportar_pdf.php" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i> PDF</a>
                </div>
            </div>
            <div class="card-body">
                <table id="myTable" class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Whatsapp</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $key = null;
                        require("../requests/clientes/get.php");
                        if (!empty($response)) {
                            foreach ($response["data"] as $client) {
                                echo '
                                <tr>
                                    <td>'.$client["id_cliente"].'</td>
                                    <td><img src="/clientes/imagens/'.$client["imagem"].'" class="table-img" alt="Imagem"></td>
                                    <td>'.$client["nome"].'</td>
                                    <td>'.$client["cpf"].'</td>
                                    <td>'.$client["email"].'</td>
                                    <td>'.$client["whatsapp"].'</td>
                                    <td class="action-btns">
                                        <a href="/clientes/formulario.php?key='.$client["id_cliente"].'" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="/clientes/remover.php?key='.$client["id_cliente"].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Tem certeza que deseja excluir este cliente?\')">Excluir</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '<tr><td colspan="7" class="text-center">Nenhum cliente cadastrado</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
    let table = new DataTable('#myTable', {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'
        }
    });
    </script>
</body>

</html>