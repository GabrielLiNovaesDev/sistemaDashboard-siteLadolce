<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelato Artesanal - Premium</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --rosa-claro: #f2a0af;
            --rosa-claro-transparent: rgba(242, 160, 175, 0.1);
            --vermelho-escuro: #bf364f;
            --vermelho-escuro-transparent: rgba(191, 54, 79, 0.1);
            --branco: #ffffff;
            --branco-transparent: rgba(255, 255, 255, 0.8);
            --sombra: rgba(0, 0, 0, 0.08);
            --sombra-hover: rgba(0, 0, 0, 0.15);
            --chocolate: #3A2A22;
            --chocolate-claro: #5a4a42;
            --fonte-principal: 'Montserrat', sans-serif;
            --fonte-secundaria: 'Playfair Display', serif;
        }

        body {
            font-family: var(--fonte-principal);
            line-height: 1.6;
            margin: 0;
            overflow-x: hidden;
            color: var(--chocolate);
            background-color: var(--branco);
        }

        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: linear-gradient(135deg, var(--branco) 0%, var(--rosa-claro-transparent) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 10;
            padding: 4rem 2rem;
        }

        .hero-title {
            font-family: var(--fonte-secundaria);
            font-weight: 700;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--chocolate);
        }

        .hero-subtitle {
            font-family: var(--fonte-secundaria);
            font-weight: 600;
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            color: var(--vermelho-escuro);
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }

        .hero-subtitle::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--vermelho-escuro);
            border-radius: 3px;
        }

        .hero-text {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 2.5rem;
            max-width: 600px;
            opacity: 0.9;
        }

        .hero-image {
            position: relative;
            height: 100%;
            min-height: 60vh;
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 0 0 0 200px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            transition: transform 1s cubic-bezier(0.25, 0.45, 0.45, 0.95);
            margin-top: -100px;
        }

        /* BOTÃO PRINCIPAL ATUALIZADO */
        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            padding: 13px 30px;
            background: linear-gradient(135deg, var(--rosa-claro), var(--vermelho-escuro));
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 5px 20px rgba(191, 54, 79, 0.3);
            transition: all 0.3s ease;
            border: none;
            text-transform: none;
            letter-spacing: normal;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 25px rgba(191, 54, 79, 0.4);
            color: white;
        }

        .btn-primary-custom i {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .btn-primary-custom:hover i {
            transform: translateX(5px);
        }

        /* BOTÃO SECUNDÁRIO ATUALIZADO */
        .btn-outline-custom {
            display: inline-flex;
            align-items: center;
            padding: 11px 28px;
            background: transparent;
            color: var(--vermelho-escuro);
            border: 2px solid var(--vermelho-escuro);
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 3px 10px rgba(191, 54, 79, 0.1);
        }

        .btn-outline-custom:hover {
            transform: translateY(-3px);
            background: var(--vermelho-escuro);
            color: white;
            box-shadow: 0 8px 20px rgba(191, 54, 79, 0.2);
        }

        .btn-outline-custom i {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .btn-outline-custom:hover i {
            transform: translateX(5px);
        }

        /* Efeito de partículas */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background-color: var(--rosa-claro);
            border-radius: 50%;
            opacity: 0.3;
            animation: float-particle 15s infinite linear;
        }

        @keyframes float-particle {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.3;
            }

            50% {
                opacity: 0.1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0.3;
            }
        }

        /* Efeito de gradiente animado */
        .gradient-bg {
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle at center, var(--rosa-claro-transparent) 0%, transparent 70%);
            animation: rotate-gradient 20s linear infinite;
            z-index: 0;
        }

        @keyframes rotate-gradient {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsividade */
        @media (max-width: 992px) {
            .hero-section {
                flex-direction: column;
                min-height: auto;
                padding-top: 80px;
            }

            .hero-content {
                text-align: center;
                padding: 3rem 1.5rem;
            }

            .hero-subtitle::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .hero-text {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-image img {
                border-radius: 0;
                margin-top: -100px;
            }

            .btn-group {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1.3rem;
            }

            .btn-primary-custom,
            .btn-outline-custom {
                padding: 0.7rem 1.5rem;
                font-size: 0.8rem;
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <section class="hero-section">
        <!-- Efeito de partículas -->
        <div class="particles" id="particles-js"></div>

        <!-- Efeito de gradiente animado -->
        <!-- <div class="gradient-bg"></div> -->

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="hero-content" data-aos="fade-right" data-aos-duration="1000">
                        <h1 class="hero-title animate__animated animate__fadeInDown">
                            Gelato Artesanal
                        </h1>
                        <h2 class="hero-subtitle animate__animated animate__fadeInDown animate__delay-1s">
                            Feito com Paixão
                        </h2>
                        <p class="hero-text animate__animated animate__fadeIn animate__delay-1s">
                            Nossos gelatos são preparados diariamente com ingredientes frescos e selecionados,
                            mantendo a tradição italiana com um toque de criatividade.
                        </p>
                        <p id="texto-animado" class="texto-descricao" data-aos="fade-right" data-aos-duration="800" data-aos-delay="300"></p>

                        <div class="d-flex flex-wrap gap-3 animate__animated animate__fadeInUp animate__delay-2s">
                            <a id="galeria" href="#" class="btn btn-primary-custom">
                                Nossos Sabores
                                <i class="fas fa-arrow-right"></i>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-1">
                    <div class="hero-image" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                        <img src="<?php echo BASE_URL; ?>assets/img/banner.png"
                            alt="Gelato artesanal"
                            class="animate__animated animate__fadeIn animate__delay-1s">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS (Animate On Scroll) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Typed.js para efeito de digitação -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

    <script>
        // Inicializa AOS (Animate On Scroll)
        AOS.init({
            once: true,
            duration: 800,
            easing: 'ease-out-quart',
            offset: 120
        });

        // Cria partículas animadas
        function createParticles() {
            const particlesContainer = document.getElementById('particles-js');
            const particleCount = 20;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Tamanho aleatório entre 5px e 15px
                const size = Math.random() * 10 + 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;

                // Posição inicial aleatória
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;

                // Duração e delay da animação aleatórios
                const duration = Math.random() * 15 + 10;
                const delay = Math.random() * 5;
                particle.style.animation = `float-particle ${duration}s linear ${delay}s infinite`;

                // Opacidade aleatória
                particle.style.opacity = Math.random() * 0.3 + 0.1;

                particlesContainer.appendChild(particle);
            }
        }

        // Efeito parallax para a imagem
        function setupParallax() {
            const heroImage = document.querySelector('.hero-image img');

            window.addEventListener('scroll', function() {
                const scrollPosition = window.pageYOffset;
                heroImage.style.transform = `translateY(${scrollPosition * 0.3}px)`;
            });
        }

        // Inicializa tudo quando a página carregar
        window.addEventListener('load', function() {
            createParticles();
            setupParallax();

            // Efeito de hover na imagem
            const heroImg = document.querySelector('.hero-image img');
            heroImg.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.03)';
            });

            heroImg.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    </script>
</body>

</html>