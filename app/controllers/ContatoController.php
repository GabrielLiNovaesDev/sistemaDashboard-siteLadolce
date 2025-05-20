<?php
class ContatoController extends Controller
{
    private $contatoModel;


    public function __construct()
    {
        require_once MODELS_PATH . 'Contato.php';
        $this->contatoModel = new Contato();
       

        // Inicia a sessão se não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {


        $dados = array();
        $dados['titulo'] = 'La Dolce Gelato - Contatos';
        $dados['todosContato'] = $this->contatoModel->getTodosContato();

        // Verificação de dados
        if (empty($dados['todosContato'])) {
            error_log("Nenhum contato encontrado no banco de dados");
            $this->setMensagem('Nenhum contato encontrado', 'info');
        }

        $this->carregarViews('contato', $dados);
    }

    public function listar()
    {
        $this->verificarAutenticacao();

        $dados = array();
        $dados['conteudo'] = 'admin/contato/listar';
        $dados['todosContatos'] = $this->contatoModel->getTodosContato();
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
    public function enviar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "contato?status=metodo_invalido");
            exit;
        }

        require_once(PHPMAILER_PATH . 'PHPMailer.php');
        require_once(PHPMAILER_PATH . 'SMTP.php');
        require_once(PHPMAILER_PATH . 'Exception.php');

        // Validação dos dados
        $dados = $this->validarDadosContato($_POST);

        if ($dados === false) {
            header("Location: " . BASE_URL . "contato?status=dados_invalidos");
            exit;
        }

        // Salvar no banco de dados
        if ($this->contatoModel->salvarContato($dados)) {
            // Tentar enviar emails
            $emailEnviado = $this->enviarEmail($dados);
            $respostaEnviada = $this->enviarEmailResposta($dados);

            if ($emailEnviado && $respostaEnviada) {
                header("Location: " . BASE_URL . "?status=sucesso");
            } elseif ($emailEnviado) {
                header("Location: " . BASE_URL . "?status=sucesso_sem_resposta");
            } else {
                header("Location: " . BASE_URL . "contato?status=erro_email");
            }
        } else {
            header("Location: " . BASE_URL . "contato?status=erro_banco");
        }
        exit;
    }

    private function validarDadosContato($postData)
    {
        $requiredFields = ['nome', 'fone', 'email', 'assunto', 'mensagem'];

        foreach ($requiredFields as $field) {
            if (empty($postData[$field])) {
                error_log("Campo obrigatório faltando: $field");
                return false;
            }
        }

        // Sanitização dos dados
        $dados = [
            'nome'      => htmlspecialchars(trim($postData['nome']), ENT_QUOTES, 'UTF-8'),
            'fone'      => htmlspecialchars(trim($postData['fone']), ENT_QUOTES, 'UTF-8'),
            'email'     => filter_var(trim($postData['email']), FILTER_SANITIZE_EMAIL),
            'assunto'   => htmlspecialchars(trim($postData['assunto']), ENT_QUOTES, 'UTF-8'),
            'mensagem'  => htmlspecialchars(trim($postData['mensagem']), ENT_QUOTES, 'UTF-8')
        ];

        // Validação do email
        if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            error_log("Email inválido: " . $dados['email']);
            return false;
        }

        return $dados;
    }

    private function enviarEmail($dados)
    {
        try {
            $mail = $this->configurarMailer();

            $mail->setFrom('ti26@smpsistema.com.br', $dados['nome']);
            $mail->addAddress("glima.gn100@gmail.com", "Contato La Dolce Gelato");
            $mail->Subject = $dados['assunto'];

            $mail->Body = $this->criarCorpoEmail($dados, false);

            return $mail->send();
        } catch (Exception $e) {
            error_log("Erro ao enviar email: " . $e->getMessage());
            return false;
        }
    }

    private function enviarEmailResposta($dados)
    {
        try {
            $mail = $this->configurarMailer();

            $mail->setFrom('ti26@smpsistema.com.br', "La Dolce Gelato");
            $mail->addAddress($dados['email'], $dados['nome']);
            $mail->Subject = "Recebemos seu contato - {$dados['assunto']}";

            $mail->Body = $this->criarCorpoEmail($dados, true);

            return $mail->send();
        } catch (Exception $e) {
            error_log("Erro ao enviar email de resposta: " . $e->getMessage());
            return false;
        }
    }

    private function configurarMailer()
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = EMAIL_HOST;
        $mail->Port = EMAIL_PORT;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USER;
        $mail->Password = EMAIL_PASS;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        return $mail;
    }

    private function criarCorpoEmail($dados, $isResposta)
    {
        if ($isResposta) {
            return "Olá {$dados['nome']},<br><br>
                  Obrigado por entrar em contato conosco!<br>
                  Já recebemos sua mensagem e em breve retornaremos.<br><br>
                  <strong>Resumo do seu contato:</strong><br>
                  Assunto: {$dados['assunto']}<br>
                  Mensagem: {$dados['mensagem']}<br><br>
                  Em caso de urgência, ligue para (11) 95388-5367";
        } else {
            return "Nome: {$dados['nome']} <br>
                  Telefone: {$dados['fone']} <br>
                  E-Mail: {$dados['email']} <br>
                  Assunto: {$dados['assunto']} <br>
                  Mensagem: {$dados['mensagem']}";
        }
    }




    public function responder($id = null)
    {

        $this->verificarAutenticacao();
        // Inicia sessão se não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Verifica se o ID é válido
        if (!is_numeric($id)) {
            $this->setMensagem('ID inválido', 'erro');
            header('Location: ' . BASE_URL . 'contato/listar');
            exit;
        }
    
        // Carrega dados para o dashboard
        $dados = array();
        $dados['totalContatos'] = $this->contatoModel->getTotalContatos();
    
        // Obtém os dados do contato
        $dadosContato = $this->contatoModel->getDadosContato($id);
    
        if (!$dadosContato) {
            $this->setMensagem('Contato não encontrado', 'erro');
            header('Location: ' . BASE_URL . 'contato/listar');
            exit;
        }
    
        // Processa o formulário se for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resposta = htmlspecialchars(trim($_POST['resposta']), ENT_QUOTES, 'UTF-8');
    
            if (empty($resposta)) {
                $this->setMensagem('Preencha a resposta antes de enviar', 'erro');
                header('Location: ' . BASE_URL . 'contato/responder/' . $id);
                exit;
            }
    
            // Configuração do email
            $assuntoResposta = "Resposta ao seu contato - La Dolce Gelato";
            $emailDestinatario = $dadosContato['email_contato'];
            $nomeDestinatario = $dadosContato['nome_contato'];
    
            try {
                require_once(PHPMAILER_PATH . 'PHPMailer.php');
                require_once(PHPMAILER_PATH . 'SMTP.php');
                require_once(PHPMAILER_PATH . 'Exception.php');
    
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = EMAIL_HOST;
                $mail->Port = EMAIL_PORT;
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPAuth = true;
                $mail->Username = EMAIL_USER;
                $mail->Password = EMAIL_PASS;
                $mail->CharSet = 'UTF-8';
    
                $mail->setFrom(EMAIL_USER, 'La Dolce Gelato');
                $mail->addAddress($emailDestinatario, $nomeDestinatario);
                $mail->isHTML(true);
                $mail->Subject = $assuntoResposta;
                $mail->Body = nl2br($resposta);
                $mail->AltBody = strip_tags($resposta);
    
                if ($mail->send()) {
                    $this->contatoModel->atualizarStatusRespondido($id);
                    $this->setMensagem('Resposta enviada com sucesso!', 'sucesso');
                    header('Location: ' . BASE_URL . 'contato/listar');
                    exit;
                }
            } catch (Exception $e) {
                $this->setMensagem('Erro ao enviar resposta: ' . $e->getMessage(), 'erro');
                header('Location: ' . BASE_URL . 'contato/responder/' . $id);
                exit;
            }
        }
    
        // Se não for POST, prepara dados para a view
        $dados['dadosContato'] = $dadosContato;
        $dados['conteudo'] = 'admin/contato/responder'; // Atualize para o caminho correto da sua view
        $dados['titulo'] = 'Responder Contato - La Dolce Gelato';
    
        $this->carregarViews('admin/index', $dados);
    }






    

    public function marcarRespondido($id = null)
    {
        try {
            if (!is_numeric($id)) {
                throw new InvalidArgumentException("ID inválido");
            }

            if ($this->contatoModel->atualizarStatusRespondido($id)) {
                $this->setMensagem('Contato marcado como respondido', 'sucesso');
            } else {
                $this->setMensagem('Falha ao atualizar status', 'erro');
            }
        } catch (Exception $e) {
            error_log("Erro em marcarRespondido: " . $e->getMessage());
            $this->setMensagem('Erro ao processar solicitação', 'erro');
        }

        header("Location: " . BASE_URL . "contato/responder/" . $id);
        exit;
    }

    public function desativar($id = null)
    {
        header('Content-Type: application/json');

        if ($id === null) {
            http_response_code(400);
            echo json_encode(['sucesso' => false, 'mensagem' => 'ID inválido']);
            exit;
        }

        $desativar = $this->contatoModel->desativarContato($id);

        if ($desativar) {
            $_SESSION['mensagem'] = 'Contato desativado com sucesso';
            $_SESSION['tipo-msg'] = 'sucesso';

            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao desativar o Contato']);
        }
    }

    private function setMensagem($mensagem, $tipo = 'sucesso')
    {
        $_SESSION['mensagem'] = $mensagem;
        $_SESSION['tipo_msg'] = $tipo;
    }
}
