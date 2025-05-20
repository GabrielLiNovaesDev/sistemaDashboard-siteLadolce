<?php

class Contato extends Model
{
    public function getTodosContato()
    {
        $sql = "SELECT * FROM tbl_contato WHERE NOT status_contato = 'DESATIVADO' ORDER BY id_contato DESC";
        $stmt = $this->db->prepare($sql);

        if (!$stmt->execute()) {
            error_log("Erro ao executar consulta de contatos");
            return array(); // Retorna array vazio em caso de erro
        }

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($resultados)) {
            error_log("Consulta retornou 0 resultados");
        }

        return $resultados;
    }

    public function getTotalContatos()
    {
        $sql = "SELECT COUNT(*) as total FROM tbl_contato WHERE status_contato = 'AGUARDANDO'";
        $sql = $this->db->query($sql);
        $row = $sql->fetch();
        return $row['total'];
    }

    public function getDadosContato($id)
    {
        $sql = "SELECT * FROM tbl_contato WHERE id_contato = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $dadosContato = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dadosContato) {
            return null;
        }

        return $dadosContato;
    }

    public function salvarContato($dados)
    {
        try {
            $sql = "INSERT INTO tbl_contato 
                    (nome_contato, telefone_contato, email_contato, assunto_contato, mensagem_contato, datahora_contato, status_contato)
                    VALUES (:nome, :telefone, :email, :assunto, :mensagem, NOW(), 'AGUARDANDO')";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':telefone', $dados['fone']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':assunto', $dados['assunto']);
            $stmt->bindParam(':mensagem', $dados['mensagem']);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            error_log('Erro ao salvar contato: ' . $e->getMessage());
            return false;
        }
    }

    public function atualizarStatusRespondido($idContato)
    {
        $sql = "UPDATE tbl_contato SET status_contato = 'RESPONDIDO' WHERE id_contato = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $idContato, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function desativarContato($id)
    {
        $sql = "UPDATE tbl_contato SET status_contato = 'DESATIVADO' WHERE id_contato = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
