<?php
try {

    // Verifica se há um ID na URL para consulta específica
    if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = $_GET["id"];

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM marcas
            WHERE id_marca = :id

        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
        // Vincular o parâmetro :id com o valor da variável $id
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    }
    // Verifica se há um NOME na URL para consulta
    elseif (isset($_GET["marca"]) && is_string($_GET["marca"])) {
        $nome = $_GET["marca"];

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM marcas
            WHERE marca LIKE :marca
            ORDER BY marca
        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
        // Vincular o parâmetro :nome com o valor da variável $nome
        $stmt->bindValue(':marca', '%' . $marcas . '%', PDO::PARAM_STR);

    }
    else {
        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT *
            FROM marcas
            ORDER BY marca
        ";
       
        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
    }
 
    // Executar a sintaxe SQL
    $stmt->execute();
    // Obter os dados do banco de dados como objeto
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
 
    if (empty($data)) {
        // Se não houver dados, retorna um status 204 (No Content)
        http_response_code(204);
        exit;
    } else {
        // Se houver dados, retorna os dados encontrados
        $result = array(
            'status' => 'success',
            'message' => 'Marca encontradas.',
            'data' => $data
        );
    }
 
} catch (Exception $e) {
    // Se houver erro, retorna o erro
    $result = array(
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    );
} finally {
    // Retorna os dados em formato JSON
    echo json_encode($result);
    // Fecha a conexão com o banco de dados
    $conn = null;
}
exit;