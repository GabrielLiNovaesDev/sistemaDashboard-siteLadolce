<!-- Hero Section Premium Completo -->
<section class="hero-sobre-premium position-relative">
    <!-- Efeito de partículas -->
    <div class="particles" id="particles-js-premium"></div>

    <!-- Efeito de gradiente animado -->
    <!-- <div class="gradient-bg-premium"></div>
     -->
    <!-- Background Decoration -->
    <div class="sobre-decoracao-1"></div>
    <div class="sobre-decoracao-2"></div>
    
    <div class="container-lg">
        <div class="row align-items-center">
            <!-- Image Column (Lado Esquerdo) -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="hero-image position-relative" data-aos="fade-right" data-aos-duration="800">
                    <img src="<?php echo BASE_URL; ?>assets/img/teste.png"
                        alt="Baunilha Bourbon"
                        class="img-fluid rounded-4 shadow-lg gelato-image animate__animated animate__fadeIn animate__delay-1s"
                        loading="lazy">
                    
                    <!-- Award Badge -->
                    <div class="selo-premio position-absolute bottom-0 end-0 translate-middle" data-aos="fade-up" data-aos-delay="400">
                        <!-- <div class="bg-vermelho-escuro text-branco rounded-circle p-3 d-flex flex-column justify-content-center align-items-center shadow">
                            <span class="fs-2 fw-bold">1º</span>
                            <p class="mb-0 fs-7 fw-semibold text-center">Lugar</p>
                        </div> -->
                    </div>
                </div>
            </div>
            
            <!-- Text Column (Lado Direito) -->
            <div class="col-lg-6">
                <div class="hero-content-premium position-relative ps-lg-5" data-aos="fade-left" data-aos-duration="800" data-aos-delay="100">
                    <h1 class="hero-title animate__animated animate__fadeInDown">
                        Prêmio de Excelência
                    </h1>
                    <h2 class="hero-subtitle animate__animated animate__fadeInDown animate__delay-1s">
                        Melhor Sorveteria Artesanal
                    </h2>
                    
                    <p class="hero-text animate__animated animate__fadeIn animate__delay-1s">
                        La Dolce Gelataria foi eleita a <strong class="texto-destaque">melhor sorveteria artesanal</strong> de
                        2023 em teste cego do caderno Paladar/Estadão.
                    </p>
                    
                    <p class="hero-text-secondary animate__animated animate__fadeIn animate__delay-1s">
                        Com dez marcas avaliadas, destacou-se pela cremosidade e sabores intensos,
                        especialmente o <strong class="text-vermelho-escuro">Baunilha Bourbon</strong>, premiado como o melhor da
                        categoria.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
 
</section>

<style>
    /* Estrutura Base */
    .hero-sobre-premium {
        padding: 120px 0;
        overflow: hidden;
        position: relative;
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
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Conteúdo */
    .hero-content-premium {
        padding-left: 30px;
    }
    
    .hero-title {
        color: var(--vermelho-escuro);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .hero-subtitle {
        color: var(--rosa-claro);
        font-size: 1.5rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }
    
    .hero-text {
        font-size: 1.1rem;
        line-height: 1.6;
        color: var(--texto-escuro);
        margin-bottom: 1rem;
    }
    
    .hero-text-secondary {
        font-size: 1rem;
        line-height: 1.6;
        color: var(--texto-secundario);
        margin-bottom: 2rem;
    }
    
    .texto-destaque {
        background: linear-gradient(135deg, var(--rosa-claro) 0%, var(--vermelho-escuro) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        font-weight: 600;
    }
    
    /* Imagem */
    .hero-image {
       
        border-radius: 20px;
   
    }
    
    .gelato-image {
        border-radius: 12px;
        transition: transform 0.5s ease, box-shadow 0.5s ease;
        border-radius: 0 200px 0 0;
    }
    
    .hero-image:hover .gelato-image {
        transform: scale(1.03);
        box-shadow: 0 10px 30px rgba(191, 54, 79, 0.2);
    }
    
    /* Selo */
  
    
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
    
   
    /* Partículas Personalizadas */
    .particle {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        animation: float-particle 15s linear infinite;
    }
    
   
    
    @keyframes float-particle {
        0% { transform: translateY(0) translateX(0); opacity: 0.8; }
        50% { transform: translateY(-100px) translateX(20px); opacity: 0.4; }
        100% { transform: translateY(0) translateX(0); opacity: 0.8; }
    }
    
    /* Responsividade */
    @media (max-width: 992px) {
        .hero-sobre-premium {
            padding: 80px 0 100px;
        }
        
        .hero-content-premium {
            padding-left: 0 !important;
            padding-top: 2rem;
        }
        
        .hero-title {
            font-size: 2rem !important;
        }
        
        .hero-subtitle {
            font-size: 1.3rem !important;
        }
        
        .gelato-image {
            border-radius: 12px !important;
        }
    }
    
    @media (max-width: 768px) {
        .selo-premio {
            width: 80px !important;
            height: 80px !important;
        }
        
        .hero-title {
            font-size: 1.8rem !important;
        }
        
        .hero-subtitle {
            font-size: 1.2rem !important;
        }
        
        .hero-text {
            font-size: 1rem !important;
        }
        
        .hero-sobre-premium {
            padding: 60px 0 80px;
        }
        
       
    }
</style>

<script>
    // Sistema de Partículas Aprimorado
    function createPremiumParticles() {
        const particlesContainer = document.getElementById('particles-js-premium');
        const particleCount = 30;
        
        // Cores do tema
        const colors = [
            'rgba(242, 160, 175, 0.6)', 
            'rgba(191, 54, 79, 0.5)',
            'rgba(255, 240, 245, 0.4)'
        ];
        
        // Limpa partículas existentes
        particlesContainer.innerHTML = '';
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // Tamanho aleatório
            const size = Math.random() * 12 + 5;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            // Posição aleatória
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            
            // Animação personalizada
            const duration = Math.random() * 20 + 10;
            const delay = Math.random() * 5;
            particle.style.animation = `float-particle ${duration}s ease-in-out ${delay}s infinite`;
            
            // Cor aleatória
            particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            
            // Opacidade variável
            particle.style.opacity = Math.random() * 0.5 + 0.3;
            
            particlesContainer.appendChild(particle);
        }
    }

    // Inicialização
    window.addEventListener('load', function() {
        // Partículas
        createPremiumParticles();
        
        // Efeito hover na imagem
        const gelatoImage = document.querySelector('.gelato-image');
        if (gelatoImage) {
            gelatoImage.addEventListener('mouseenter', () => {
                gelatoImage.style.transform = 'scale(1.03)';
            });
            gelatoImage.addEventListener('mouseleave', () => {
                gelatoImage.style.transform = 'scale(1)';
            });
        }
        
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