<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if(!empty($postfields)) {
        $id = $postfields['id_produto'];
        $produto = $postfields['produto'];
        $descricao = $postfields['descricao'];
        $id_marca = $postfields['id_marca'];
        $imagem = $postfields['imagem'] ?? null;
        $quantidade = $postfields['quantidade'] ?? null;
        $preco = $postfields['preco'] ?? null;

        // Verifica campos obrigatórios
        if(empty($id)) {
            http_response_code(400);
            throw new Exception('ID do produto é obrigatório');
        }

        $sql = "
        UPDATE produtos SET 
        produto = :produto,
        descricao = :descricao,
        id_marca = :id_marca,
        imagem = :imagem,
        quantidade = :quantidade,
        preco = :preco
        WHERE id_produto = :id
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':produto', $produto, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':id_marca', $id_marca, PDO::PARAM_INT);
        $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);
        $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        

        $stmt->execute();

        $result = array(
            'status' => 'success',
            'message' => 'Produto alterado com sucesso!'
        );


    } else {
        http_response_code(400);
        // Se não existir dados, retornar erro
        throw new Exception('Nenhum dado foi enviado!');
    }

} catch (Exception $e) {
    // Se houver erro, retorna o erro
    $result = array(
        'status' => 'error',
        'message' => $e->getMessage(),
    );
} finally {
    // Retorna os dados em formato JSON
    echo json_encode($result);
    // Fecha a conexão com o banco de dados
    $conn = null;
}
