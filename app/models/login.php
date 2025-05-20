<?php
class Login extends Model {
    public function verificarFunc($email, $senha) {
        // Primeiro busca o usuário pelo email
        $sql = "SELECT * FROM tbl_funcionario
                WHERE email_funcionario = :email 
                AND status_funcionario = 'ATIVO'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // DEBUG - REMOVA DEPOIS
        echo "<pre>";
        echo "Usuário encontrado:\n";
        print_r($funcionario);
        echo "Senha fornecida: $senha\n";
        if ($funcionario) {
            echo "Hash no banco: " . $funcionario['senha_funcionario'] . "\n";
            echo "Resultado da verificação: " . (password_verify($senha, $funcionario['senha_funcionario']) ? 'true' : 'false') . "\n";
        }
        echo "</pre>";
        // FIM DEBUG
    
        if ($funcionario && password_verify($senha, $funcionario['senha_funcionario'])) {
            return $funcionario;
        }
    
        return false;
    }
}