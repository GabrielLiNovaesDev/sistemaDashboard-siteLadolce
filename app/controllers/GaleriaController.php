<?php

class GaleriaController extends Controller
{
    private $galeriaModel;

    public function __construct()
    {
        $this->galeriaModel = new Galeria();
    }

    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'La Dolce Gealto';

        $todaGaleria = $this->galeriaModel->getTodaGaleria();
        $dados['todaGaleria'] = $todaGaleria;

        $this->carregarViews('galeria', $dados);
    }

    public function listar()
    {
        $this->verificarAutenticacao();

        $dados = array();
        $dados['conteudo'] = 'admin/galeria/listar';
        $dados['galeria'] = $this->galeriaModel->getTodaGaleria();
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


    public function adicionar()
    {
        $this->verificarAutenticacao();

        $dados = array();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitização dos dados recebidos via POST
            $nome_sabores = filter_input(INPUT_POST, 'nome_sabores', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_sabores = filter_input(INPUT_POST, 'status_sabores', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_sabores = $nome_sabores;

            if ($nome_sabores && $status_sabores) {

                $arquivo = null;

                if (isset($_FILES['imagem_sabores']) && $_FILES['imagem_sabores']['error'] == 0) {
                    // Garante que o caminho salvo no banco será relativo
                    $arquivo = 'galeria/' . $this->uploadFoto($_FILES['imagem_sabores'], $nome_sabores);
                }

                $dadosGaleria = array(
                    'nome_sabores'      => $nome_sabores,
                    'imagem_sabores'    => $arquivo,
                    'alt_sabores'       => $alt_sabores,
                    'status_sabores'    => $status_sabores,
                );

                $idGaleria = $this->galeriaModel->addSabores($dadosGaleria);

                if ($idGaleria) {
                    $_SESSION['mensagem'] = 'Sabor adicionado com sucesso';
                    $_SESSION['tipo-msg'] = 'Sucesso';
                    header('Location: ' . BASE_URL . 'galeria/listar');
                    exit;
                } else {
                    $dados['mensagem'] = 'Erro ao adicionar o sabor - Ao enviar para base de dados';
                    $dados['tipo-msg'] = 'Erro';
                }
            } else {
                $dados['mensagem'] = 'Erro ao adicionar o sabor - Campos obrigatórios não preenchidos';
                $dados['tipo-msg'] = 'Erro';
            }
        }

        $dados['conteudo'] = 'admin/galeria/adicionar';
        $this->carregarViews('admin/index', $dados);
    }

    public function editar($id = null)
    {

        $this->verificarAutenticacao();

        $dados = array();

        // Primeiro obtém os dados existentes para preencher o formulário
        $dadosGaleria = $this->galeriaModel->getDadosGaleria($id);

        if (!$dadosGaleria) {
            header('Location: ' . BASE_URL . 'galeria/listar');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome_sabores = filter_input(INPUT_POST, 'nome_sabores', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_sabores = filter_input(INPUT_POST, 'status_sabores', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_sabores = $nome_sabores;

            if ($nome_sabores && $status_sabores) {

                $arquivo = null;

                if (isset($_FILES['imagem_sabores']) && $_FILES['imagem_sabores']['error'] == 0) {
                    // Garante que o caminho salvo no banco será relativo
                    $arquivo = 'galeria/' . $this->uploadFoto($_FILES['imagem_sabores'], $nome_sabores);
                }

                $dadosGaleria = array(
                    'id_sabores'        => $id,
                    'nome_sabores'      => $nome_sabores,
                    'imagem_sabores'    => $arquivo,
                    'alt_sabores'       => $alt_sabores,
                    'status_sabores'    => $status_sabores,
                );

                $idGaleria = $this->galeriaModel->editarSabores($dadosGaleria);

                if ($idGaleria) {
                    $_SESSION['mensagem'] = 'Sabor editado com sucesso';
                    $_SESSION['tipo-msg'] = 'Sucesso';
                    header('Location: ' . BASE_URL . 'galeria/listar');
                    exit;
                } else {
                    $dados['mensagem'] = 'Erro ao editar o sabor - Ao enviar para base de dados';
                    $dados['tipo-msg'] = 'Erro';
                }
            } else {
                $dados['mensagem'] = 'Erro ao editar o sabor - Campos obrigatórios não preenchidos';
                $dados['tipo-msg'] = 'Erro';
            }
        }


        $dados['dadosGaleria'] = $dadosGaleria;
        $dados['conteudo'] = 'admin/galeria/editar';

        $this->carregarViews('admin/index', $dados);
    }

    public function desativar($id = null)
    {
        header('Content-Type: application/json');

        if ($id === null) {
            http_response_code(400);
            echo json_encode(['sucesso' => false, 'mensagem' => 'ID inválido']);
            exit;
        }


        $idGaleria = $this->galeriaModel->desativarSabor($id);

        if ($idGaleria) {
            $_SESSION['mensagem'] = 'Sabor desativado com sucesso';
            $_SESSION['tipo-msg'] = 'sucesso';

            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao desativar o sabor']);
        }
    }



    private function uploadFoto($file, $nome)
    {
        $diretorio = $_SERVER['DOCUMENT_ROOT'] . '/sistema-ladolce/public/uploads/galeria/';

        // Cria o diretório se não existir
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        // Gera um nome único para o arquivo
        $extensao = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nomeArquivo = md5(uniqid()) . '_' . preg_replace('/[^A-Za-z0-9\-]/', '', $nome) . '.' . $extensao;

        $caminhoCompleto = $diretorio . $nomeArquivo;

        if (move_uploaded_file($file['tmp_name'], $caminhoCompleto)) {
            return $nomeArquivo; // Retorna apenas o nome do arquivo
        }

        return null;
    }
}
