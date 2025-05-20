<?php require_once('template/topo.php') ?>

<body>
  <!-- Menu -->
  <?php require_once('template/menu.php'); ?>

  <!-- Main Content -->
  <main>
    <!-- Hero Section Aprimorada -->
    <section class="hero-sobre">
      <div class="hero-background"></div>

      <div class="hero-content">
        <div class="container text-center">
          <h1 class="hero-title">Sobre Nós</h1>
          <p class="hero-subtitle">Descubra a paixão e tradição por trás de cada sorvete artesanal</p>
          <div class="scroll-indicator">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M7 10L12 15L17 10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>
        </div>
      </div>
    </section>

    <!-- Sobre Conteúdo - Versão Premium -->
    <section class="sobre-conteudo">
      <div class="container">
        <div class="sobre-grid">
          <!-- Imagem com efeito -->
          <div class="sobre-imagem-wrapper" data-aos="fade-right">
            <div class="sobre-imagem">
              <img src="<?php echo BASE_URL; ?>assets/img/memorias.png" alt="História La Dolce Gelato" class="img-fluid">
              <div class="imagem-overlay"></div>
            </div>
          </div>

          <!-- Texto Sobre -->
          <div class="sobre-texto" data-aos="fade-left">
            <article class="sobre-article">
              <h2 class="section-title">
                <span class="title-line"></span>
                Quem Somos
              </h2>
              <p class="sobre-paragrafo">
                Na <strong>La Dolce Gelato</strong>, transformamos a tradição italiana em experiências memoráveis. Fundada em 2010, nossa jornada começou com um simples sonho: trazer para o Brasil a verdadeira essência do gelato artesanal. Hoje, somos referência em sorvetes premium, com:
              </p>
              <ul class="sobre-lista">
                <li><span>✔</span> Ingredientes 100% selecionados</li>
                <li><span>✔</span> Receitas tradicionais italianas</li>
                <li><span>✔</span> Produção artesanal diária</li>
                <li><span>✔</span> 12 lojas em todo o país</li>
              </ul>
            </article>

            <article class="sobre-article">
              <h2 class="section-title">
                <span class="title-line"></span>
                Nossa História
              </h2>
              <p class="sobre-paragrafo">
                A paixão pelo gelato corre em nossas veias. Em 2015, nosso fundador <strong>Giovanni Bianchi</strong> trouxe da Toscana os segredos centenários da família, combinando-os com os melhores ingredientes brasileiros. Cada sorvete é uma obra-prima que conta essa história de dedicação:
              </p>
              <div class="destaque-box">
                <p>"Não fazemos sorvetes, criamos memórias afetivas através do autêntico sabor italiano."</p>
                <small>- Giovanni Bianchi, Fundador</small>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>

    <!-- Dream Section -->
    <?php require_once('template/sonho.php'); ?>

    <!-- inicio slogan -->
    <?php require_once('template/slogan.php'); ?>
  </main>

  <!-- Footer -->
  <?php require_once('template/rodape.php'); ?>

  <style>
    :root {
      --primary: #bf364f;
      --primary-light: #d94a64;
      --secondary: #f2a0af;
      --white: #ffffff;
      --dark: #333333;
      --gray: #555555;
      --light-bg: #f9f9f9;
    }

  
    .hero-sobre {
      position: relative;
      height: 100vh;
      max-height: 800px;
      overflow: hidden;
      display: flex;
      align-items: center;
    }

    .hero-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 900vh;
      background-image: url('<?= BASE_URL ?>assets/img/faxada.png');
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      z-index: 1;
    }

    .hero-content {
      position: relative;
      z-index: 3;
      color: var(--white);
      width: 100%;
    }

    .hero-title {
      font-size: clamp(2.5rem, 5vw, 4rem);
      font-weight: 700;
      margin-bottom: 1.5rem;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
      font-family: 'Playfair Display', serif;
      letter-spacing: 1px;
    }

    .hero-subtitle {
      font-size: clamp(1.1rem, 2.5vw, 1.5rem);
      max-width: 800px;
      line-height: 1.6;
      margin: 0 auto 2rem;
      letter-spacing: 0.8px;
      text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
      font-weight: 400;
    }

    .scroll-indicator {
      margin-top: 3rem;
      animation: bounce 2s infinite;
      cursor: pointer;
    }

    @keyframes bounce {

      0%,
      20%,
      50%,
      80%,
      100% {
        transform: translateY(0);
      }

      40% {
        transform: translateY(-15px);
      }

      60% {
        transform: translateY(-10px);
      }
    }

    /* Sobre Conteúdo */
    .sobre-conteudo {
      background-color: var(--light-bg);
      padding: 6rem 0;
    }

    .sobre-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
      align-items: center;
    }

    .sobre-imagem-wrapper {
      position: relative;
      height: 100%;
    }

    .sobre-imagem {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
      height: 600px;
      position: relative;
      transition: transform 0.5s ease;
    }

    .sobre-imagem:hover {
      transform: translateY(-10px);
    }

    .sobre-imagem img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .imagem-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.3) 0%, transparent 30%);
    }

    .sobre-texto {
      padding: 0 2rem;
    }

    .section-title {
      font-size: 2.2rem;
      color: var(--primary);
      margin-bottom: 2rem;
      font-weight: 700;
      position: relative;
      padding-bottom: 15px;
      font-family: 'Playfair Display', serif;
    }

    .title-line {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 3px;
      background: var(--primary);
    }

    .sobre-paragrafo {
      font-size: 1.15rem;
      line-height: 1.9;
      color: var(--gray);
      margin-bottom: 1.8rem;
      font-family: 'Lora', serif;
    }

    .sobre-lista {
      margin: 2rem 0;
      padding-left: 1.5rem;
    }

    .sobre-lista li {
      margin-bottom: 1rem;
      font-size: 1.1rem;
      color: var(--gray);
      position: relative;
      padding-left: 2rem;
      line-height: 1.6;
    }

    .sobre-lista li span {
      position: absolute;
      left: 0;
      color: var(--primary);
      font-weight: bold;
    }

    .destaque-box {
      background: var(--white);
      border-left: 4px solid var(--primary);
      padding: 1.5rem;
      margin: 2rem 0;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      border-radius: 0 8px 8px 0;
    }

    .destaque-box p {
      font-style: italic;
      font-size: 1.2rem;
      color: var(--dark);
      margin-bottom: 0.5rem;
    }

    .destaque-box small {
      color: var(--gray);
      font-size: 0.9rem;
    }

    /* Responsividade */
    @media (max-width: 992px) {
      .sobre-grid {
        grid-template-columns: 1fr;
      }

      .sobre-imagem {
        height: 400px;
      }

      .sobre-texto {
        padding: 2rem 0 0;
      }
    }

    @media (max-width: 768px) {
      .hero-sobre {
        height: 70vh;
      }

      .hero-title {
        font-size: 2.5rem;
      }

      .section-title {
        font-size: 1.8rem;
      }

      .sobre-paragrafo {
        font-size: 1.05rem;
      }
    }

    @media (max-width: 576px) {
      .sobre-conteudo {
        padding: 4rem 0;
      }

      .sobre-imagem {
        height: 300px;
      }
    }
  </style>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Lora:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
      duration: 800,
      easing: 'ease-out-quart'
    });

    // Smooth scroll para a seção sobre
    document.querySelector('.scroll-indicator').addEventListener('click', () => {
      document.querySelector('.sobre-conteudo').scrollIntoView({
        behavior: 'smooth'
      });
    });
  </script>
</body>

</html>