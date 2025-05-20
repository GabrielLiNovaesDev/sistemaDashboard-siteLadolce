<footer class="rodape">
    <div class="container">
        <!-- Main Content -->
        <div class="footer-content">
            <!-- Contato Column -->
            <div class="footer-col">
                <h3>La Dolce Gelato</h3>
                <ul class="footer-contact">
                    <li><i class="fas fa-map-marker-alt"></i> Rua do Gelato, 123</li>
                    <li><i class="fas fa-phone"></i> (11) 98765-4321</li>
                    <li><i class="fas fa-envelope"></i> contato@ladolce.com</li>
                </ul>
            </div>

            <!-- Links Column -->
            <div class="footer-col">
                <h3>Menu</h3>
                <ul class="footer-links">
                    <li><a href="<?php echo BASE_URL; ?>home">Início</a></li>
                    <li><a href="<?php echo BASE_URL; ?>sobrenos">Sobre Nós</a></li>
                    <li><a href="<?php echo BASE_URL; ?>contato">Contato</a></li>
                </ul>
            </div>

            <!-- Hora Column -->
            <div class="footer-col">
                <h3>Horário</h3>
                <ul class="footer-hours">
                    <li>Seg-Sex: 10h-20h</li>
                    <li>Sábado: 11h-22h</li>
                    <li>Domingo: 11h-19h</li>
                </ul>
            </div>

            <!-- Social Column -->
            <div class="footer-col">
                <h3>Redes Sociais</h3>
                <div class="social-icons">
                    <a href="https://www.instagram.com" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/?locale=pt_BR" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.whatsapp.com/?lang=pt_BR" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="footer-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3659.025328309542!2d-46.43443702504577!3d-23.49559717884508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce63dda7be6fb9%3A0xa74e7d5a53104311!2sSenac%20S%C3%A3o%20Miguel%20Paulista!5e0!3m2!1spt-BR!2sbr!4v1746586131030!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-bottom">
        <p>&copy; 2025 La Dolce Gelato. Todos os direitos reservados. Desenvolvido por Gabriel Lima.</p>
    </div>
</footer>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    /* Base Styles */


    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    /* Content Layout */
    .footer-content {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .footer-col {
        flex: 1;
        min-width: 200px;
        padding: 0.5rem;
    }

    /* Typography */
    h3 {
        color: white;
        font-size: 1.2rem;
        margin-bottom: 1.2rem;
        font-weight: 600;
        position: relative;
        padding-bottom: 0.5rem;
    }

    h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: white;
    }

    ul {
        list-style: none;
        padding: 0;
        line-height: 1.8;
    }

    a {
        color: white;
        text-decoration: none;
        transition: all 0.2s;
    }

    a:hover {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: underline;
    }

    /* Icons */
    .fa-map-marker-alt,
    .fa-phone,
    .fa-envelope {
        width: 20px;
        color: white;
        margin-right: 10px;
        text-align: center;
    }

    /* Social Icons */
    .social-icons {
        display: flex;
        gap: 1rem;
    }

    .social-icons a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transition: all 0.2s;
    }

    .social-icons a:hover {
        background: white;
        color: var(--rosa-claro);
        transform: translateY(-2px);
    }

    /* Map */
    .footer-map {
        width: 100%;
        margin: 2rem 0;
    }

    .footer-map iframe {
        width: 100%;
        height: 250px;
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Copyright */
    .footer-bottom {
        text-align: center;
        padding: 1.5rem;
        background: rgba(0, 0, 0, 0.1);
        font-size: 0.9rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .footer-content {
            flex-direction: column;
            gap: 1.5rem;
        }

        .footer-col {
            min-width: 100%;
        }

        .footer-map iframe {
            height: 200px;
        }
    }
</style>

<!-- Your existing scripts -->
<script type="text/javascript" src="//code.jquery.com/jquery-3.7.1.min.js" defer></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-3.5.0.min.js" defer></script>
<script src="js/wow.min.js" defer></script>
<script src="<?php echo BASE_URL; ?>assets/js/scripts.js"></script>