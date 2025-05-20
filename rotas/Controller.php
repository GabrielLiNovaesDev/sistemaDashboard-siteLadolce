<?php


class Controller {
    public function carregarViews($viewName, $dados = array()) {
        $viewFile = VIEWS_PATH . $viewName . '.php';
        
        if (!file_exists($viewFile)) {
            throw new RuntimeException("View não encontrada: {$viewFile}");
        }
        
        extract($dados, EXTR_SKIP);  // EXTR_SKIP evita sobrescrita acidental
        require $viewFile;
    }
}