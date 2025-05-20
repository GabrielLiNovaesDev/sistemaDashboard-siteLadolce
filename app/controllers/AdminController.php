<?php
class AdminController extends Controller
{
    public function index()
    {
        $this->verificarAutenticacao();

        $contatoModel = new Contato();
        $funcionarioModel = new Funcionario();
        $galeriaModel = new Galeria();


        // Obter dados do usuário logado
        $usuarioLogado = $_SESSION['usuario'];
        $nomeUsuario = explode(' ', $usuarioLogado['nome'])[0]; // Pega o primeiro nome

        $dados = [
            'isDashboardPage' => true,
            'tituloPagina' => 'Dashboard',
            'titulo' => 'Dashboard - La Dolce Gelato',
            'usuarioLogado' => $usuarioLogado,
            'nomeUsuario' => $nomeUsuario,
            'totalSabores' => count($galeriaModel->getTodaGaleria()),
            'totalFuncionarios' => count($funcionarioModel->getTodosFuncionarios()),
            'novosContatos' => $contatoModel->getTotalContatos(),
            'saboresPopulares' => $this->getSaboresPopulares(),
            'atividadesRecentes' => $this->getAtividadesRecentes(),
            'breadcrumb' => [
                ['text' => 'Dashboard', 'link' => '', 'active' => true]
            ]
        ];

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


    private function getSaboresPopulares()
    {
        return [
            ['nome' => 'Chocolate Belga', 'porcentagem' => 35],
            ['nome' => 'Morango Silvestre', 'porcentagem' => 25],
            ['nome' => 'Baunilha Madagascar', 'porcentagem' => 20],
            ['nome' => 'Limão Siciliano', 'porcentagem' => 15],
            ['nome' => 'Coco Cremoso', 'porcentagem' => 5]
        ];
    }

    private function getAtividadesRecentes()
    {
        $contatoModel = new Contato();
        $galeriaModel = new Galeria();
        $funcionarioModel = new Funcionario();

        $contatos = $contatoModel->getTodosContato();
        $ultimoContato = !empty($contatos) ? $contatos[0] : null;

        $todaGaleria = $galeriaModel->getTodaGaleria();
        $ultimoSabor = !empty($todaGaleria) ? $todaGaleria[0] : null; 

        $todosFuncionarios = $funcionarioModel->getTodosFuncionarios();
        $ultimoFuncionario = !empty($todosFuncionarios) ? $todosFuncionarios[0] : null; 

        $atividades = [];

        if ($ultimoSabor) {
            $dataSabor = date('d/m/Y', strtotime($ultimoSabor['data_cad_sabores'] ?? date('Y-m-d')));
            $atividades[] = [
                'icone' => 'bi-basket',
                'titulo' => 'Novo sabor adicionado',
                'descricao' => $ultimoSabor['nome_sabores'],
                'tempo' => $dataSabor
            ];
        }

        if ($ultimoFuncionario) {
            $dataFuncionario = date('d/m/Y', strtotime($ultimoFuncionario['data_cad_funcionario'] ?? date('Y-m-d')));
            $atividades[] = [
                'icone' => 'bi-person-plus',
                'titulo' => 'Novo funcionário cadastrado',
                'descricao' => $ultimoFuncionario['nome_funcionario'],
                'tempo' => $dataFuncionario
            ];
        }

        if ($ultimoContato) {
            $dataContato = date('d/m/Y', strtotime($ultimoContato['datahora_contato']));
            $atividades[] = [
                'icone' => 'bi-envelope',
                'titulo' => 'Novo contato recebido',
                'descricao' => $ultimoContato['nome_contato'] . ' (' . $ultimoContato['assunto_contato'] . ')',
                'tempo' => $dataContato
            ];
        }

        return $atividades;
    }
}
