<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensagem'], $_SESSION['tipo_msg'])) {
    $mens = $_SESSION['mensagem'];
    $tipo = $_SESSION['tipo_msg'];
    $alertClass = $tipo === 'sucesso' ? 'alert-success' : 'alert-danger';

    echo '<div class="alert ' . $alertClass . ' alert-dismissible fade show dashboard-alert" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi ' . ($tipo === 'sucesso' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill') . ' me-2"></i>
                <div>' . $mens . '</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>';

    unset($_SESSION['mensagem'], $_SESSION['tipo_msg']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banners - La Dolce Gelato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #d81b60;
            --secondary-color: #ff9eb5;
            --accent-color: #ff4081;
            --light-pink: #ffe6ee;
            --dark-pink: #9c27b0;
            --branco: #ffffff;
            --cinza-claro: #f8f9fa;
            --cinza-medio: #dee2e6;
            --cinza-escuro: #495057;
            --verde: #28a745;
            --cinza-secundario: #6c757d;
        }

        body {
            background-color: var(--cinza-claro);
            font-family: 'Source Sans 3', sans-serif;
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
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-pink) 100%);
            color: var(--branco);
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        .card-title {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
            width: 100%;
        }

        .table th {
            background-color: var(--cinza-claro);
            color: var(--cinza-escuro);
            font-weight: 600;
            padding: 1rem;
            border-bottom: 2px solid var(--cinza-medio);
        }

        .table td {
            vertical-align: middle;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--cinza-medio);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(216, 27, 96, 0.05);
        }

        .img-thumbnail {
            border-radius: 8px;
            transition: transform 0.3s ease;
            object-fit: cover;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
        }

        .badge {
            font-weight: 500;
            padding: 0.5em 0.75em;
            border-radius: 50px;
        }

        .bg-success {
            background-color: var(--verde) !important;
        }

        .bg-secondary {
            background-color: var(--cinza-secundario) !important;
        }

        .btn {
            border-radius: 50px;
            padding: 0.375rem 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            background-color: transparent;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: var(--branco);
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
            background-color: transparent;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-secondary {
            background-color: var(--cinza-secundario);
            border-color: var(--cinza-secundario);
        }

        .modal-content {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-pink) 100%);
            color: var(--branco);
            border-bottom: none;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem 1.5rem;
        }

        .modal-title {
            font-weight: 600;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: none;
            padding: 1rem 1.5rem;
        }

        .btn-close-white {
            filter: invert(1);
        }

        .d-flex.gap-2 {
            gap: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="card dashboard-widget mb-4">
        <div class="card-header text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0"><i class="bi bi-images me-2"></i> Gerenciamento de Banners</h3>
                <!-- <a href="<?= BASE_URL ?>banner/adicionar" class="btn btn-sm" style="background-color: rgba(255,255,255,0.2);">
                    <i class="bi bi-plus-circle me-1"></i> Novo Banner
                </a> -->
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="200px">Banner</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th width="100px">Status</th>
                            <!-- <th width="120px" class="text-center">Ações</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banner as $linha): ?>
                            <tr>
                                <td>
                                    <?php
                                    $baseUploads = BASE_URL . 'uploads/';
                                    if (!empty($linha['foto_banner'])) {
                                        $fotoPath = 'banner/' . $linha['foto_banner'];
                                        $urlFoto = $baseUploads . $fotoPath;
                                        $caminhoAbsoluto = $_SERVER['DOCUMENT_ROOT'] . parse_url($baseUploads, PHP_URL_PATH) . $fotoPath;
                                        if (!file_exists($caminhoAbsoluto)) {
                                            $urlFoto = $baseUploads . 'semfoto.png';
                                        }
                                    } else {
                                        $urlFoto = $baseUploads . 'semfoto.png';
                                    }
                                    ?>
                                    <img src="<?= $urlFoto ?>" 
                                         alt="<?= htmlspecialchars($linha['alt_banner'] ?? 'Banner') ?>"
                                         class="img-thumbnail" 
                                         style="width: 180px; height: 100px;">
                                </td>
                                <td><?= htmlspecialchars($linha['nome_banner'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($linha['alt_banner'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td>
                                    <span class="badge rounded-pill <?= $linha['status_banner'] === 'Ativo' ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= htmlspecialchars($linha['status_banner'], ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>
                                <!-- <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?= BASE_URL ?>banner/editar/<?= $linha['id_banner'] ?>" 
                                           class="btn btn-outline-primary btn-sm" 
                                           title="Editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <button class="btn btn-outline-danger btn-sm" 
                                                title="Desativar"
                                                onclick="abrirModalBanner(<?= $linha['id_banner'] ?>)">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Desativar -->
    <div class="modal fade" id="desativarModalBanner" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header text-white">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i> Confirmar Desativação</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body py-4">
                    <p>Tem certeza que deseja desativar este banner?</p>
                    <input type="hidden" id="idParaDesativarBanner">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnDesativarBanner">
                        <i class="bi bi-trash-fill me-1"></i> Desativar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

            // Modal de desativação
            window.abrirModalBanner = function(id_banner) {
                document.getElementById('idParaDesativarBanner').value = id_banner;
                new bootstrap.Modal(document.getElementById('desativarModalBanner')).show();
            };

            // Ação de desativar
            document.getElementById('btnDesativarBanner').addEventListener('click', async () => {
                const idBanner = document.getElementById('idParaDesativarBanner').value;
                if (!idBanner) return;

                try {
                    const response = await fetch(`<?= BASE_URL ?>banner/desativar/${idBanner}`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' }
                    });
                    
                    if (!response.ok) throw new Error('Erro na requisição');
                    
                    const result = await response.json();
                    if (result.success) {
                        location.reload();
                    } else {
                        showToast('error', result.message || 'Erro ao desativar');
                    }
                } catch (error) {
                    showToast('error', 'Erro ao desativar. Tente novamente.');
                }
            });

            // Função para mostrar notificação
            function showToast(type, message) {
                // Implementação do toast conforme seu sistema
                console.log(`${type}: ${message}`);
            }
        });
    </script>
</body>
</html>