<?php

class Funcionario extends Model
{
    public function getTodosFuncionarios()
    {
        $sql = "SELECT f.*, e.nome_especialidade 
                FROM tbl_funcionario f
                LEFT JOIN tbl_especialidade e ON f.id_especialidade = e.id_especialidade
                WHERE f.status_funcionario = 'ATIVO' 
                ORDER BY f.id_funcionario DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getDadosFuncionario($id)
    {
        $sql = "SELECT f.*, e.nome_especialidade 
                FROM tbl_funcionario f
                LEFT JOIN tbl_especialidade e ON f.id_especialidade = e.id_especialidade
                WHERE f.id_funcionario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $dadosFuncionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dadosFuncionario) {
            return null;
        }

        return $dadosFuncionario;
    }

    public function addFuncionario($dados)
    {
        $sql = "INSERT INTO tbl_funcionario 
                (nome_funcionario, cpf_funcionario, endereco_funcionario, bairro_funcionario, 
                 cidade_funcionario, estado_funcionario, telefone_funcionario, email_funcionario, 
                 senha_funcionario, data_cad_funcionario, status_funcionario, id_especialidade)
                VALUES 
                (:nome_funcionario, :cpf_funcionario, :endereco_funcionario, :bairro_funcionario, 
                 :cidade_funcionario, :estado_funcionario, :telefone_funcionario, :email_funcionario, 
                 :senha_funcionario, :data_cad_funcionario, :status_funcionario, :id_especialidade)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_funcionario', $dados['nome_funcionario']);
        $stmt->bindValue(':cpf_funcionario', $dados['cpf_funcionario']);
        $stmt->bindValue(':endereco_funcionario', $dados['endereco_funcionario']);
        $stmt->bindValue(':bairro_funcionario', $dados['bairro_funcionario']);
        $stmt->bindValue(':cidade_funcionario', $dados['cidade_funcionario']);
        $stmt->bindValue(':estado_funcionario', $dados['estado_funcionario']);
        $stmt->bindValue(':telefone_funcionario', $dados['telefone_funcionario']);
        $stmt->bindValue(':email_funcionario', $dados['email_funcionario']);
        $stmt->bindValue(':senha_funcionario', $dados['senha_funcionario']); // deve estar já com hash
        $stmt->bindValue(':data_cad_funcionario', date('Y-m-d H:i:s'));
        $stmt->bindValue(':status_funcionario', $dados['status_funcionario']);
        $stmt->bindValue(':id_especialidade', $dados['id_especialidade'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function editarFuncionario($dados)
    {
        $sql = "UPDATE tbl_funcionario SET
                nome_funcionario = :nome_funcionario,
                cpf_funcionario = :cpf_funcionario,
                endereco_funcionario = :endereco_funcionario,
                bairro_funcionario = :bairro_funcionario,
                cidade_funcionario = :cidade_funcionario,
                estado_funcionario = :estado_funcionario,
                telefone_funcionario = :telefone_funcionario,
                email_funcionario = :email_funcionario,
                senha_funcionario = :senha_funcionario,
                status_funcionario = :status_funcionario,
                id_especialidade = :id_especialidade
                WHERE id_funcionario = :id_funcionario";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id_funcionario', $dados['id_funcionario'], PDO::PARAM_INT);
        $stmt->bindValue(':nome_funcionario', $dados['nome_funcionario']);
        $stmt->bindValue(':cpf_funcionario', $dados['cpf_funcionario']);
        $stmt->bindValue(':endereco_funcionario', $dados['endereco_funcionario']);
        $stmt->bindValue(':bairro_funcionario', $dados['bairro_funcionario']);
        $stmt->bindValue(':cidade_funcionario', $dados['cidade_funcionario']);
        $stmt->bindValue(':estado_funcionario', $dados['estado_funcionario']);
        $stmt->bindValue(':telefone_funcionario', $dados['telefone_funcionario']);
        $stmt->bindValue(':email_funcionario', $dados['email_funcionario']);
        $stmt->bindValue(':senha_funcionario', $dados['senha_funcionario']);
        $stmt->bindValue(':status_funcionario', $dados['status_funcionario']);
        $stmt->bindValue(':id_especialidade', $dados['id_especialidade'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function desativarFuncionario($id)
    {
        $sql = "UPDATE tbl_funcionario SET status_funcionario = 'DESATIVADO' 
                WHERE id_funcionario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Método para obter todas as especialidades ativas
    public function getEspecialidadesAtivas()
    {
        $sql = "SELECT * FROM tbl_especialidade 
                WHERE status_especialidade = 'ATIVO' 
                ORDER BY nome_especialidade";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}