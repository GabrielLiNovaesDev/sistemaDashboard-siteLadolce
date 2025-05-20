<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class LoginController extends Controller
{
    public function index()
    {
        if ($this->estaLogado()) {
            $this->redirecionarParaDashboard();
        }
        
        $this->carregarViews('login/index');
    }

    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirecionarParaLogin();
        }
    
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha'] ?? '';
    
        // Debug
        error_log("Tentativa de login - Email: $email, Senha: [oculto]");
    
        if (empty($email) || empty($senha)) {
            $_SESSION['erro_login'] = 'Preencha todos os campos';
            $this->redirecionarParaLogin();
        }
    
        $loginModel = new Login();
        $funcionario = $loginModel->verificarFunc($email, $senha);
    
        if ($funcionario) {
            $_SESSION['usuario'] = [
                'id' => $funcionario['id_funcionario'],
                'nome' => $funcionario['nome_funcionario'],
                'email' => $funcionario['email_funcionario'],
                'tipo' => 'funcionario'
            ];
            
            // Debug
            error_log("Login bem-sucedido para: " . $funcionario['email_funcionario']);
            
            $this->redirecionarParaDashboard();
        }
    
        // Debug
        error_log("Falha no login para: $email");
        
        $_SESSION['erro_login'] = 'Credenciais inválidas ou usuário inativo';
        $this->redirecionarParaLogin();
    }

    public function sair()
    {
        $_SESSION = array();
        session_destroy();
        $this->redirecionarParaLogin();
    }

    private function estaLogado()
    {
        return isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] === 'funcionario';
    }

    private function redirecionarParaDashboard()
    {
        header('Location:' . BASE_URL . 'admin');
        exit;
    }

    private function redirecionarParaLogin()
    {
        header('Location:' . BASE_URL . 'login');
        exit;
    }
}