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
    <title>Cadastro de Sabores - La Dolce Gelato</title>
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
            --gray-300: #dee2e6;
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
        }

        .reply-card .card-header {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        .card-title {
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 0;
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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
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

        .image-upload-container {
            border: 2px dashed var(--primary);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: var(--white);
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .image-upload-container:hover {
            border-color: var(--primary-dark);
            background-color: rgba(216, 27, 96, 0.05);
        }

        .preview-image {
            max-width: 100%;
            max-height: 250px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--gray-300);
        }

        .form-control,
        .form-select {
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.2rem rgba(216, 27, 96, 0.15);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .btn {
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
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

        .btn-outline-secondary {
            color: var(--gray-800);
            border-color: var(--gray-300);
        }

        .btn-outline-secondary:hover {
            background-color: var(--gray-200);
        }

        .required-field::after {
            content: " *";
            color: var(--danger);
        }

        .divider {
            border-top: 1px dashed var(--gray-300);
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

        @media (max-width: 768px) {
            .header-container {
                padding: 0.75rem 0;
            }

            .card-header {
                padding: 0.75rem 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header Padrão -->
    <div class="header-container">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fs-4 fw-bold"><i class="bi bi-ice-cream me-2"></i> Cadastro de Sabores</h2>
                <a href="<?= BASE_URL ?>galeria/listar" class="btn btn-voltar">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>
        </div>
    </div>

    <!-- Container Principal -->
    <div class="container py-3">


        <form method="POST" action="<?= BASE_URL ?>galeria/adicionar" method="POST" enctype="multipart/form-data">
            <!-- Formulário -->
            <div class="row">
                <!-- Seção da Imagem -->
                <div class="col-lg-5 mb-4">
                    <div class="dashboard-widget card h-100">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-image me-2"></i>
                                <span class="fw-bold">Imagem do Sabor</span>
                            </div>
                        </div>



                        <div class="card-body">
                            <div class="image-upload-container" id="imageUploadContainer">
                                <img id="preview" src="<?= BASE_URL ?>uploads/semfoto.png"
                                    class="preview-image mb-3" alt="Pré-visualização">
                                <input type="file" class="form-control d-none" name="imagem_sabores"
                                    id="imagem_sabores" accept="image/*" required>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-upload me-1"></i> Clique para adicionar uma imagem
                                </p>
                                <small class="text-muted">Formatos: JPG, PNG (Max. 2MB)</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulário de Cadastro -->
                <div class="col-lg-7 mb-4">
                    <div class="dashboard-widget card h-100 reply-card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-pencil-square me-2"></i>
                                <span class="fw-bold">Informações do Sabor</span>
                            </div>
                        </div>
                        <div class="card-body">

                       

                            <div class="message-info">
                                <div class="message-info-item">
                                    <div class="message-info-label">Nome do Sabor</div>
                                    <input type="text" class="form-control mt-2" id="nome_sabores"
                                        name="nome_sabores" required placeholder="Ex: Chocolate Belga"
                                        maxlength="100">
                                </div>
                                <div class="message-info-item">
                                    <div class="message-info-label">Status</div>
                                    <select class="form-select mt-2" id="status_sabores" name="status_sabores" required>
                                        <option value="ATIVO" selected>ATIVO</option>
                                        <option value="INATIVO">INATIVO</option>
                                        <option value="DESATIVADO">DESATIVADO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i> Limpar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Salvar Sabor
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-fechar alertas após 5 segundos
            const alert = document.querySelector('.dashboard-alert');
            if (alert) {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            }

            // Upload de imagem
            const imageContainer = document.getElementById('imageUploadContainer');
            const preview = document.getElementById('preview');
            const fileInput = document.getElementById('imagem_sabores');

            imageContainer.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    // Verifica tamanho do arquivo (max 2MB)
                    if (this.files[0].size > 2 * 1024 * 1024) {
                        alert('O arquivo selecionado é muito grande. Tamanho máximo permitido: 2MB');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        preview.src = e.target.result;
                        imageContainer.style.borderColor = 'var(--primary)';
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Drag and drop
            ['dragover', 'dragleave', 'drop'].forEach(event => {
                imageContainer.addEventListener(event, (e) => {
                    e.preventDefault();
                    if (event === 'dragover') {
                        imageContainer.style.borderColor = 'var(--primary-dark)';
                        imageContainer.style.backgroundColor = 'rgba(216, 27, 96, 0.1)';
                    } else if (event === 'dragleave') {
                        imageContainer.style.borderColor = 'var(--primary)';
                        imageContainer.style.backgroundColor = '';
                    } else if (event === 'drop' && e.dataTransfer.files.length) {
                        fileInput.files = e.dataTransfer.files;
                        fileInput.dispatchEvent(new Event('change'));
                    }
                });
            });
        });
    </script>
</body>

</html>