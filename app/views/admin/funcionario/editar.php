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
    <title>Edição de Funcionário - La Dolce Gelato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            background-color: var(--white);
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

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--gray-500);
            z-index: 5;
        }

        .toggle-password:hover {
            color: var(--primary);
        }

        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--gray-200);
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
                <h2 class="mb-0 fs-4 fw-bold"><i class="bi bi-person-gear me-2"></i> Edição de Funcionário</h2>
                <a href="<?= BASE_URL ?>funcionario/listar" class="btn btn-voltar">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>
        </div>
    </div>

    <!-- Container Principal -->
    <div class="container py-3">
        <!-- Alertas de Sessão -->
        <?php if (isset($_SESSION['mensagem']) && isset($_SESSION['tipo_msg'])): ?>
            <div class="alert alert-<?php echo $_SESSION['tipo_msg'] === 'sucesso' ? 'success' : 'danger'; ?> alert-dismissible fade show dashboard-alert" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi <?php echo $_SESSION['tipo_msg'] === 'sucesso' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?> me-2"></i>
                    <div><?php echo $_SESSION['mensagem']; ?></div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
            <?php
            unset($_SESSION['mensagem']);
            unset($_SESSION['tipo_msg']);
            ?>
        <?php endif; ?>

        <!-- Formulário -->
        <div class="dashboard-widget card reply-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-lines-fill me-2"></i>
                    <span class="fw-bold">Editar Funcionário</span>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>funcionario/editar/<?= $dadosFuncionario['id_funcionario'] ?>" enctype="multipart/form-data">
        

                    <!-- Dados Pessoais -->
                    <h5 class="section-title"><i class="bi bi-person-vcard me-2"></i> Dados Pessoais</h5>
                    <div class="message-info">
                        <div class="message-info-item">
                            <div class="message-info-label">Nome Completo</div>
                            <input type="text" class="form-control mt-2" id="nome_funcionario"
                                name="nome_funcionario" required
                                value="<?= htmlspecialchars($dadosFuncionario['nome_funcionario']) ?>">
                        </div>
                        <div class="message-info-item">
                            <div class="message-info-label">CPF</div>
                            <input type="text" class="form-control mt-2" id="cpf_funcionario"
                                name="cpf_funcionario" required
                                value="<?= htmlspecialchars($dadosFuncionario['cpf_funcionario']) ?>"
                                oninput="formatarCPF(this)" maxlength="14">
                        </div>
                    </div>

                    <div class="message-info-item mb-3">
                        <div class="message-info-label">Endereço Completo</div>
                        <input type="text" class="form-control mt-2" id="endereco_funcionario"
                            name="endereco_funcionario" required
                            value="<?= htmlspecialchars($dadosFuncionario['endereco_funcionario']) ?>">
                    </div>

                    <div class="message-info">
                        <div class="message-info-item">
                            <div class="message-info-label">Bairro</div>
                            <input type="text" class="form-control mt-2" id="bairro_funcionario"
                                name="bairro_funcionario" required
                                value="<?= htmlspecialchars($dadosFuncionario['bairro_funcionario']) ?>">
                        </div>
                        <div class="message-info-item">
                            <div class="message-info-label">Cidade</div>
                            <input type="text" class="form-control mt-2" id="cidade_funcionario"
                                name="cidade_funcionario" required
                                value="<?= htmlspecialchars($dadosFuncionario['cidade_funcionario']) ?>">
                        </div>
                    </div>

                    <div class="message-info-item mb-3">
                        <div class="message-info-label">Estado</div>
                        <select class="form-select mt-2" id="estado_funcionario" name="estado_funcionario" required>
                            <option value="<?= $dadosFuncionario['estado_funcionario'] ?>"><?= $dadosFuncionario['estado_funcionario'] ?></option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>

                    <div class="divider"></div>

                    <!-- Contato -->
                    <h5 class="section-title"><i class="bi bi-telephone me-2"></i> Contato</h5>
                    <div class="message-info">
                        <div class="message-info-item">
                            <div class="message-info-label">Telefone</div>
                            <input type="text" class="form-control mt-2" id="telefone_funcionario"
                                name="telefone_funcionario" required
                                value="<?= htmlspecialchars($dadosFuncionario['telefone_funcionario']) ?>"
                                oninput="formatarTelefone(this)">
                        </div>
                        <div class="message-info-item">
                            <div class="message-info-label">Email</div>
                            <input type="email" class="form-control mt-2" id="email_funcionario"
                                name="email_funcionario" required
                                value="<?= htmlspecialchars($dadosFuncionario['email_funcionario']) ?>">
                        </div>
                    </div>

                    <div class="divider"></div>

                    <!-- Acesso -->
                    <h5 class="section-title"><i class="bi bi-shield-lock me-2"></i> Acesso</h5>
                    <div class="message-info">
                        <div class="message-info-item">
                            <div class="message-info-label">Senha</div>
                            <div class="password-container">
                                <input type="password" class="form-control mt-2" id="senha_funcionario"
                                    name="senha_funcionario" placeholder="Deixe em branco para manter a atual">
                                <span class="toggle-password" id="toggleSenha">
                                    <i class="fas fa-eye" id="iconeOlho"></i>
                                </span>
                            </div>
                            <small class="text-muted">Deixe em branco para manter a senha atual</small>
                        </div>
                        <div class="message-info-item">
                            <div class="message-info-label">Status</div>
                            <select class="form-select mt-2" id="status_funcionario" name="status_funcionario" required>
                                <option value="<?= $dadosFuncionario['status_funcionario'] ?>" selected><?= $dadosFuncionario['status_funcionario'] ?></option>
                                <option value="ATIVO">ATIVO</option>
                                <option value="INATIVO">INATIVO</option>
                                <option value="DESATIVADO">DESATIVADO</option>
                            </select>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <!-- Dados Profissionais -->
                    <h5 class="section-title"><i class="bi bi-briefcase me-2"></i> Dados Profissionais</h5>
                    <div class="message-info-item">
                        <div class="message-info-label">Especialidade</div>
                        <select class="form-select mt-2" id="id_especialidade" name="id_especialidade" required>
                            <?php foreach ($especialidades as $especialidade): ?>
                                <option value="<?= $especialidade['id_especialidade'] ?>"
                                    <?= ($especialidade['id_especialidade'] == $dadosFuncionario['id_especialidade']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($especialidade['nome_especialidade']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="reset" class="btn btn-outline-secondary me-2">
                            <i class="bi bi-x-circle me-1"></i> Limpar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            document.getElementById('toggleSenha').addEventListener('click', function() {
                const campoSenha = document.getElementById('senha_funcionario');
                const icone = document.getElementById('iconeOlho');

                if (campoSenha.type === 'password') {
                    campoSenha.type = 'text';
                    icone.classList.remove('fa-eye');
                    icone.classList.add('fa-eye-slash');
                } else {
                    campoSenha.type = 'password';
                    icone.classList.remove('fa-eye-slash');
                    icone.classList.add('fa-eye');
                }
            });

            // Auto-fechar alertas após 5 segundos
            const alert = document.querySelector('.dashboard-alert');
            if (alert) {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            }
        });

        function formatarCPF(input) {
            let valor = input.value.replace(/\D/g, '');

            if (valor.length > 11) {
                valor = valor.substring(0, 11);
            }

            if (valor.length > 9) {
                valor = valor.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            } else if (valor.length > 6) {
                valor = valor.replace(/(\d{3})(\d{3})(\d{3})/, '$1.$2.$3');
            } else if (valor.length > 3) {
                valor = valor.replace(/(\d{3})(\d{3})/, '$1.$2');
            }

            input.value = valor;
        }

        function formatarTelefone(input) {
            let valor = input.value.replace(/\D/g, '');

            if (valor.length > 11) {
                valor = valor.substring(0, 11);
            }

            if (valor.length > 10) {
                valor = valor.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else if (valor.length > 6) {
                valor = valor.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            } else if (valor.length > 2) {
                valor = valor.replace(/(\d{2})(\d{4})/, '($1) $2');
            } else if (valor.length > 0) {
                valor = valor.replace(/(\d{2})/, '($1)');
            }

            input.value = valor;
        }
    </script>
</body>

</html>