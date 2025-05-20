<?php require_once('template/topo.php') ?>

<body>
  <!-- inicio Menu-->
  <?php require_once('template/menu.php'); ?>


  <!-- inicio do conteudo -->
  <main>
    <!-- para todos -->
    <section class="gelatos-para-todos"  style="height: 550px;" >
      <div class="imagem-gelatos"></div>
      <div class="container-gelatos">
        <div class="texto-gelatos">
          <h2>Sabores para todos os gosto</h2>
          <p id="texto-animado"></p>
        </div>
      </div>
    </section>

    <!-- Seção Galeria de Gelatos -->
    <?php require_once('template/galeria.php'); ?>
  </main>


  <!-- Seção Rodapé -->
  <?php require_once('template/rodape.php'); ?>
</body>

</html>