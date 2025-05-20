<!-- Seção Nosso Sonho - Design de Carta -->
<section class="letter-section position-relative">
    <!-- Efeito de partículas -->
    <div class="particles" id="particles-js-sonho"></div>
    
    <!-- Gradiente animado -->
    <!-- <div class="gradient-bg-premium"></div> -->
    
    <div class="container-lg py-5">
        <div class="letter-wrapper">
            <!-- Envelope -->
            <div class="envelope">
                <!-- Carta -->
                <div class="letter">
                    <div class="letter-content">
                        <div class="letter-decoration"></div>
                        
                        <h1 class="letter-title">
                            <span class="text-highlight">Nosso Sonho</span>
                        </h1>
                        
                        <div class="letter-text">
                            <p>
                                Nosso sonho é levar a <strong>autêntica experiência do gelato italiano</strong>
                                para todos, com sabores que encantam e momentos que transformam.
                            </p>
                            
                            <p>
                                Queremos ser parte das suas <strong>memórias mais doces</strong>, criando conexões através do prazer de um verdadeiro gelato artesanal.
                            </p>
                            
                            <div class="letter-signature">
                                <p>Com carinho,</p>
                                <p class="signature-name">Família LaDolce</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Selo -->
                    <div class="letter-seal">
                        <svg viewBox="0 0 100 100" width="60" height="60">
                            <circle cx="50" cy="50" r="45" fill="rgba(242,160,175,0.8)"/>
                            <text x="50" y="55" text-anchor="middle" font-family="'Playfair Display', serif" font-size="14" fill="#fff">La Dolce</text>
                        </svg>
                    </div>
                </div>
                
                <!-- Imagem (como foto dentro da carta) -->
                <div class="letter-photo">
                    <img src="<?php echo BASE_URL; ?>assets/img/sonho.png" 
                         alt="Nosso Sonho" 
                         class="img-fluid"
                         loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Efeitos de Fundo */
    .gradient-bg-premium {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(242,160,175,0.2) 0%, rgba(191,54,79,0.1) 100%);
        background-size: 200% 200%;
        animation: gradientAnimation 8s ease infinite;
        z-index: 0;
    }
    
    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
    }
    
    .particle {
        position: absolute;
        border-radius: 50%;
        animation: float-particle 15s ease-in-out infinite;
    }
    
    @keyframes float-particle {
        0% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-100px) translateX(50px); }
        100% { transform: translateY(0) translateX(0); }
    }
    
    /* Design da Carta */
    .letter-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 500px;
        perspective: 1000px;
    }
    
    .envelope {
        position: relative;
        width: 100%;
        max-width: 800px;
        background: #f9f5f0;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        padding: 30px;
        transition: all 0.5s ease;
    }
    
    .envelope:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }
    
    .letter {
        position: relative;
        background-color: #fff;
        padding: 40px;
        border-radius: 4px;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.5s ease;
    }
    
    .letter-content {
        position: relative;
    }
    
    .letter-decoration {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><text x="10" y="50" font-family="Arial" font-size="10" fill="rgba(242,160,175,0.05)">La Dolce Gelato</text></svg>');
        opacity: 0.1;
        z-index: 0;
    }
    
    .letter-title {
        font-family: 'Playfair Display', serif;
        color: #333;
        font-size: 2.5rem;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .letter-title .text-highlight {
        position: relative;
        display: inline-block;
    }
    
    .letter-title .text-highlight::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 0;
        width: 100%;
        height: 8px;
        background-color: rgba(242, 160, 175, 0.3);
        z-index: -1;
    }
    
    .letter-text {
        position: relative;
        z-index: 1;
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
    }
    
    .letter-text p {
        margin-bottom: 1.5rem;
    }
    
    .letter-text strong {
        color: var(--vermelho-escuro);
        font-weight: 600;
    }
    
    .letter-signature {
        margin-top: 3rem;
        padding-top: 1.5rem;
        border-top: 1px dashed rgba(191, 54, 79, 0.3);
        font-family: 'Playfair Display', serif;
        font-style: italic;
        color: var(--vermelho-escuro);
    }
    
    .signature-name {
        font-size: 1.5rem;
        margin-top: 0.5rem;
    }
    
    /* Selo da carta */
    .letter-seal {
        position: absolute;
        top: -30px;
        right: -30px;
        filter: drop-shadow(0 3px 5px rgba(0,0,0,0.2));
        transform: rotate(15deg);
        transition: all 0.3s ease;
        z-index: 2;
    }
    
    .letter:hover .letter-seal {
        transform: rotate(25deg) scale(1.1);
    }
    
    /* Foto na carta */
    .letter-photo {
        margin-top: 30px;
        padding: 15px;
        background: #fff;
        border-radius: 4px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        display: inline-block;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .letter-photo img {
        max-width: 100%;
        height: auto;
        border-radius: 2px;
        transition: transform 0.3s ease;
    }
    
    .letter-photo:hover img {
        transform: scale(1.03);
    }
    
    /* Responsivo */
    @media (max-width: 992px) {
        .letter {
            padding: 30px;
        }
        
        .letter-title {
            font-size: 2rem;
        }
    }
    
    @media (max-width: 768px) {
        .letter {
            padding: 25px;
        }
        
        .letter-title {
            font-size: 1.8rem;
        }
        
        .letter-text {
            font-size: 1rem;
        }
        
        .signature-name {
            font-size: 1.3rem;
        }
        
        .letter-seal {
            width: 50px;
            height: 50px;
            top: -25px;
            right: -25px;
        }
    }
</style>

<script>
    // Sistema de Partículas
    function createSonhoParticles() {
        const particlesContainer = document.getElementById('particles-js-sonho');
        const particleCount = window.innerWidth < 768 ? 15 : 25;
        
        const colors = [
            'rgba(242, 160, 175, 0.6)', 
            'rgba(191, 54, 79, 0.5)',
            'rgba(255, 240, 245, 0.4)'
        ];
        
        particlesContainer.innerHTML = '';
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            const size = Math.random() * 10 + 3;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            
            const duration = Math.random() * 20 + 10;
            const delay = Math.random() * 5;
            particle.style.animation = `float-particle ${duration}s ease-in-out ${delay}s infinite`;
            
            particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            particle.style.opacity = Math.random() * 0.5 + 0.3;
            
            particlesContainer.appendChild(particle);
        }
    }

    // Inicialização
    window.addEventListener('load', function() {
        createSonhoParticles();
        window.addEventListener('resize', createSonhoParticles);
    });
</script>