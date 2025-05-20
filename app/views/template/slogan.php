<!-- Brand Section - Enhanced Colors with Original Particles -->
<section class="hero-marca-section">
    <!-- Particles Effect (original) -->
    <div class="particles" id="particles-js-marca"></div>
    
    <!-- Enhanced Gradient Background -->
    <div class="enhanced-gradient-bg"></div>
    
    <!-- Main Content -->
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <!-- Logo Column -->
            <div class="col-12 text-center">
                <div class="hero-logo-container">
                    <img 
                        src="<?php echo BASE_URL; ?>assets/img/LogoMenu.png" 
                        alt="Logo da Marca" 
                        class="hero-logo-marca img-fluid"
                    />
                </div>
            </div>
        </div>
    </div>
</section>

<style>
  
    .hero-marca-section {
        position: relative;
        padding: 40px 0;
        overflow: hidden;
        background-color: #fce8ec; 
    }
    

    .enhanced-gradient-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            -45deg, 
            rgba(242, 160, 175, 0.25) 0%, 
            rgba(191, 54, 79, 0.35) 50%, 
            rgba(255, 240, 245, 0.2) 100%
        );
        background-size: 400% 400%;
        animation: gradientAnimation 12s ease infinite;
        z-index: -1;
    }

    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }


    .hero-logo-container {
        padding: 3rem;
        display: inline-block;
        transition: all 0.4s ease;
        position: relative;
        z-index: 2;
        background: rgba(255, 255, 255, 0.85);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(191, 54, 79, 0.4);
    }


    .hero-logo-marca {
        max-height: 250px;
        width: auto;
        filter: drop-shadow(0 4px 12px rgba(191, 54, 79, 0.3));
        transition: all 0.4s ease;
    }

    .hero-logo-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(191, 54, 79, 0.5);
    }

    .hero-logo-container:hover .hero-logo-marca {
        filter: drop-shadow(0 8px 20px rgba(191, 54, 79, 0.4));
        transform: scale(1.05);
    }

    .particle {
        position: absolute;
        background-color: rgba(242, 160, 175, 0.4);
        border-radius: 50%;
        animation: float-particle 15s linear infinite;
    }
    
    @keyframes float-particle {
        0% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-50px) translateX(20px); }
        100% { transform: translateY(0) translateX(0); }
    }


    @media (max-width: 1200px) {
        .hero-marca-section {
            padding: 120px 0;
        }
        
        .hero-logo-marca {
            max-height: 200px;
        }
    }

    @media (max-width: 992px) {
        .hero-marca-section {
            padding: 100px 0;
        }
        
        .hero-logo-marca {
            max-height: 180px;
        }
    }

    @media (max-width: 768px) {
        .hero-marca-section {
            padding: 80px 0;
        }
        
        .hero-logo-marca {
            max-height: 150px;
        }
    }

    @media (max-width: 576px) {
        .hero-marca-section {
            padding: 60px 0;
        }
        
        .hero-logo-marca {
            max-height: 120px;
        }
    }
</style>

<script>
   
    document.addEventListener('DOMContentLoaded', function() {
       
        function createMarcaParticles() {
            const container = document.getElementById('particles-js-marca');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
               
                const size = Math.random() * 5 + 3;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
               
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                
                const duration = Math.random() * 15 + 10;
                const delay = Math.random() * 3;
                particle.style.animation = `float-particle ${duration}s ease-in-out ${delay}s infinite`;
                
               
                const colors = ['rgba(242, 160, 175, 0.4)', 'rgba(191, 54, 79, 0.3)'];
                particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                particle.style.opacity = Math.random() * 0.4 + 0.2;
                
                container.appendChild(particle);
            }
        }
        
        createMarcaParticles();
    });
</script>