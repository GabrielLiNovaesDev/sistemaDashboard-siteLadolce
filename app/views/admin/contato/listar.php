<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensagem'], $_SESSION['tipo-msg'])) {
    $mens = $_SESSION['mensagem'];
    $tipo = $_SESSION['tipo-msg'];
    $alertClass = $tipo === 'sucesso' ? 'alert-success' : 'alert-danger';

    echo '<div class="alert ' . $alertClass . ' alert-dismissible fade show custom-alert" id="mensagem-alert" role="alert">'
        . $mens .
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>';

    unset($_SESSION['mensagem'], $_SESSION['tipo-msg']);
}
?>

<div class="card dashboard-widget mb-4">
    <div class="card-header text-white" style="background: linear-gradient(135deg, #d81b60 0%, #9c27b0 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><i class="bi bi-envelope-fill me-2"></i> Contatos</h3>
        </div>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Assunto</th>
                        <th class="text-center">Mensagem</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($todosContatos as $linha): ?>
                        <tr>
                            <td class="text-center align-middle"><?= htmlspecialchars($linha['nome_contato']) ?></td>
                            <td class="text-center align-middle"><?= htmlspecialchars($linha['assunto_contato']) ?></td>
                            <td class="text-center align-middle"><?= htmlspecialchars($linha['mensagem_contato']) ?></td>
                            <td class="text-center align-middle">
                                <span class="badge rounded-pill <?= $linha['status_contato'] === 'Lido' ? 'bg-success' : 'bg-warning text-dark' ?>">
                                    <?= htmlspecialchars($linha['status_contato']) ?>
                                </span>
                            </td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= BASE_URL ?>contato/responder/<?= $linha['id_contato'] ?>" 
                                       class="btn btn-outline-primary btn-sm" 
                                       title="Responder">
                                        <i class="bi bi-reply-fill"></i>
                                    </a>
                                    <button class="btn btn-outline-danger btn-sm" 
                                            title="Deletar"
                                            onclick="abrirModal(<?= $linha['id_contato'] ?>)">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="desativarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #d81b60 0%, #9c27b0 100%);">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i> Confirmar Exclusão</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body py-4">
                <p>Tem certeza que deseja excluir permanentemente este contato?</p>
                <input type="hidden" id="idParaDesativar">
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnDesativar">
                    <i class="bi bi-trash-fill me-1"></i> Excluir
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Auto-fechar alertas após 5 segundos
        const alert = document.querySelector('.dashboard-alert');
        if (alert) {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        }

        // Modal de exclusão
        window.abrirModal = function(id) {
            document.getElementById('idParaDesativar').value = id;
            new bootstrap.Modal(document.getElementById('desativarModal')).show();
        };

        // Ação de deletar
        document.getElementById('btnDesativar').addEventListener('click', async () => {
            const id = document.getElementById('idParaDesativar').value;
            if (!id) return;

            try {
                const response = await fetch(`<?= BASE_URL ?>contato/desativar/${id}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' }
                });
                
                if (!response.ok) throw new Error('Erro na requisição');
                
                location.reload();
            } catch (error) {
                alert('Erro ao excluir. Tente novamente.');
            }
        });
    });
</script>

<style>
    :root {
        --primary: #d81b60;
        --primary-dark: #9c27b0;
        --primary-light: #ff9eb5;
        --danger: #dc3545;
        --warning: #ffc107;
        --success: #28a745;
        --secondary: #6c757d;
        --white: #ffffff;
        --gray-100: #f8f9fa;
        --gray-200: #e9ecef;
        --gray-500: #adb5bd;
        --gray-800: #495057;
    }

    .dashboard-alert {
        max-width: 800px;
        margin: 20px auto;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border: none;
    }
    
    .dashboard-widget {
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .dashboard-widget:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(216, 27, 96, 0.15);
    }
    
    .card-header {
        padding: 1rem 1.5rem;
        border-bottom: none;
    }
    
    .card-title {
        font-weight: 600;
        font-size: 1.25rem;
    }
    
    .table {
        margin-bottom: 0;
        border-color: var(--gray-200);
    }
    
    .table th {
        background-color: var(--gray-100);
        color: var(--gray-800);
        font-weight: 600;
        text-align: center;
        vertical-align: middle;
        padding: 1rem;
        border-bottom: 2px solid var(--gray-200);
    }
    
    .table td {
        text-align: center;
        vertical-align: middle;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--gray-200);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(216, 27, 96, 0.05);
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 0.75em;
        border-radius: 50px;
        min-width: 70px;
    }
    
    .btn {
        border-radius: 50px;
        padding: 0.375rem 0.75rem;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    
    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--primary);
        color: var(--white);
        box-shadow: 0 4px 12px rgba(216, 27, 96, 0.2);
    }
    
    .btn-outline-danger {
        color: var(--danger);
        border-color: var(--danger);
    }
    
    .btn-outline-danger:hover {
        background-color: var(--danger);
        color: var(--white);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
    }
    
    .btn-outline-secondary {
        color: var(--secondary);
        border-color: var(--secondary);
    }
    
    .btn-outline-secondary:hover {
        background-color: var(--secondary);
        color: var(--white);
    }
    
    .btn-danger {
        background-color: var(--danger);
        border-color: var(--danger);
    }
    
    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
    
    .d-flex.gap-2 {
        gap: 0.5rem;
    }
    
    .modal-content {
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        border: none;
    }
    
    .modal-header {
        border-radius: 12px 12px 0 0 !important;
        padding: 1rem 1.5rem;
        border-bottom: none;
    }
    
    .modal-title {
        font-weight: 600;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    .modal-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--gray-200);
    }
</style>