<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if(!empty($postfields)) {
        $marca = $postfields['marca'] ?? null;
        

        // Verifica campos obrigatórios
        if (empty($marca)) {
            http_response_code(400);
            throw new Exception('Campo marca não preenchido');
        }

        $sql = "
        INSERT INTO marcas (marca)
        VALUES
        (:marca)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
        $stmt->execute();

        $result = array(
            'status' => 'success',
            'message' => 'Marca cadastrada com sucesso!'
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
