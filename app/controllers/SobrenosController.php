<?php


class SobrenosController extends Controller{


    public function index(){
        $dados = array();
        $dados['titulo'] = 'La Dolce Gealto';


        $caminhoView = '../app/views/sobrenos.php';
        realpath($caminhoView);

        $this->carregarViews('sobrenos', $dados);
     
    }
    

}   