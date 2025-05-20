<?php

class Banner extends Model {
    // Listar 3 banner de forma RAND()
    public function getBannerRand($limite = 3) {
        $sql = "SELECT * FROM (SELECT * FROM tbl_banner WHERE status_banner = 'ATIVO' ORDER BY RAND() LIMIT :limite) AS sub ORDER BY nome_banner";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Todos os getTodosBanner
    public function getTodosBanner() {
        $sql = "SELECT * FROM tbl_banner WHERE status_banner = 'ATIVO' order by nome_banner;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Pega dados do serviço pelo ID
    public function getDadosBanner($id) {
        $sql = "SELECT * FROM tbl_banner WHERE id_banner = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $dadosBanner = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$dadosBanner) {
            // Caso o serviço não seja encontrado
            return null;
        }

        return $dadosBanner;
    }
}
