<?php

class Galeria extends Model
{

    // Listar galeria de forma RAND()
    public function getGaleriaRand($limite = 100)
    {
        $sql = "SELECT * FROM (SELECT * FROM tbl_sabores WHERE status_sabores = 'ATIVO' ORDER BY RAND() LIMIT :limite) AS sub ORDER BY nome_sabores";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTodaGaleria()
    {
        $sql = "SELECT * FROM tbl_sabores WHERE status_sabores = 'ATIVO' ORDER BY nome_sabores";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDadosGaleria($id)
    {
        $sql = "SELECT * FROM tbl_sabores WHERE id_sabores = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $dadosGaleria = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dadosGaleria) {
            // Caso não seja encontrado
            return null;
        }

        return $dadosGaleria;
    }

    public function addSabores($dados)
    {
        $sql = "INSERT INTO tbl_sabores
                (nome_sabores, imagem_sabores, alt_sabores, status_sabores)
                VALUES
                (:nome_sabores, :imagem_sabores, :alt_sabores, :status_sabores)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_sabores', $dados['nome_sabores']);
        $stmt->bindValue(':imagem_sabores', $dados['imagem_sabores']);
        $stmt->bindValue(':alt_sabores', $dados['alt_sabores']);
        $stmt->bindValue(':status_sabores', $dados['status_sabores']);

        return $stmt->execute();
    }


    public function editarSabores($dados)
    {

        $updateImagem = isset($dados['imagem_sabores']) && !empty($dados['imagem_sabores']);

        $sql = "UPDATE tbl_sabores SET
                nome_sabores = :nome_sabores,
                alt_sabores = :alt_sabores,
                status_sabores = :status_sabores" .
            ($updateImagem ? ", imagem_sabores = :imagem_sabores" : "") . "
                WHERE id_sabores = :id_sabores";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id_sabores', $dados['id_sabores'], PDO::PARAM_INT);
        $stmt->bindValue(':nome_sabores', $dados['nome_sabores']);
        $stmt->bindValue(':alt_sabores', $dados['alt_sabores']);
        $stmt->bindValue(':status_sabores', $dados['status_sabores']);


        if ($updateImagem) {
            $stmt->bindValue(':imagem_sabores', $dados['imagem_sabores']);
        }

        return $stmt->execute();
    }

    public function desativarSabor($id)
    {
        $sql = "UPDATE tbl_sabores SET status_sabores = 'DESATIVADO' WHERE id_sabores = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getUltimoSabor()
    {
        $sql = "SELECT * FROM tbl_sabores
            WHERE status_sabores = 'ATIVO'
            ORDER BY id_sabores DESC
            LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
