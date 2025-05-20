<!doctype html>
<html lang="pt-BR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>La Dolce Gelato | <?php echo isset($tituloPagina) ? $tituloPagina : 'Dashboard'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Dashboard La Dolce Gelato" />
    <meta name="author" content="Gabriel Lima" />
    <meta name="description" content="Dashboard La Dolce Gelato" />
    <meta name="keywords" content="Dashboard, La Dolce Gelato, Puro Gelato" />

    <!-- Fontes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />

    <!-- Bibliotecas CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />

    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dash/css/adminlte.css" />

    <style>
        :root {
            --primary-color: #d81b60;
            --secondary-color: #ff9eb5;
            --accent-color: #ff4081;
            --light-pink: #ffe6ee;
            --dark-pink: #9c27b0;
        }

        body {
            font-family: 'Source Sans 3', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar-brand {
            background: linear-gradient(135deg, #fff 0%, var(--light-pink) 100%);
            padding: 10px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .brand-text {
            color: var(--primary-color);
            font-weight: 600;
        }

        .nav-header {
            color: var(--primary-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            font-weight: 600;
            margin-top: 15px;
        }

        /* ESTILOS ADICIONAIS PARA O DASHBOARD */
        .dashboard-widget {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
        }

        .dashboard-widget:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .widget-icon {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 60px;
            opacity: 0.15;
            z-index: 1;
        }

        .widget-content {
            position: relative;
            z-index: 2;
            padding: 25px;
        }

        .widget-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: rgba(255, 255, 255, 0.9);
        }

        .widget-value {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0;
            color: white;
        }

        .widget-footer {
            background: rgba(0, 0, 0, 0.05);
            padding: 8px 15px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
        }

        .widget-footer i {
            margin-right: 5px;
        }

        /* Gráficos */
        .chart-container {
            position: relative;
            height: 250px;
        }

        .activity-item {
            border-left: 3px solid var(--primary-color);
            padding-left: 15px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            border-left-width: 5px;
            padding-left: 13px;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(216, 27, 96, 0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        /* Cores dos widgets */
        .widget-sabores {
            background: linear-gradient(135deg, #d81b60 0%, #9c27b0 100%);
        }

        .widget-funcionarios {
            background: linear-gradient(135deg, #ff4081 0%, #e91e63 100%);
        }

        .widget-contatos {
            background: linear-gradient(135deg, #ff9eb5 0%, #ff4081 100%);
        }

        .widget-pedidos {
            background: linear-gradient(135deg, #9c27b0 0%, #673ab7 100%);
        }

        /* Estilos gerais */
        .app-content {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .sidebar-brand {
                text-align: center;
            }

            .brand-image {
                margin: 0 auto;
            }

            .widget-content {
                text-align: center;
            }

            .widget-icon {
                position: relative;
                display: block;
                margin: 10px auto;
                right: auto;
                top: auto;
                opacity: 0.3;
            }

            .chart-container {
                height: 200px;
            }
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <!-- Cabeçalho - Atualizado para mostrar nome do usuário logado -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="<?php echo BASE_URL; ?>" class="nav-link">Site</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="<?php echo BASE_URL; ?>uploads/semfoto.png"
                                class="user-image rounded-circle shadow" alt="User Image" />
                            <span class="d-none d-md-inline">
                                <?php echo isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']['nome']) : 'Usuário' ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-white" style="background-color: var(--primary-color);">
                                <img src="<?php echo BASE_URL; ?>uploads/semfoto.png"
                                    class="rounded-circle shadow" alt="User Image" />
                                <p>
                                    <?php echo isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']['nome']) : 'Usuário' ?>
                                    <small>
                                        <?php echo isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']['email']) : '' ?>
                                    </small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <!-- <a href="#" class="btn btn-default btn-flat">Perfil</a> -->
                                <a href="<?php echo BASE_URL; ?>login/sair" class="btn btn-default btn-flat float-end">Sair</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Menu Lateral -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="light">
            <div class="sidebar-brand">
                <a href="./index.html" class="brand-link">
                    <img src="<?php echo BASE_URL; ?>assets/img/IconeDash.png" alt="La Dolce Gelato Logo"
                        style="height: 38px; width: auto; object-fit: contain;" />
                    <span class="brand-text fw-light">La Dolce Gelato</span>
                </a>
            </div>

            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>admin" class="nav-link <?php echo isset($isDashboardPage) && $isDashboardPage ? 'active' : ''; ?>">
                                <i class="nav-icon bi bi-speedometer2" style="color: var(--primary-color);"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-header">Gerenciamento de Conteúdo</li>

                        <li class="nav-item <?php echo isset($menuConteudoAberto) && $menuConteudoAberto ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?php echo isset($menuConteudoAberto) && $menuConteudoAberto ? 'active' : ''; ?>">
                                <i class="nav-icon bi bi-collection" style="color: var(--primary-color);"></i>
                                <p>
                                    Conteúdo Site
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL; ?>banner/listar" class="nav-link <?php echo isset($currentPage) && $currentPage === 'banner/listar' ? 'active' : ''; ?>">
                                        <i class="bi bi-image me-2" style="color: var(--accent-color);"></i>
                                        <p>Banners</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="dashboard" class="nav-link <?php echo isset($currentPage) && $currentPage === 'sobre' ? 'active' : ''; ?>">
                                        <i class="bi bi-info-circle me-2" style="color: var(--accent-color);"></i>
                                        <p>Sobre</p>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL; ?>contato/listar" class="nav-link <?php echo isset($currentPage) && $currentPage === 'contato/listar' ? 'active' : ''; ?>">
                                        <i class="bi bi-telephone me-2" style="color: var(--accent-color);"></i>
                                        <p>Contatos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">🍨 Sabores</li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>galeria/listar" class="nav-link <?php echo isset($currentPage) && $currentPage === 'galeria/listar' ? 'active' : ''; ?>">
                                <i class="nav-icon bi bi-ice-cream" style="color: var(--primary-color);"></i>
                                <p>Galeria de Sabores</p>
                            </a>
                        </li>

                        <li class="nav-header">👥 Equipe</li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>funcionario/listar" class="nav-link <?php echo isset($currentPage) && $currentPage === 'funcionario/listar' ? 'active' : ''; ?>">
                                <i class="nav-icon bi bi-people-fill" style="color: var(--primary-color);"></i>
                                <p>Funcionários</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Conteúdo Principal -->
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><?php echo isset($tituloPagina) ? $tituloPagina : 'Dashboard'; ?></h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin">Dashboard</a></li>
                                <?php if (isset($breadcrumb)): ?>
                                    <?php foreach ($breadcrumb as $item): ?>
                                        <li class="breadcrumb-item <?php echo $item['active'] ? 'active' : ''; ?>">
                                            <?php if ($item['active']): ?>
                                                <?php echo $item['text']; ?>
                                            <?php else: ?>
                                                <a href="<?php echo $item['link']; ?>"><?php echo $item['text']; ?></a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">
                    <?php if (isset($isDashboardPage) && $isDashboardPage): ?>
                        <!-- VISUALIZAÇÃO DO DASHBOARD -->
                        <!-- Widgets -->
                        <div class="row mb-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="dashboard-widget widget-sabores">
                                    <div class="widget-content">
                                        <h3 class="widget-value"><?php echo $totalSabores; ?></h3>
                                        <p class="widget-title">Sabores Cadastrados</p>
                                        <i class="bi bi-ice-cream widget-icon"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="dashboard-widget widget-funcionarios">
                                    <div class="widget-content">
                                        <h3 class="widget-value"><?php echo $totalFuncionarios; ?></h3>
                                        <p class="widget-title">Funcionários Ativos</p>
                                        <i class="bi bi-people-fill widget-icon"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="dashboard-widget widget-contatos">
                                    <div class="widget-content">
                                        <h3 class="widget-value"><?php echo $novosContatos; ?></h3>
                                        <p class="widget-title">Novos Contatos</p>
                                        <i class="bi bi-envelope widget-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gráficos e Atividades -->
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="card dashboard-widget h-100">
                                    <div class="card-header text-white" style="background-color: var(--primary-color);">
                                        <h3 class="card-title">Sabores Mais Populares</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="saboresChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="card dashboard-widget h-100">
                                    <div class="card-header text-white" style="background-color: var(--accent-color);">
                                        <h3 class="card-title">Atividades Recentes</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php if (!empty($atividadesRecentes)): ?>
                                            <?php foreach ($atividadesRecentes as $atividade): ?>
                                                <div class="activity-item">
                                                    <div class="d-flex align-items-start">
                                                        <div class="activity-icon" style="background-color: rgba(216, 27, 96, 0.1);">
                                                            <i class="bi <?php echo $atividade['icone']; ?>" style="color: var(--primary-color);"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-1 fw-bold" style="color: var(--dark-pink);">
                                                                <?php echo $atividade['titulo']; ?>
                                                            </h6>
                                                            <p class="mb-0">
                                                                <?php echo $atividade['descricao']; ?>
                                                            </p>
                                                            <?php if (!empty($atividade['tempo'])): ?>
                                                                <small class="text-muted"><?php echo $atividade['tempo']; ?></small>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="text-center py-3">
                                                <i class="bi bi-clock-history" style="font-size: 2rem; color: var(--secondary-color);"></i>
                                                <p class="text-muted mt-2">Nenhuma atividade recente</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Conteúdo Dinâmico -->
                    <div class="container-fluid">
                        <?php
                        if (isset($conteudo)) {
                            $this->carregarViews($conteudo, $dados);
                        } else {
                            // Configura o fuso horário
                            date_default_timezone_set('America/Sao_Paulo');

                            // Saudação baseada no horário
                            $horaAtual = (int)date('H');
                            $saudacao = ($horaAtual < 5) ? 'Boa madrugada' : (($horaAtual < 12) ? 'Bom dia' : (($horaAtual < 18) ? 'Boa tarde' : 'Boa noite'));

                            // Dados do usuário da sessão
                            $usuario = $_SESSION['usuario'];
                            $primeiroNome = explode(' ', $usuario['nome'])[0];
                        ?>

                            <!-- Saudação do Dashboard - Versão Simplificada e Alinhada -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm mb-4" style="border-left: 4px solid #d81b60 !important;">
                                        <div class="card-body p-3 py-4">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <i class="bi bi-ice-cream fs-1" style="color: #d81b60;"></i>
                                                    </div>
                                                    <div>
                                                        <h4 class="mb-1 fw-bold"><?= $saudacao ?>, <span style="color: #d81b60;"><?= htmlspecialchars($primeiroNome) ?></span></h4>
                                                        <p class="text-muted mb-0">
                                                            <i class="bi bi-calendar-check me-1"></i>
                                                            <?= date('d/m/Y') ?> •
                                                            <i class="bi bi-clock ms-2 me-1"></i>
                                                            <?= date('H:i') ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <span class="badge rounded-pill px-3 py-2" style="background-color: #d81b60; font-size: 0.9rem;">
                                                        <i class="bi bi-shield-lock me-1"></i> Painel Administrativo
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </main>

        <!-- Rodapé -->
        <footer class="app-footer" style="background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <strong>La Dolce Gelato &copy; 2025</strong>
                        <p class="mb-0">Sistema de Gerenciamento</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <span class="text-muted">Versão 1.0.0</span>
                        <div class="mt-1">
                            <a href="#" class="text-decoration-none me-2"><i class="bi bi-github"></i></a>
                            <a href="#" class="text-decoration-none me-2"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-decoration-none"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="//code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-3.5.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="<?php echo BASE_URL; ?>dash/js/adminlte.js"></script>

    <?php if (isset($isDashboardPage) && $isDashboardPage): ?>
        <!-- JAVASCRIPT PARA OS GRÁFICOS (APENAS NA PÁGINA INICIAL) -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gráfico de sabores populares
                const ctx = document.getElementById('saboresChart').getContext('2d');
                const saboresChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo json_encode(array_column($saboresPopulares, 'nome')); ?>,
                        datasets: [{
                            data: <?php echo json_encode(array_column($saboresPopulares, 'porcentagem')); ?>,
                            backgroundColor: [
                                '#d81b60', '#ff4081', '#ff9eb5', '#ffc0cb', '#ffe6ee'
                            ],
                            borderWidth: 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    boxWidth: 12,
                                    padding: 20,
                                    font: {
                                        family: "'Source Sans 3', sans-serif",
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.label}: ${context.raw}%`;
                                    }
                                },
                                bodyFont: {
                                    family: "'Source Sans 3', sans-serif",
                                    size: 14
                                }
                            }
                        },
                        cutout: '75%',
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });

                // Animação dos widgets
                const widgets = document.querySelectorAll('.dashboard-widget');
                widgets.forEach((widget, index) => {
                    widget.style.opacity = '0';
                    widget.style.transform = 'translateY(20px)';

                    setTimeout(() => {
                        widget.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                        widget.style.opacity = '1';
                        widget.style.transform = 'translateY(0)';
                    }, 100 * index);
                });
            });
        </script>
    <?php endif; ?>
</body>

</html>