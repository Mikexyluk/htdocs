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
</head>
<body>
    <?php include "../mensagens.php"; include "../navbar.php"; ?>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <h2>
                    Cadastrar Fornecedor
                    <a href="./" class="btn btn-primary btn-sm">Novo Fornecedor</a>
                </h2>
                <form id="fornecedorForm" action="/fornecedores/cadastrar.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fornecedorId" class="form-label">Código do Fornecedor</label>
                        <input type="text" class="form-control" id="fornecedorId" name="fornecedorId" readonly value="<?php echo isset($fornecedor) ? $fornecedor["id_fornecedor"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorName" class="form-label">Nome do Fornecedor</label>
                        <input onblur="teste()" type="text" class="form-control" id="fornecedorName" name="fornecedorName" required value="<?php echo isset($fornecedor) ? $fornecedor["nome"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorCPF" class="form-label">CPF</label>
                        <input data-mask="000.000.000-00" type="text" class="form-control" id="fornecedorCPF" name="fornecedorCPF" required value="<?php echo isset($fornecedor) ? $fornecedor["cpf"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorEmail" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="fornecedorEmail" name="fornecedorEmail" required value="<?php echo isset($fornecedor) ? $fornecedor["email"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorPhone" class="form-label">Telefone</label>
                        <input data-mask="(00) 0 0000-0000" type="text" class="form-control" id="fornecedorPhone" name="fornecedorPhone" required value="<?php echo isset($fornecedor) ? $fornecedor["whatsapp"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorImage" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="fornecedorImage" name="fornecedorImage" accept="image/*" value="<?php echo isset($fornecedor) ? $fornecedor["imagem"] : ""; ?>">
                    </div>
                    <?php
                    if (isset($fornecedor["imagem"])) {
                        echo '
                        <div class="mb-3">
                            <input type="hidden" name="currentFornecedorImage" value="' . $fornecedor["imagem"] . '">
                            <img width="100" src="imagens/' . $fornecedor["imagem"] . '">
                        </div>
                        ';
                    }
                    ?>
                    <div class="mb-3">
                        <label for="fornecedorCEP" class="form-label">CEP</label>
                        <input data-mask="00000-000" type="text" class="form-control" id="fornecedorCEP" name="fornecedorCEP" required value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["cep"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorStreet" class="form-label">Logradouro</label>
                        <input type="text" class="form-control" id="fornecedorStreet" name="fornecedorStreet" required value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["logradouro"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorNumber" class="form-label">Número</label>
                        <input type="text" class="form-control" id="fornecedorNumber" name="fornecedorNumber" required value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["numero"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorComplement" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="fornecedorComplement" name="fornecedorComplement" value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["complemento"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorNeighborhood" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="fornecedorNeighborhood" name="fornecedorNeighborhood" required value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["bairro"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorCity" class="form-label">Cidade</label>
                        <input type="text" readonly maxlength="2" class="form-control" id="fornecedorCity" name="fornecedorCity" required value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["cidade"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorState" class="form-label">Estado</label>
                        <input type="text" readonly class="form-control" id="fornecedorState" name="fornecedorState" required value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["estado"] : ""; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>
                    Fornecedores Cadastrados
                    <a href="exportar.php" class="btn btn-success btn-sm float-left">Excel</a>
                    <a href="exportar_pdf.php" class="btn btn-danger btn-sm float-left">PDF</a>
                </h2>
                <table class="table table-striped">
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
                                <
tr>
                                    <th scope="row">' . $fornecedor["id_fornecedor"] . '</th>
                                    <td>' . $fornecedor["razao_social"] . '</td>
                                    <td>' . $fornecedor["cnpj"] . '</td>
                                    <td>' . $fornecedor["telefone"] . '</td>
                                    <td>' . $fornecedor["email"] . '</td>
                                    <td>
                                        <a href="?key=' . $fornecedor["id_fornecedor"] . '" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="excluir.php?key=' . $fornecedor["id_fornecedor"] . '" class="btn btn-danger btn-sm">Excluir</a>
                                    </td>
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
