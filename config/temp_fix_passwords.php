<?php
require 'config.php';

try {
    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    
    echo "<h2>Corrigindo senhas no banco de dados</h2>";
    
    // 1. Listar usuários
    $stmt = $db->query("SELECT id_funcionario, senha_funcionario FROM tbl_funcionario");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<p>Encontrados " . count($users) . " usuários</p>";
    
    foreach ($users as $user) {
        echo "<hr><p>Processando usuário ID: " . $user['id_funcionario'] . "</p>";
        
        // 2. Verificar se a senha já está hasheada
        if (password_needs_rehash($user['senha_funcionario'], PASSWORD_DEFAULT)) {
            $newHash = password_hash($user['senha_funcionario'], PASSWORD_DEFAULT);
            
            echo "<p>Senha precisa ser rehasheada</p>";
            echo "<p>Hash antigo: " . substr($user['senha_funcionario'], 0, 20) . "...</p>";
            
            // 3. Atualizar no banco
            $update = $db->prepare("UPDATE tbl_funcionario SET senha_funcionario = ? WHERE id_funcionario = ?");
            $update->execute([$newHash, $user['id_funcionario']]);
            
            echo "<p style='color:green;'>✅ Senha atualizada com sucesso!</p>";
            echo "<p>Novo hash: " . substr($newHash, 0, 20) . "...</p>";
        } else {
            echo "<p style='color:blue;'>ℹ️ Senha já está no formato correto</p>";
        }
    }
    
    echo "<h3 style='color:green;'>Processo concluído com sucesso!</h3>";
} catch (PDOException $e) {
    echo "<h3 style='color:red;'>Erro durante o processo:</h3>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<pre>" . print_r($db->errorInfo(), true) . "</pre>";
}