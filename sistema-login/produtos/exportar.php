<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// DEFINE TIMEZONE PARA BRASIL
date_default_timezone_set('America/Sao_Paulo');
$filename = "produtos_".date('YmdHis').".xls";

// CABEÇALHO PARA EXPORTAR O ARQUIVO EM EXCEL
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");

?>
<head>
    <meta charset="utf-8">
</head>
<table>
    <thead>
        <tr>
            <th style="background:gray;font-weight:bold;border:1px solid black" scope="col">#</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">Produto</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:100px" scope="col">Preço</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:250px" scope="col">Descrição</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Marca</th>
        </tr>
    </thead>
    <tbody id="productTableBody">
        <!-- Os clientes serão carregados aqui via PHP -->
        <?php
        // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
        if(!empty($_SESSION["clientes"])) {
            foreach($_SESSION["clientes"] as $key => $produto) {
                echo '
                <tr>
                    <th style="border:1px solid black" scope="row">'.($key + 1).'</th>
                    <td style="border:1px solid black">'.$produto["product"].'</td>
                    <td style="border:1px solid black">'.$produto["productPrice"].'</td>
                    <td style="border:1px solid black">'.$produto["productDescription"].'</td>
                    <td style="border:1px solid black">'.$produto["productmarca"].'</td>
                   
                </tr>
                ';
            }
        } else {
            echo '
            <tr>
                <td colspan="4">Nenhum produto cadastrado</td>
            </tr>
            ';
        }
        ?>
    </tbody>
</table>