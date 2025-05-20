<!-- Seção Nossos Gelatos - Design Polaroid Premium -->
<section id="nossos-sabores" class="position-relative py-5">
    <!-- Efeito de partículas -->
    <div class="particles" id="particles-js-sabores"></div>

    <!-- Gradiente animado -->
    <!-- <div class="gradient-bg-premium"></div> -->

    <!-- Elementos decorativos -->
    <div class="sobre-decoracao-1"></div>
    <div class="sobre-decoracao-2"></div>

    <div class="container-lg position-relative z-2">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="hero-title">
                <span class="texto-destaque">Nossos Gelatos</span>
            </h2>
            <p class="hero-text" style="max-width: 600px; margin: 0 auto;">
                Criados com ingredientes frescos e selecionados, mantendo a tradição italiana
            </p>
        </div>

        <div class="polaroid-gallery" id="galeria" data-aos="fade-up" data-aos-delay="200">
            <?php foreach ($randGaleria as $linha): ?>
                <div class="polaroid-item" style="transform: rotate(<?php echo rand(-3, 3); ?>deg)">
                    <div class="polaroid-frame">
                        <div class="polaroid-image-container">
                            <img src="<?php
                                        $caminhoImg = $_SERVER['DOCUMENT_ROOT'] . '/sistema-ladolce/public/uploads/' . $linha['imagem_sabores'];
                                        if ($linha['imagem_sabores'] != "") {
                                            if (file_exists($caminhoImg)) {
                                                echo "uploads/" . $linha['imagem_sabores'];
                                            } else {
                                                echo 'uploads/semfoto.png';
                                            }
                                        } else {
                                            echo 'uploads/semfoto.png';
                                        }
                                        ?>"
                                class="polaroid-img"
                                alt="<?php echo htmlspecialchars($linha['alt_sabores'], ENT_QUOTES, 'UTF-8'); ?>"
                                loading="lazy" />
                        </div>
                        <div class="polaroid-caption">
                            <div class="nome-gelato"><?php echo htmlspecialchars($linha['nome_sabores'], ENT_QUOTES, 'UTF-8'); ?></div>
                        </div>
                        <div class="polaroid-tape"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    /* Estrutura Base */
    #nossos-sabores {
        padding: 120px 0;
        position: relative;
        overflow: hidden;
    }

    /* Gradiente Animado */
    .gradient-bg-premium {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(-45deg, #fff9fb, #fff0f5, #ffffff, #fff9fb);
        background-size: 400% 400%;
        animation: gradientAnimation 15s ease infinite;
        z-index: -2;
        opacity: 0.9;
    }

    @keyframes gradientAnimation {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    /* Elementos Decorativos */
    .sobre-decoracao-1 {
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(242, 160, 175, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
        top: -100px;
        right: -100px;
        z-index: -1;
    }

    .sobre-decoracao-2 {
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(191, 54, 79, 0.05) 0%, rgba(255, 255, 255, 0) 70%);
        bottom: -100px;
        left: -100px;
        z-index: -1;
    }

    /* Galeria Polaroid */
    .polaroid-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
        margin: 50px auto;
        max-width: 1200px;
        padding: 20px;
    }

    /* Item Polaroid */
    .polaroid-item {
        perspective: 1000px;
        transition: transform 0.4s ease;
    }

    .polaroid-frame {
        background: white;
        padding: 20px 20px 60px;
        border-radius: 4px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        transform-style: preserve-3d;
    }

    /* Efeito de fita adesiva */
    .polaroid-tape {
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%) rotate(-2deg);
        width: 80%;
        height: 20px;
        background: rgba(255, 255, 255, 0.7);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        z-index: 1;
    }

    /* Container da Imagem */
    .polaroid-image-container {
        overflow: hidden;
        border-radius: 2px;
        margin-bottom: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .polaroid-img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    /* Legenda */
    .polaroid-caption {
        position: absolute;
        bottom: 20px;
        left: 0;
        right: 0;
        text-align: center;
        padding: 0 15px;
        height: 60px;
        overflow: hidden;
    }

    .nome-gelato {
        font-size: 1.2rem;
        color: var(--chocolate);
        font-weight: 600;
        font-family: 'Courier New', monospace;
        white-space: nowrap;
        overflow: hidden;
        width: 0;
        transition: width 0.5s ease;
        display: inline-block;
    }

    /* Efeitos de Hover */
    .polaroid-item:hover {
        transform: translateY(-10px) rotate(0deg);
    }

    .polaroid-item:hover .polaroid-frame {
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        transform: translateZ(10px);
    }

    .polaroid-item:hover .polaroid-img {
        transform: scale(1.05);
    }

    .polaroid-item:hover .nome-gelato {
        width: 100%;
    }

    /* Botão Premium */
    .btn-premium {
        background: linear-gradient(135deg, var(--rosa-claro) 0%, var(--vermelho-escuro) 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(191, 54, 79, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-premium:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(191, 54, 79, 0.4);
    }

    .btn-premium::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
    }

    /* Partículas */
    .particle {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        animation: float-particle 15s linear infinite;
    }

    @keyframes float-particle {
        0% {
            transform: translateY(0) translateX(0);
            opacity: 0.8;
        }

        50% {
            transform: translateY(-100px) translateX(20px);
            opacity: 0.4;
        }

        100% {
            transform: translateY(0) translateX(0);
            opacity: 0.8;
        }
    }

    /* Responsividade */
    @media (max-width: 1200px) {
        .polaroid-gallery {
            gap: 25px;
        }
    }

    @media (max-width: 992px) {
        .polaroid-gallery {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        .polaroid-img {
            height: 220px;
        }
    }

    @media (max-width: 768px) {
        #nossos-sabores {
            padding: 80px 0;
        }

        .polaroid-gallery {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .polaroid-img {
            height: 180px;
        }

        .nome-gelato {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 576px) {
        .polaroid-gallery {
            grid-template-columns: 1fr;
            max-width: 400px;
        }

        .polaroid-img {
            height: 250px;
        }
    }
</style>

<script>
    // Sistema de Partículas Premium
    function createSaboresParticles() {
        const particlesContainer = document.getElementById('particles-js-sabores');
        const particleCount = 25;

        const colors = [
            'rgba(242, 160, 175, 0.5)',
            'rgba(191, 54, 79, 0.4)',
            'rgba(255, 240, 245, 0.3)'
        ];

        particlesContainer.innerHTML = '';

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');

            const size = Math.random() * 8 + 3;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;

            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;

            const duration = Math.random() * 20 + 10;
            const delay = Math.random() * 5;
            particle.style.animation = `float-particle ${duration}s ease-in-out ${delay}s infinite`;

            particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            particle.style.opacity = Math.random() * 0.4 + 0.2;

            particlesContainer.appendChild(particle);
        }
    }

    // Função para mostrar/esconder o nome ao passar/remover o mouse
    document.querySelectorAll('.polaroid-item').forEach(item => {
        const nomeGelato = item.querySelector('.nome-gelato');

        item.addEventListener('mouseenter', () => {
            nomeGelato.style.width = '100%';
        });

        item.addEventListener('mouseleave', () => {
            nomeGelato.style.width = '0';
        });
    });

    // Função para rolar suavemente
    document.getElementById("galeria").addEventListener("click", function(event) {
        event.preventDefault();
        const secaoSabores = document.getElementById("nossos-sabores");

        secaoSabores.scrollIntoView({
            behavior: "smooth",
            block: "start",
        });
    });

    // Inicialização
    window.addEventListener('load', function() {
        createSaboresParticles();

        // Inicializa AOS
        if (typeof AOS !== 'undefined') {
            AOS.init({
                once: true,
                duration: 800,
                easing: 'ease-out-quart',
                offset: 120
            });
        }
    });
</script>