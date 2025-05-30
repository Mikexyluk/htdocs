<?php
include "../verificar-autenticacao.php";

$pagina = "produtos";

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
    <title>Dashboard - Cadastro de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "../mensagens.php"; include "../navbar.php"; ?>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <h2>
                    Cadastrar Produto
                    <a href="./" class="btn btn-primary btn-sm">Novo Produto</a>
                </h2>
                <form id="productForm" action="/produtos/cadastrar.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productId" class="form-label">Código do Produto</label>
                        <input type="text" class="form-control" id="productId" name="productId" readonly value="<?php echo isset($produto) ? $produto["id_produto"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="product" class="form-label">Produto</label>
                        <input onblur="teste()" type="text" class="form-control" id="product" name="product" required value="<?php echo isset($produto) ? $produto["produtos"] : ""; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Preço</label>
                        <input data-mask="000.00" type="text" class="form-control" id="productPrice" name="productPrice" required value="<?php echo isset($produto) ? $produto["preco"] : ""; ?>">
                    </div>

                    

                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Descrição</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" rows="3"><?php echo isset($produto) ? $produto["descricao"] : ""; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="productBrand" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="productBrand" name="productBrand" required value="<?php echo isset($produto) ? $produto["marca"] : ""; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" value="<?php echo isset($client) ? $produto["imagem"] : ""; ?>">
                    </div>
                    <?php
                    if (isset($client["imagem"])) {
                        echo '
                        <div class="mb-3">
                            <input type="hidden" name="currentProductImage" value="' . $client["imagem"] . '">
                            <img width="100" src="imagens/' . $client["imagem"] . '">
                        </div>
                        ';
                    }
                    ?>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>
                    Produtos Cadastrados
                    <a href="exportar.php" class="btn btn-success btn-sm float-left">Excel</a>
                    <a href="exportar_pdf.php" class="btn btn-danger btn-sm float-left">PDF</a>
                </h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php
                        $key = null;
                        require("../requests/produtos/get.php");
                        if(!empty($response)) {
                            foreach($response["data"] as $key => $produto) {
                                echo '
                                <tr>
                                    <th scope="row">' . $produto["id_produto"] . '</th>
                                    <td>' . $produto["product"] . '</td>
                                    <td><img width="50" src="imagens/'.$produto["imagem"].'"></td>
                                    <td>' . $produto["preco"] . '</td>
                                    <td>' . $produto["descricao"] . '</td>
                                    <td>' . $produto["marca"] . '</td>
                                    <td>
                                        <a href="?key=' . $produto["id_produto"] . '" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="/produtos/remover.php?key='.$produto["id_produto"].'" class="btn btn-danger btn-sm">Excluir</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="7">Nenhum produto cadastrado</td>
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
    <!-- <script>
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
        } else {
            alert('Formato de CEP inválido.');
            $("#clientCEP").val("");
            $("#clientStreet").val("");
            $("#clientNeighborhood").val("");
            $("#clientCity").val("");
            $("#clientState").val("");
        }
    });
    </script> -->
</body>
</html>
