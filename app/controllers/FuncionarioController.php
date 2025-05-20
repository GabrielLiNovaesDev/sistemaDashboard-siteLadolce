<?php

class FuncionarioController extends Controller
{
    private $funcionarioModel;

    public function __construct()
    {
        $this->funcionarioModel = new Funcionario();
    }

    public function listar()
    {
        $this->verificarAutenticacao();

        $dados = array();

        $dados['conteudo'] = 'admin/funcionario/listar';
        $dados['funcionarios'] = $this->funcionarioModel->getTodosFuncionarios(); // Corrigido o nome do método
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
        $dados['especialidades'] = $this->funcionarioModel->getEspecialidadesAtivas(); // Adicionado para o select de especialidades

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitização dos dados recebidos via POST
            $nome_funcionario      = filter_input(INPUT_POST, 'nome_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf_funcionario       = filter_input(INPUT_POST, 'cpf_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco_funcionario  = filter_input(INPUT_POST, 'endereco_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_funcionario    = filter_input(INPUT_POST, 'bairro_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $cidade_funcionario    = filter_input(INPUT_POST, 'cidade_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_funcionario    = filter_input(INPUT_POST, 'estado_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone_funcionario  = filter_input(INPUT_POST, 'telefone_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_funcionario     = filter_input(INPUT_POST, 'email_funcionario', FILTER_SANITIZE_EMAIL);
            $senha_funcionario     = filter_input(INPUT_POST, 'senha_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_funcionario    = filter_input(INPUT_POST, 'status_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_especialidade     = filter_input(INPUT_POST, 'id_especialidade', FILTER_SANITIZE_NUMBER_INT);

            // Verifica se os campos obrigatórios foram preenchidos
            if (
                $nome_funcionario && $cpf_funcionario && $email_funcionario &&
                $senha_funcionario && $status_funcionario
            ) {
                $data_cad_funcionario = date('Y-m-d H:i:s');
                
                // Aplicar hash na senha antes de armazenar
                $senha_hash = password_hash($senha_funcionario, PASSWORD_DEFAULT);

                $dadosFuncionario = array(
                    'nome_funcionario'      => $nome_funcionario,
                    'cpf_funcionario'       => $cpf_funcionario,
                    'endereco_funcionario'  => $endereco_funcionario,
                    'bairro_funcionario'    => $bairro_funcionario,
                    'cidade_funcionario'    => $cidade_funcionario,
                    'estado_funcionario'    => $estado_funcionario,
                    'telefone_funcionario'  => $telefone_funcionario,
                    'email_funcionario'     => $email_funcionario,
                    'senha_funcionario'     => $senha_hash, // Usando a senha com hash
                    'data_cad_funcionario'  => $data_cad_funcionario,
                    'status_funcionario'    => $status_funcionario,
                    'id_especialidade'      => $id_especialidade ?: null // Permitindo valor nulo
                );

                // Inserir no banco de dados
                $sucesso = $this->funcionarioModel->addFuncionario($dadosFuncionario);

                if ($sucesso) {
                    $_SESSION['mensagem'] = 'Funcionário cadastrado com sucesso!';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: ' . BASE_URL . 'funcionario/listar');
                    exit;
                } else {
                    $dados['mensagem'] = 'Erro ao cadastrar o funcionário.';
                    $dados['tipo-msg'] = 'erro';
                }
            } else {
                $dados['mensagem'] = 'Por favor, preencha todos os campos obrigatórios.';
                $dados['tipo-msg'] = 'erro';
            }
        }

        $dados['conteudo'] = 'admin/funcionario/adicionar';
        $this->carregarViews('admin/index', $dados);
    }

    public function editar($id = null)
    {
        $this->verificarAutenticacao();

        if ($id === null) {
            header('Location: ' . BASE_URL . 'funcionario/listar');
            exit;
        }

        $dados = array();
        $dados['especialidades'] = $this->funcionarioModel->getEspecialidadesAtivas(); // Adicionado para o select de especialidades

        $dadosFuncionario = $this->funcionarioModel->getDadosFuncionario($id);

        if (!$dadosFuncionario) {
            header('Location: ' . BASE_URL . 'funcionario/listar');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_funcionario     = filter_input(INPUT_POST, 'nome_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf_funcionario      = filter_input(INPUT_POST, 'cpf_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco_funcionario = filter_input(INPUT_POST, 'endereco_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_funcionario   = filter_input(INPUT_POST, 'bairro_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $cidade_funcionario   = filter_input(INPUT_POST, 'cidade_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_funcionario   = filter_input(INPUT_POST, 'estado_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone_funcionario = filter_input(INPUT_POST, 'telefone_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_funcionario    = filter_input(INPUT_POST, 'email_funcionario', FILTER_SANITIZE_EMAIL);
            $senha_funcionario    = filter_input(INPUT_POST, 'senha_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_funcionario   = filter_input(INPUT_POST, 'status_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_especialidade    = filter_input(INPUT_POST, 'id_especialidade', FILTER_SANITIZE_NUMBER_INT);

            if ($nome_funcionario && $cpf_funcionario && $email_funcionario) {
                // Se a senha foi alterada, aplicar hash
                $senha_hash = $senha_funcionario ? password_hash($senha_funcionario, PASSWORD_DEFAULT) : $dadosFuncionario['senha_funcionario'];

                $dadosFuncionario = array(
                    'id_funcionario'      => $id,
                    'nome_funcionario'    => $nome_funcionario,
                    'cpf_funcionario'     => $cpf_funcionario,
                    'endereco_funcionario' => $endereco_funcionario,
                    'bairro_funcionario'  => $bairro_funcionario,
                    'cidade_funcionario'  => $cidade_funcionario,
                    'estado_funcionario'  => $estado_funcionario,
                    'telefone_funcionario' => $telefone_funcionario,
                    'email_funcionario'   => $email_funcionario,
                    'senha_funcionario'   => $senha_hash,
                    'status_funcionario'  => $status_funcionario,
                    'id_especialidade'    => $id_especialidade ?: null
                );

                $sucesso = $this->funcionarioModel->editarFuncionario($dadosFuncionario);

                if ($sucesso) {
                    $_SESSION['mensagem'] = 'Funcionário alterado com sucesso!';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: ' . BASE_URL . 'funcionario/listar');
                    exit;
                } else {
                    $dados['mensagem'] = 'Erro ao alterar o funcionário.';
                    $dados['tipo-msg'] = 'erro';
                }
            } else {
                $dados['mensagem'] = 'Erro - preencha todos os campos obrigatórios.';
                $dados['tipo-msg'] = 'erro';
            }
        }

        $dados['dadosFuncionario'] = $dadosFuncionario;
        $dados['conteudo'] = 'admin/funcionario/editar';

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

        $desativar = $this->funcionarioModel->desativarFuncionario($id);

        if ($desativar) {
            $_SESSION['mensagem'] = 'Funcionário desativado com sucesso';
            $_SESSION['tipo-msg'] = 'sucesso';

            echo json_encode(['sucesso' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao desativar o Funcionário']);
        }
    }
}