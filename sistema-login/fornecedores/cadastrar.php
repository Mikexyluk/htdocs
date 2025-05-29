<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";
 
 
try{
    if(!$_POST){
        throw new Exception("Acesso indevído! Tente novamente.");
    }
 
    // VERIFICAR SE O ARQUIVO FOI ENVIADO

    $msg = '';
    if ($_POST["fornecedorId"] == "") {
        $postifield = array(
           "razao_social" => $_POST["fornecedorrazaoSocial"],
            "cnpj" => $_POST["fornecedorCNPJ"],
            "telefone" => $_POST["fornecedorPhone"],
            "email" => $_POST["fornecedorEmail"],
            "endereco" => array(
             
                "logradouro" => $_POST["fornecedorStreet"],
                "numero" => $_POST["fornecedorNumber"],
                "complemento" => $_POST["fornecedorComplement"],
                "bairro" => $_POST["fornecedorNeighborhood"],
                "cidade" => $_POST["fornecedorCity"],
                "estado" => $_POST["fornecedorState"],
                "cep" => $POST["fornecedorCEP"]
            )
        );
 
    require("../requests/fornecedores/post.php");
       
    } else {
        $postifield = array(
            "id_fornecedor" => $_POST["fornecedorId"],
            "razao_social" => $_POST["fornecedorrazaoSocial"],
            "cnpj" => $_POST["fornecedorCNPJ"],
            "telefone" => $_POST["fornecedorPhone"],
            "email" => $_POST["fornecedorEmail"],
            "endereco" => array(
             
                "logradouro" => $_POST["fornecedorStreet"],
                "numero" => $_POST["fornecedorNumber"],
                "complemento" => $_POST["fornecedorComplement"],
                "bairro" => $_POST["fornecedorNeighborhood"],
                "cidade" => $_POST["fornecedorCity"],
                "estado" => $_POST["fornecedorState"],
                "cep" => $POST["fornecedorCEP"]
            )
        );
 
        require("../requests/fornecedores/put.php");
    }
    $_SESSION["msg"] = $response["message"];
 
}catch(Exception $e){
    $_SESSION["msg"] = $e->getMessage();
}finally{
    header("Location: ./");
}
 