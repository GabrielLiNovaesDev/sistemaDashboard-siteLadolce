<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - La Dolce Gelato Dashboard</title>
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
            --warning: #ffc107;
        }

        body {
            background-color: var(--gray-100);
            font-family: 'Source Sans 3', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            position: relative;
            margin: 0;
        }

        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background-color: var(--primary-light);
            border-radius: 50%;
            opacity: 0.3;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
            }

            100% {
                transform: translateY(-100px) rotate(720deg);
            }
        }

        .login-container {
            position: relative;
            z-index: 1;
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
            background-color: var(--white);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(216, 27, 96, 0.2);
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .login-container:hover {
            box-shadow: 0 15px 40px rgba(216, 27, 96, 0.3);
            transform: translateY(-5px);
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            background-color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-body {
            padding: 2rem;
        }

        .form-floating {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            padding: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(216, 27, 96, 0.15);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            color: var(--white);
            padding: 0.75rem;
            font-weight: 600;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(152, 27, 96, 0.3);
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--gray-500);
        }

        /* Dark mode styles */
        body.dark-mode {
            background-color: #121212;
        }

        body.dark-mode .login-container {
            background-color: #1e1e1e;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        body.dark-mode .form-control {
            background-color: #2d2d2d;
            border-color: #444;
            color: #f5f5f5;
        }

        /* Animação de shake para erros */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-5px);
            }

            40%,
            80% {
                transform: translateX(5px);
            }
        }

        .shake {
            animation: shake 0.5s;
        }

        /* Alertas personalizados */
        .custom-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1100;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="<?= isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'true' ? 'dark-mode' : '' ?>">
    <!-- Dark Mode Toggle -->
    <div class="dark-mode-toggle" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
        <input type="checkbox" id="darkModeToggle" class="toggle-checkbox" <?= isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'true' ? 'checked' : '' ?>>
        <label for="darkModeToggle" class="toggle-label" style="display: flex; align-items: center; cursor: pointer;">
            <i class="bi <?= isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'true' ? 'bi-sun-fill' : 'bi-moon-fill' ?> me-2"></i>
        </label>
    </div>

    <!-- Efeito de partículas -->
    <div class="particles" id="particles"></div>

    <!-- Container de Login -->
    <div class="login-container">
        <!-- Header -->
        <div class="login-header">
            <div class="login-logo">
            <img src="<?php echo BASE_URL; ?>assets/img/IconeDash.png" alt="La Dolce Gelato Logo" 
            style="width: 100px; height: 100px; object-fit: contain; filter: hue-rotate(330deg);">
            </div>
            <h1 class="login-title">La Dolce Gelato</h1>
            <p class="login-subtitle" style="opacity: 0.9;">Dashboard Administrativo</p>
        </div>

        <!-- Corpo do Formulário -->
        <div class="login-body">
            <?php if (isset($_SESSION['erro_login'])): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= $_SESSION['erro_login'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
                <?php unset($_SESSION['erro_login']); ?>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>login/autenticar" method="POST" id="loginForm">
                <!-- Email -->
                <div class="form-floating mb-4">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                    <label for="email">Email</label>
                </div>

                <!-- Senha -->
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="senha" placeholder="Password" required minlength="6">
                    <label for="password">Senha</label>
                    <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
                </div>

                <!-- Lembrar de mim e Esqueci a senha -->
                <!-- <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe" name="lembrar">
                        <label class="form-check-label" for="rememberMe">Lembrar de mim</label>
                    </div>
                    <a href="#" style="color: var(--primary); text-decoration: none;">Esqueci a senha</a>
                </div> -->

                <!-- Botão de Login -->
                <button type="submit" class="btn btn-login mb-3" id="loginButton">
                    <span id="loginText">Entrar</span>
                    <span id="loginSpinner" style="display: none;" class="spinner-border spinner-border-sm"></span>
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dark Mode
            const darkModeToggle = document.getElementById('darkModeToggle');
            darkModeToggle.addEventListener('change', function() {
                document.body.classList.toggle('dark-mode', this.checked);
                document.cookie = `darkMode=${this.checked};path=/;max-age=${60*60*24*30}`;

                // Atualiza ícone
                const icon = this.nextElementSibling.querySelector('i');
                icon.classList.toggle('bi-moon-fill');
                icon.classList.toggle('bi-sun-fill');
            });

            // Toggle password
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });

            // Validação do formulário
            const loginForm = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');
            const loginText = document.getElementById('loginText');
            const loginSpinner = document.getElementById('loginSpinner');

            loginForm.addEventListener('submit', function(e) {
                // Validação básica do cliente
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                if (!email || !password) {
                    e.preventDefault();
                    loginForm.classList.add('shake');
                    setTimeout(() => {
                        loginForm.classList.remove('shake');
                    }, 500);
                    return;
                }

                // Mostra spinner durante o submit
                loginButton.disabled = true;
                loginText.textContent = "Autenticando...";
                loginSpinner.style.display = 'inline-block';
            });

            // Criar partículas
            function createParticles() {
                const container = document.getElementById('particles');
                const count = Math.floor(window.innerWidth / 20);

                for (let i = 0; i < count; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';

                    particle.style.width = `${Math.random() * 10 + 5}px`;
                    particle.style.height = particle.style.width;
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.top = `${Math.random() * 100}%`;
                    particle.style.animationDuration = `${Math.random() * 10 + 10}s`;
                    particle.style.animationDelay = `${Math.random() * 5}s`;

                    container.appendChild(particle);
                }
            }

            createParticles();

            <?php if (isset($_SESSION['erro_login'])): ?>
                // Adiciona animação de shake quando há erro
                loginForm.classList.add('shake');
                setTimeout(() => {
                    loginForm.classList.remove('shake');
                }, 500);
            <?php endif; ?>
        });
    </script>
</body>

</html>