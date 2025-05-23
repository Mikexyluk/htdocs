<?php
include "verificar-autenticacao.php";
$pagina = "home";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Clientes</title>
    <!-- Bootstrap Dark Theme -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #181a1b;
            color: #f8f9fa;
        }
        .card {
            background-color: #23272b;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .card-title, .card-footer, .bi {
            color: #f8f9fa;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>

<body>
    <?php
    include "mensagens.php";
    include "navbar.php";
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-people" style="font-size: 2.5rem;"></i>
                        <h5 class="card-title mt-3">Clientes
                            (<?php echo isset($_SESSION["clientes"]) ? count($_SESSION["clientes"]) : 0;?>)
                        </h5>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo $_SESSION["url"];?>/clientes" class="btn btn-primary w-100">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>