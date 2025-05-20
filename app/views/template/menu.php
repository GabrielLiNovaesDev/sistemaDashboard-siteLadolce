<header class="cabecalho" >
    <div class="container">
        <div class="logo">
            <a href="#" id="voltar-topo">La Dolce Gelato</a>
        </div>
        <!-- Checkbox invisível para controlar o menu -->
        <input type="checkbox" id="menu__toggle" />
        <!-- Botão do menu hambúrguer -->
        <label class="menu__btn" for="menu__toggle">
            <span></span>
        </label>
        <!-- Menu de navegação -->
        <nav class="menu__box animate__animated animate__fadeInRight" id="menu">
            <ul>
                <li><a href="<?php echo BASE_URL; ?>home" class="menu__item">Início</a></li>
                <!-- <li><a href="<?php echo BASE_URL; ?>sabores" class="menu__item">Sabores</a></li> -->
                <li><a href="<?php echo BASE_URL; ?>sobrenos" class="menu__item">Sobre Nós</a></li>
                <li><a href="<?php echo BASE_URL; ?>contato" class="menu__item">Contato</a></li>
            </ul>
        </nav>
    </div> 
</header>