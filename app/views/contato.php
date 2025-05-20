<?php
if (isset($_GET['status'])) {
  switch ($_GET['status']) {
    case 'sucesso':
      echo '<div class="alert-notification success">
              <div class="alert-icon">
                <svg viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"/></svg>
              </div>
              <div class="alert-content">
                <h4>Mensagem enviada!</h4>
                <p>Sua mensagem foi recebida com sucesso.</p>
              </div>
              <div class="alert-close">&times;</div>
            </div>';
      break;
    case 'erro_email':
      echo '<div class="alert-notification error">
              <div class="alert-icon">
                <svg viewBox="0 0 24 24"><path fill="currentColor" d="M11,15H13V17H11V15M11,7H13V13H11V7M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20Z"/></svg>
              </div>
              <div class="alert-content">
                <h4>Erro no envio</h4>
                <p>Ocorreu um problema ao enviar seu email. Por favor, tente novamente.</p>
              </div>
              <div class="alert-close">&times;</div>
            </div>';
      break;
    case 'erro_banco':
      echo '<div class="alert-notification error">
              <div class="alert-icon">
                <svg viewBox="0 0 24 24"><path fill="currentColor" d="M12,3L2,12H5V20H19V12H22L12,3M13,17H11V15H13V17M13,13H11V8H13V13Z"/></svg>
              </div>
              <div class="alert-content">
                <h4>Erro no sistema</h4>
                <p>Não foi possível registrar seu contato. Por favor, tente mais tarde.</p>
              </div>
              <div class="alert-close">&times;</div>
            </div>';
      break;
  }
}
?>

<?php require_once('template/topo.php') ?>

