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

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responder Mensagem - La Dolce Gelato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #d81b60;
            --primary-light: #ff9eb5;
            --primary-dark: #9c27b0;
            --white: #ffffff;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-500: #adb5bd;
            --gray-800: #495057;
            --success: #28a745;
            --danger: #dc3545;
        }

        body {
            background-color: var(--gray-100);
            font-family: 'Source Sans 3', sans-serif;
        }

        .dashboard-alert {
            max-width: 800px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border: none;
        }

        .header-container {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 1rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(216, 27, 96, 0.1);
            border-radius: 0 0 12px 12px;
        }

        .dashboard-widget {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .dashboard-widget:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(216, 27, 96, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        .reply-card .card-header {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        }

        .card-body {
            padding: 1.75rem;
            background-color: var(--white);
        }

        .message-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .message-info-item {
            background-color: var(--gray-100);
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .message-info-label {
            font-size: 0.85rem;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .message-info-content {
            font-weight: 500;
            color: var(--gray-800);
        }

        .message-content {
            background-color: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 1.25rem;
            min-height: 200px;
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .form-control, .form-select {
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.2rem rgba(216, 27, 96, 0.15);
        }

        textarea.form-control {
            min-height: 250px;
            resize: vertical;
        }

        .btn {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(152, 27, 96, 0.3);
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: var(--white);
        }

        .divider {
            border-top: 1px dashed var(--gray-200);
            margin: 1.5rem 0;
        }

        .btn-voltar {
            background-color: var(--white);
            color: var(--primary);
            border: 1px solid var(--white);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-voltar:hover {
            background-color: transparent;
            color: var(--white);
            border-color: var(--white);
        }

        @media (max-width: 992px) {
            .message-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="header-container">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fs-4 fw-bold"><i class="bi bi-envelope me-2"></i> Responder Mensagem</h2>
                <a href="<?= BASE_URL ?>contato/listar" class="btn btn-voltar">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>
        </div>
    </div>

    <div class="container py-3">
        <!-- Alerta de sessão -->
        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="alert alert-<?= $_SESSION['tipo_msg'] ?> alert-dismissible fade show dashboard-alert" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi <?= ($_SESSION['tipo_msg'] === 'sucesso' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill') ?> me-2"></i>
                    <div><?= $_SESSION['mensagem'] ?></div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
            <?php unset($_SESSION['mensagem'], $_SESSION['tipo_msg']); ?>
        <?php endif; ?>

        <div class="row">
            <!-- Mensagem Recebida -->
            <div class="col-lg-6 mb-4">
                <div class="dashboard-widget card h-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-envelope me-2"></i>
                            <span class="fw-bold">Detalhes da Mensagem</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="message-info">
                            <div class="message-info-item">
                                <div class="message-info-label">Nome</div>
                                <div class="message-info-content"><?= htmlspecialchars($dadosContato['nome_contato']) ?></div>
                            </div>
                            <div class="message-info-item">
                                <div class="message-info-label">Email</div>
                                <div class="message-info-content"><?= htmlspecialchars($dadosContato['email_contato']) ?></div>
                            </div>
                            <div class="message-info-item">
                                <div class="message-info-label">Assunto</div>
                                <div class="message-info-content"><?= htmlspecialchars($dadosContato['assunto_contato']) ?></div>
                            </div>
                            <div class="message-info-item">
                                <div class="message-info-label">Data</div>
                                <div class="message-info-content"><?= date('d/m/Y H:i', strtotime($dadosContato['datahora_contato'])) ?></div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div>
                            <h6 class="fw-bold mb-3">Conteúdo da Mensagem:</h6>
                            <div class="message-content">
                                <?= nl2br(htmlspecialchars($dadosContato['mensagem_contato'])) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulário de Resposta -->
            <div class="col-lg-6 mb-4">
                <div class="dashboard-widget card h-100 reply-card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-reply me-2"></i>
                            <span class="fw-bold">Enviar Resposta</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= BASE_URL ?>contato/responder/<?= $dadosContato['id_contato'] ?>">
                            <input type="hidden" name="email_destinatario" value="<?= $dadosContato['email_contato'] ?>">
                            <input type="hidden" name="nome_destinatario" value="<?= $dadosContato['nome_contato'] ?>">

                            <div class="mb-4">
                                <label for="assunto" class="form-label fw-bold">Assunto da Resposta</label>
                                <input type="text" class="form-control" id="assunto" name="assunto"
                                       value="Re: <?= htmlspecialchars($dadosContato['assunto_contato']) ?>" required>
                            </div>

                            <div class="mb-4">
                                <label for="resposta" class="form-label fw-bold">Sua Resposta</label>
                                <textarea class="form-control" id="resposta" name="resposta"
                                          placeholder="Escreva aqui sua resposta..." required></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send-fill me-1"></i> Enviar Resposta
                                </button>
                            </div>
                        </form>
                    </div>
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

            // Foco no textarea ao carregar
            document.getElementById('resposta')?.focus();
        });
    </script>
</body>
</html>