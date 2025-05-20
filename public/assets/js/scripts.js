document.getElementById('voltar-topo').addEventListener('click', function (event) {
  event.preventDefault(); // Impede o comportamento padrão do link

  // Rola suavemente até o topo da página
  window.scrollTo({
    top: 0,
    behavior: 'smooth',
  });
});


document.querySelectorAll(".menu__item").forEach(function (item) {
  item.addEventListener("click", function (event) {
    // Impede o comportamento padrão do link
    event.preventDefault();

    // Obtém o destino do link
    const target = this.getAttribute("href");

    // Verifica se o link é uma âncora
    if (target.startsWith("#")) {
      // Fecha o menu após um pequeno atraso
      setTimeout(() => {
        document.getElementById("menu__toggle").checked = false;
      }, 300); // Ajuste o tempo conforme necessário

      // Rola suavemente até a seção
      const section = document.querySelector(target);
      if (section) {
        section.scrollIntoView({ behavior: "smooth" });
      }
    } else {
      // Redireciona para outra página
      window.location.href = target;
    }
  });
});

window.addEventListener("scroll", function () {
  const cabecalho = document.querySelector(".cabecalho");
  if (window.scrollY > 100) {
    // Ajuste o valor conforme necessário
    cabecalho.classList.add("scrolled");
  } else {
    cabecalho.classList.remove("scrolled");
  }
});

document.addEventListener("DOMContentLoaded", function () {
  // Opções para o efeito de digitação
  var elementosTexto = {
    strings: [
      "Experimente os sabores mais incríveis da cidade!",
      "Sorvetes artesanais feitos com ingredientes selecionados.",
      "Uma experiência única para seu paladar.",
    ],
    typeSpeed: 50, // Velocidade de digitação
    backSpeed: 30, // Velocidade de apagar
    loop: true, // Loop infinito
    startDelay: 500, // Atraso para começar
    backDelay: 2000, // Tempo de espera antes de apagar
    showCursor: false, // Remove a barra de cursor piscante
  };

  // Inicializa o efeito de digitação no elemento #texto-animado
  if (document.querySelector("#texto-animado")) {
    var typed1 = new Typed("#texto-animado", elementosTexto);
  }
});




function moveBackground() {
  const colunaDireita = document.querySelector(".coluna-direita");

  const scrollPosition = window.scrollY; // Posição do scroll
  const maxScroll = document.body.scrollHeight - window.innerHeight; // Scroll máximo

  // Calcula o deslocamento com base no scroll
  const offset = (scrollPosition / maxScroll) * 200; // Ajuste a intensidade do movimento (200px máximo)

  // Aplica o movimento ao background-position
  colunaDireita.style.backgroundPosition = `center ${-offset}px`;

  // Chama a função novamente na próxima frame de animação
  requestAnimationFrame(moveBackground);
}

function moveBackground() {
  const imagemGelatos = document.querySelector(".imagem-gelatos");
  const scrollPosition = window.scrollY; // Posição do scroll
  const maxScroll = document.body.scrollHeight - window.innerHeight; // Scroll máximo

  // Calcula o deslocamento com base no scroll
  const offset = (scrollPosition / maxScroll) * 80; // Ajuste a intensidade do movimento (200px máximo)

  // Aplica o movimento ao background-position
  imagemGelatos.style.backgroundPosition = `center ${-offset}px`;

  // Chama a função novamente na próxima frame de animação
  requestAnimationFrame(moveBackground);
}

function moveBackground() {
  const imagemContato = document.querySelector(".contato");
  const scrollPosition = window.scrollY; // Posição do scroll
  const maxScroll = document.body.scrollHeight - window.innerHeight; // Scroll máximo

  // Calcula o deslocamento com base no scroll
  const offset = (scrollPosition / maxScroll) * 200; // Ajuste a intensidade do movimento (200px máximo)

  // Aplica o movimento ao background-position
  imagemContato.style.backgroundPosition = `center ${-offset}px`;

  // Chama a função novamente na próxima frame de animação
  requestAnimationFrame(moveBackground);
}

window.addEventListener("load", function () {
  requestAnimationFrame(moveBackground);
});




document.addEventListener("mousemove", function (event) {
  const container = document.querySelector(".imagem-nosso-sonho");
  const imagem = document.getElementById("imagem-sonho");

  if (container && imagem) {
    const containerRect = container.getBoundingClientRect();
    const mouseX = event.clientX - containerRect.left;
    const mouseY = event.clientY - containerRect.top;
    const moveX = (mouseX - containerRect.width / 5) / 50;
    const moveY = (mouseY - containerRect.height / 5) / 50;

    imagem.style.transform = `perspective(1000px) rotateY(${moveX}deg) rotateX(${-moveY}deg)`;
  }
});

document.getElementById("galeria").addEventListener("click", function (event) {
  event.preventDefault(); // Impede o comportamento padrão do link
  const secaoSabores = document.getElementById("nossos-sabores");

  // Rola suavemente até a seção
  secaoSabores.scrollIntoView({
    behavior: "smooth", // Scroll suave
    block: "start", // Alinha o topo da seção com o topo da janela
  });
});

// Função para ativar o efeito de auto-escrevendo
const ativarEfeitoTexto = (elemento) => {
  const nomeGelato = elemento.querySelector(".nome-gelato");
  nomeGelato.style.width = "100%";
};

// Função para desativar o efeito de auto-escrevendo
const desativarEfeitoTexto = (elemento) => {
  const nomeGelato = elemento.querySelector(".nome-gelato");
  nomeGelato.style.width = "0";
};

// Adiciona os event listeners aos itens da galeria
document.querySelectorAll(".item-galeria").forEach((item) => {
  item.addEventListener("mouseenter", () => ativarEfeitoTexto(item));
  item.addEventListener("mouseleave", () => desativarEfeitoTexto(item));
});
