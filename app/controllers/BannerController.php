<?php

class BannerController extends Controller
{


    private $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new Banner();
    }

    // #######################################
    // FRONT-END DASHBOARD Banner
    // #######################################


    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Banner - Site Mestre Motores';

        // Obter os serviços de forma RAND()

        $todosBanner = $this->bannerModel->getTodosBanner();
        $dados['todosBanner'] = $todosBanner;

        $this->carregarViews('banner', $dados);
    }




    // #######################################
    // BACK-END DASHBOARD Banner
    // #######################################

    // 1- Método para listar todos os Banner ativos

    public function listar()
    {
        $this->verificarAutenticacao();

        $dados = array();
        $dados['conteudo'] = 'admin/banner/listar'; // Página que será carregada, talvez colocar o "B" no lugar de "b"

        $dados['banner'] = $this->bannerModel->getTodosBanner();
        //var_dump($dados);

        $this->carregarViews('admin/index', $dados);
    }


    private function verificarAutenticacao()
    {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'funcionario') {
            $_SESSION['acesso_negado'] = 'Você precisa fazer login para acessar esta área';
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    
    }

    // Fim da Class
}