<body class="sorveteria-theme">
  <!-- Menu -->
  <?php require_once('template/menu.php'); ?>

  <!-- Main Content -->
  <main>
    <section class="contato-section">
      <div class="container">
        <div class="contato-card">
          <!-- Elementos Decorativos -->
          <div class="decoracao left">
            <div class="cone-gelato"></div>
            <div class="fruta-decorativa"></div>
          </div>

          <div class="contato-content">
            <div class="contato-header">
              <h2><span class="decoracao-estrela">🍦</span> Fale Conosco <span class="decoracao-estrela">🍦</span></h2>
              <p class="subtitulo">Envie sua mensagem e responderemos o mais breve possível</p>
            </div>

            <form action="<?php echo BASE_URL; ?>contato/enviar" method="POST" id="contatoForm" class="formulario-elegante">
              <div class="form-row dois-campos">
                <div class="input-group">
                  <input type="text" id="nome" name="nome" required>
                  <label for="nome">Nome completo*</label>
                  <div class="underline"></div>
                </div>

                <div class="input-group">
                  <input type="tel" id="telefone" name="fone">
                  <label for="telefone">Telefone</label>
                  <div class="underline"></div>
                </div>
              </div>

              <div class="input-group full-width">
                <input type="email" id="email" name="email" required>
                <label for="email">Email*</label>
                <div class="underline"></div>
              </div>

              <div class="input-group select-group">
                <select id="assunto" name="assunto" required>
                  <option value="" disabled selected></option>
                  <option value="Dúvida">Dúvida</option>
                  <option value="Sugestão">Sugestão</option>
                  <option value="Orçamento">Orçamento</option>
                  <option value="Elogio">Elogio</option>
                  <option value="Trabalhe Conosco">Trabalhe Conosco</option>
                </select>
                <label for="assunto">Assunto*</label>
                <div class="underline"></div>
                <div class="select-arrow">
                  <svg viewBox="0 0 24 24">
                    <path fill="currentColor" d="M7,10L12,15L17,10H7Z" />
                  </svg>
                </div>
              </div>

              <div class="input-group textarea-group">
                <textarea id="mensagem" name="mensagem" rows="4" required></textarea>
                <label for="mensagem">Sua mensagem*</label>
                <div class="underline"></div>
              </div>

              <div class="form-actions">
                <button type="reset" class="btn btn-reset">
                  <svg viewBox="0 0 24 24" class="icon">
                    <path fill="currentColor" d="M12,6V9L16,5L12,1V4A8,8 0 0,0 4,12C4,13.57 4.46,15.03 5.24,16.26L6.7,14.8C6.25,13.97 6,13 6,12A6,6 0 0,1 12,6M18.76,7.74L17.3,9.2C17.74,10.04 18,11 18,12A6,6 0 0,1 12,18V15L8,19L12,23V20A8,8 0 0,0 20,12C20,10.43 19.54,8.97 18.76,7.74Z" />
                  </svg>
                  Limpar
                </button>
                <button type="submit" class="btn btn-submit">
                  <svg viewBox="0 0 24 24" class="icon">
                    <path fill="currentColor" d="M2,21L23,12L2,3V10L17,12L2,14V21Z" />
                  </svg>
                  Enviar
                </button>
              </div>
            </form>
          </div>

          <!-- Elementos Decorativos -->
          <div class="decoracao right">
            <div class="cone-gelato"></div>
            <div class="fruta-decorativa"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- inicio slogan -->
    <?php require_once('template/slogan.php'); ?>
  </main>

  <!-- Footer -->
  <?php require_once('template/rodape.php'); ?>

  <style>
    :root {
      --primary-color: #bf364f;
      --primary-light: #d94a64;
      --primary-dark: #9c2c41;
      --cream: #fff9f0;
      --gold: #d4af37;
      --text-dark: #333;
      --text-light: #777;
    }

    body.sorveteria-theme {
      font-family: 'Montserrat', 'Helvetica', sans-serif;
      background-color: var(--cream);
      color: var(--text-dark);
      line-height: 1.6;
    }

    .contato-section {
      padding: 5rem 0;
      background: url('<?= BASE_URL ?>assets/img/contato.png') no-repeat center center;
      background-size: cover;
      background-attachment: fixed;
      position: relative;
    }

    .contato-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 0;
    }

    .container {
      position: relative;
      z-index: 1;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Cartão de Contato */
    .contato-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
      padding: 3rem;
      position: relative;
      overflow: hidden;
      max-width: 900px;
      margin: 0 auto;
    }

    .contato-content {
      position: relative;
      z-index: 2;
    }

    /* Cabeçalho */
    .contato-header {
      text-align: center;
      margin-bottom: 2.5rem;
    }

    .contato-header h2 {
      color: var(--primary-color);
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      position: relative;
      display: inline-block;
    }

    .decoracao-estrela {
      color: var(--gold);
      margin: 0 10px;
      font-size: 1.8rem;
    }

    .subtitulo {
      color: var(--text-light);
      font-size: 1.1rem;
      font-weight: 400;
    }

    /* Formulário */
    .formulario-elegante {
      margin-top: 2rem;
    }

    .form-row {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .dois-campos {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .input-group {
      position: relative;
      margin-bottom: 2rem;
    }

    .full-width {
      grid-column: span 2;
    }

    .input-group label {
      position: absolute;
      top: 15px;
      left: 15px;
      color: var(--text-light);
      transition: all 0.3s ease;
      pointer-events: none;
      font-size: 1rem;
    }

    .input-group input,
    .input-group select,
    .input-group textarea {
      width: 100%;
      padding: 15px;
      border: none;
      border-bottom: 2px solid #ddd;
      background-color: transparent;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .input-group input:focus,
    .input-group select:focus,
    .input-group textarea:focus {
      outline: none;
      border-bottom-color: var(--primary-color);
    }

    .input-group input:focus+label,
    .input-group input:not(:placeholder-shown)+label,
    .input-group select:focus+label,
    .input-group select:not([value=""])+label,
    .input-group textarea:focus+label,
    .input-group textarea:not(:placeholder-shown)+label {
      top: -20px;
      left: 0;
      font-size: 0.85rem;
      color: var(--primary-color);
    }

    .underline {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--primary-color);
      transition: all 0.4s ease;
    }

    .input-group input:focus~.underline,
    .input-group select:focus~.underline,
    .input-group textarea:focus~.underline {
      width: 100%;
    }

    /* Select Personalizado */
    .select-group {
      position: relative;
    }

    .select-group select {
      appearance: none;
      padding-right: 40px;
    }

    .select-arrow {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      pointer-events: none;
      color: var(--text-light);
    }

    /* Textarea */
    .textarea-group textarea {
      min-height: 150px;
      resize: vertical;
    }

    /* Botões */
    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 15px;
      margin-top: 2rem;
    }

    .btn {
      padding: 12px 25px;
      border-radius: 50px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 1rem;
      border: none;
    }

    .btn-submit {
      background: var(--primary-color);
      color: white;
    }

    .btn-submit:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(191, 54, 79, 0.3);
    }

    .btn-reset {
      background: transparent;
      color: var(--text-light);
      border: 1px solid #ddd;
    }

    .btn-reset:hover {
      background: #f5f5f5;
      transform: translateY(-2px);
    }

    .icon {
      width: 18px;
      height: 18px;
    }

    /* Notificações */
    .alert-notification {
      position: fixed;
      top: 20px;
      right: 20px;
      width: 350px;
      padding: 15px 20px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      gap: 15px;
      z-index: 1000;
      animation: slideIn 0.5s ease-out;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .alert-notification.success {
      background: #f0f9f0;
      border-left: 4px solid #4CAF50;
      color: #2E7D32;
    }

    .alert-notification.error {
      background: #fde8e8;
      border-left: 4px solid #f44336;
      color: #c62828;
    }

    .alert-icon svg {
      width: 24px;
      height: 24px;
    }

    .alert-content h4 {
      margin: 0 0 5px 0;
      font-size: 1.1rem;
    }

    .alert-content p {
      margin: 0;
      font-size: 0.9rem;
    }

    .alert-close {
      margin-left: auto;
      cursor: pointer;
      font-size: 1.2rem;
      opacity: 0.7;
      transition: opacity 0.2s;
    }

    .alert-close:hover {
      opacity: 1;
    }

    /* Decoração */
    .decoracao {
      position: absolute;
      top: 0;
      width: 150px;
      height: 100%;
      pointer-events: none;
    }

    .decoracao.left {
      left: 0;
    }

    .decoracao.right {
      right: 0;
    }

    .cone-gelato {
      position: absolute;
      width: 80px;
      height: 100px;
      background: linear-gradient(145deg, #f5d6ab, #e8c48e);
      clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
      opacity: 0.1;
    }

    .left .cone-gelato {
      top: 20%;
      left: 10%;
      transform: rotate(-15deg);
    }

    .right .cone-gelato {
      top: 30%;
      right: 10%;
      transform: rotate(15deg);
    }

    .fruta-decorativa {
      position: absolute;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--primary-light);
      opacity: 0.1;
    }

    .left .fruta-decorativa {
      top: 50%;
      left: 20%;
    }

    .right .fruta-decorativa {
      top: 60%;
      right: 20%;
    }

    /* Animações */
    @keyframes slideIn {
      from {
        transform: translateX(100%);
        opacity: 0;
      }

      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes slideOut {
      to {
        transform: translateX(100%);
        opacity: 0;
      }
    }

    /* Responsivo */
    @media (max-width: 992px) {
      .contato-card {
        padding: 2rem;
      }

      .decoracao {
        display: none;
      }
    }

    @media (max-width: 768px) {
      .contato-header h2 {
        font-size: 2rem;
      }

      .dois-campos {
        grid-template-columns: 1fr;
      }

      .full-width {
        grid-column: span 1;
      }

      .form-actions {
        flex-direction: column;
      }

      .btn {
        width: 100%;
        justify-content: center;
      }
    }

    @media (max-width: 576px) {
      .contato-card {
        padding: 1.5rem;
        border-radius: 10px;
      }

      .alert-notification {
        width: calc(100% - 40px);
      }
    }
  </style>

  <script>
    // Máscara para telefone
    document.getElementById('telefone').addEventListener('input', function(e) {
      const x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
      e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });

    // Fechar notificações
    document.querySelectorAll('.alert-close').forEach(closeBtn => {
      closeBtn.addEventListener('click', function() {
        this.parentElement.style.animation = 'slideOut 0.5s ease-out forwards';
        setTimeout(() => {
          this.parentElement.remove();
        }, 500);
      });
    });

    // Validação do formulário
    document.getElementById('contatoForm').addEventListener('submit', function(e) {
      let isValid = true;

      // Verificar campos obrigatórios
      this.querySelectorAll('[required]').forEach(field => {
        if (!field.value.trim()) {
          field.style.borderBottomColor = '#f44336';
          isValid = false;

          // Adicionar classe de erro ao grupo
          field.closest('.input-group').classList.add('has-error');
        }
      });

      if (!isValid) {
        e.preventDefault();

        // Rolagem para o primeiro erro
        const firstError = this.querySelector('.has-error');
        if (firstError) {
          firstError.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
          });
        }
      }
    });

    // Remover erro ao digitar
    document.querySelectorAll('#contatoForm input, #contatoForm select, #contatoForm textarea').forEach(field => {
      field.addEventListener('input', function() {
        if (this.value.trim()) {
          this.style.borderBottomColor = '';
          this.closest('.input-group').classList.remove('has-error');
        }
      });
    });

    // Animar elementos ao carregar
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector('.contato-card');
      form.style.opacity = '0';
      form.style.transform = 'translateY(20px)';

      setTimeout(() => {
        form.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        form.style.opacity = '1';
        form.style.transform = 'translateY(0)';
      }, 100);
    });
  </script>
</body>

</html>