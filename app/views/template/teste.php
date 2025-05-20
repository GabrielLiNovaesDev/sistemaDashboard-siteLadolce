<!-- Seção Sobre Nós com Parallax -->
<section class="sobre-parallax-section">
    <!-- Efeito de partículas -->
    <div class="particles" id="particles-js-sobre"></div>
    
    <!-- Imagem de fundo com parallax -->
    <div class="parallax-bg" style="background-image: url('<?php echo BASE_URL; ?>assets/img/faxada.png');"></div>
    
    <!-- Overlay claro para melhor legibilidade -->
    <div class="light-overlay"></div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Card com informações -->
                <div class="sobre-card-parallax">
                    <h1 class="sobre-title">
                        Sobre Nós
                    </h1>
                    <h2 class="sobre-subtitle">
                        Tradição Italiana
                    </h2>
                    <p class="sobre-text">
                        Desde 2010, trazemos o autêntico gelato artesanal com ingredientes selecionados
                        e técnicas tradicionais da Itália para o Brasil.
                    </p>

                    <a href="<?php echo BASE_URL; ?>sobrenos" class="btn btn-outline-custom">
                        Conheça Nossa História
                        <i class="fas fa-book-open"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Estrutura da seção */
    .sobre-parallax-section {
        position: relative;
        padding: 180px 0;
        overflow: hidden;
        color: #fff;
    }
    
    /* Imagem de fundo com parallax */
    .parallax-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 120%;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        z-index: -2;
        transform: translateZ(0);
    }
    
    /* Overlay claro para melhor contraste */
    .light-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.15);
        z-index: -1;
    }
    
    /* Card de informações */
    .sobre-card-parallax {
        background: rgba(255, 255, 255, 0.92);
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        transition: all 0.4s ease;
        backdrop-filter: blur(2px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .sobre-card-parallax:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }
    
    /* Tipografia - primeira versão que você gostou */
    .sobre-title {
        font-size: 2.8rem;
        color: #333;
        margin-bottom: 15px;
        font-weight: 700;
        font-family: 'Playfair Display', serif;
    }
    
    .sobre-subtitle {
        font-size: 1.6rem;
        color: var(--vermelho-escuro);
        margin-bottom: 25px;
        font-weight: 400;
        font-style: italic;
    }
    
    .sobre-text {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 30px;
    }
    
    /* Botão com gradiente original */
    .btn-sobre {
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
    }
    
    .btn-sobre:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 25px rgba(191, 54, 79, 0.4);
        color: white;
    }
    
    .btn-sobre i {
        margin-left: 10px;
        transition: transform 0.3s ease;
    }
    
    .btn-sobre:hover i {
        transform: translateX(5px);
    }
    
    /* Partículas originais melhoradas */
    .particle {
        position: absolute;
        border-radius: 50%;
        animation: float-particle 18s linear infinite;
        z-index: 0;
        background-color: rgba(242, 160, 175, 0.3);
    }
    
    @keyframes float-particle {
        0% { 
            transform: translateY(0) translateX(0) rotate(0deg);
            opacity: 0.6;
        }
        50% { 
            transform: translateY(-80px) translateX(40px) rotate(180deg);
            opacity: 0.9;
        }
        100% { 
            transform: translateY(0) translateX(0) rotate(360deg);
            opacity: 0.6;
        }
    }
    
    /* Responsivo */
    @media (max-width: 1200px) {
        .sobre-parallax-section {
            padding: 150px 0;
        }
        
        .parallax-bg {
            background-attachment: scroll;
        }
    }
    
    @media (max-width: 992px) {
        .sobre-parallax-section {
            padding: 120px 0;
        }
        
        .sobre-card-parallax {
            padding: 40px;
        }
        
        .sobre-title {
            font-size: 2.4rem;
        }
        
        .sobre-subtitle {
            font-size: 1.4rem;
        }
    }
    
    @media (max-width: 768px) {
        .sobre-parallax-section {
            padding: 100px 0;
        }
        
        .sobre-card-parallax {
            padding: 30px;
        }
        
        .sobre-title {
            font-size: 2rem;
        }
        
        .sobre-text {
            font-size: 1.05rem;
        }
    }
</style>

<script>
    // Inicialização das partículas
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('particles-js-sobre');
        const particleCount = 25;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            const size = Math.random() * 12 + 5;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            
            const duration = Math.random() * 20 + 15;
            const delay = Math.random() * 8;
            particle.style.animation = `float-particle ${duration}s ease-in-out ${delay}s infinite`;
            
            particle.style.opacity = Math.random() * 0.3 + 0.2;
            
            container.appendChild(particle);
        }
        
        // Efeito parallax suave para dispositivos desktop
        if (window.innerWidth > 992) {
            const parallaxBg = document.querySelector('.parallax-bg');
            window.addEventListener('scroll', function() {
                const scrollPosition = window.pageYOffset;
                parallaxBg.style.transform = `translateY(${scrollPosition * 0.3}px)`;
            });
        }
    });
</script>