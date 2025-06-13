<?php
include "../verificar-autenticacao.php";

$pagina = "produtos";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/produtos/get.php");
    $key = null;
    if (isset($response["data"]) && !empty($response["data"])) {
        $produto = $response["data"][0];
    } else {
        $produto = null;
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
    }
    @media (max-width: 575.98px) {
        .form-title {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 0.5rem;
        }
        .img-preview {
            margin-left: 0 !important;
        }
    }
    </style>
</head>
<body>
     <?php include "../mensagens.php"; include "../navbar.php"; ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">
                <div class="card p-4">
                    <div class="form-title mb-4 d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2">
                        <h2 class="mb-0">Cadastro de Produto</h2>
                        <a href="/produtos/formulario.php" class="btn btn-primary btn-sm">Novo Produto</a>
                    </div>
                    <form id="productForm" action="/produtos/cadastrar.php" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <label for="productId" class="form-label">Código do Produto</label>
                                <input type="text" class="form-control" id="productId" name="productId" readonly value="<?php echo isset($produto) ? $produto["id_produto"] : ""; ?>">
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="produto" class="form-label">Produto</label>
                                <input type="text" class="form-control" id="produto" name="produto" required value="<?php echo isset($produto) ? $produto["produto"] : ""; ?>">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="productmarca" class="form-label">Marca</label>
                                <?php
                                require("../requests/marcas/get.php");
                                echo '<select class="form-select" id="productmarca" name="productmarca" required>';
                                echo '<option value="">Selecione a marca</option>';
                                if (!empty($response["data"])) {
                                    foreach ($response["data"] as $marca) {
                                        $selected = (isset($produto) && $produto["id_marca"] == $marca["id_marca"]) ? "selected" : "";
                                        echo '<option value="' . htmlspecialchars($marca["id_marca"]) . '" ' . $selected . '>' . htmlspecialchars($marca["marca"]) . '</option>';
                                    }
                                }
                                echo '</select>';
                                ?>
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="productPrice" class="form-label">Preço</label>
                                <input type="text" class="form-control" id="productPrice" name="productPrice" required value="<?php echo isset($produto) ? $produto["preco"] : ""; ?>">
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="quantidadeProduto" class="form-label">Quantidade</label>
                                <input type="number" class="form-control" id="quantidadeProduto" name="quantidadeProduto" required value="<?php echo isset($produto) ? $produto["quantidade"] : ""; ?>">
                            </div>
                            <div class="col-12">
                                <label for="productDescription" class="form-label">Descrição</label>
                                <textarea class="form-control" id="productDescription" name="productDescription" rows="3"><?php echo isset($produto) ? $produto["descricao"] : ""; ?></textarea>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="productImage" class="form-label">Imagem</label>
                                <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" onchange="previewImage(event)">
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-end">
                                <?php
                                if (isset($produto["imagem"]) && $produto["imagem"]) {
                                    echo '
                                    <input type="hidden" name="currentProductImage" value="' . htmlspecialchars($produto["imagem"]) . '">
                                    <img id="imgPreview" class="img-preview" src="imagens/' . htmlspecialchars($produto["imagem"]) . '" alt="Imagem do produto">';
                                } else {
                                    echo '<img id="imgPreview" class="img-preview" style="display:none;" alt="Preview da imagem">';
                                }
                                ?>
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
    // Preview da imagem selecionada
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imgPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
</body>
</html>
