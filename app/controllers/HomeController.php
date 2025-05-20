<?php


class HomeController extends Controller
{


    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'La Dolce Gealto';


        $caminhoView = '../app/views/home.php';
        realpath($caminhoView);

        // Obter os serviços de forma RAND()
        $galeriaModel = new Galeria();
        $randGaleria = $galeriaModel->getGaleriaRand();

        if (!$randGaleria) {
            // Tratar erro se nenhum serviço for retornado
            $dados['randGaleria'] = [];
        } else {
            $dados['randGaleria'] = $randGaleria;
        }

        $this->carregarViews('home', $dados);
    }
}
