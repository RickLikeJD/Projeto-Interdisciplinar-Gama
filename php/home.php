<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecoway - Conexão Natural</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="../css/estiloinicial.css">
</head>
<body>

  <?php include 'header2.php'; ?>

  <div class="container main-container">
    
    <section class="hero">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <span class="badge-eco">Ecoturismo Premium</span>
          <h1>Conecte-se com a <br>Natureza Real.</h1>
          <p>Descubra roteiros exclusivos, trilhas guiadas e aventuras sustentáveis que aproximam você da natureza de forma responsável.</p>
          
          <ul class="hero-list">
            <li><span class="material-icons">check_circle</span> Guias especializados e locais.</li>
            <li><span class="material-icons">check_circle</span> Roteiros 100% sustentáveis.</li>
            <li><span class="material-icons">check_circle</span> Segurança e exclusividade.</li>
          </ul>

          <a href="aventuras.php" class="btn-eco">Explorar Roteiros</a>
        </div>
        
        <div class="col-lg-6">
          <div class="hero-carousel-wrapper">
              <div class="swiper hero-swiper">
                <div class="swiper-wrapper">
                  
                  <div class="swiper-slide">
                    <img src="../img/praçadobommenino.jpg" alt="Parque Bom Menino">
                  </div>
                  
                  <div class="swiper-slide">
                      <img src="../img/jansen.jfif" alt="Lagoa da Jansen">
                  </div>
                  
                  <div class="swiper-slide">
                      <img src="../img/camping.jpg" alt="Camping">
                  </div>

                  <div class="swiper-slide">
                      <img src="../img/poço.webp" alt="Banho Natural">
                  </div>

                </div>
                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <section class="intro-section">
      <div class="row align-items-center reverse-mobile g-5">
        <div class="col-lg-6">
           <img src="../img/carolina.webp" alt="Carolina" class="img-intro img-fluid"> 
        </div>
        <div class="col-lg-6">
          <h2 class="section-title">Por que a Ecoway?</h2>
          <p>A Ecoway nasceu com o propósito de tornar o contato com a natureza mais acessível, seguro e transformador. Nosso compromisso é oferecer experiências que unam aventura e responsabilidade ambiental.</p>
          <p>Valorizamos cada detalhe das vivências ao ar livre: da escolha dos roteiros à capacitação de nossos guias, tudo é planejado para que você explore lugares únicos com tranquilidade.</p>
        </div>
      </div>
    </section>

    <section class="py-5 my-5">
      <div class="section-header-wrapper">
        <h2 class="section-title-decor">Nossas Experiências</h2>
        <p style="font-size: 1.2rem; color: #666;">Escolha o seu próximo destino inesquecível</p>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="card-eco">
            <div class="card-img-wrapper">
              <img src="../img/jansen.jfif" alt="Trilhas">
            </div>
            <div class="card-body">
              <h3 class="card-title">Trilhas</h3>
              <p class="card-text">Caminhe por rotas incríveis e descubra paisagens inexploradas.</p>
              <a href="#" class="link-arrow">Ver detalhes</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card-eco">
            <div class="card-img-wrapper">
               <img src="../img/camping.jpg" alt="Acampamentos">
            </div>
            <div class="card-body">
              <h3 class="card-title">Acampamentos</h3>
              <p class="card-text">Durma sob as estrelas com toda segurança e conforto.</p>
              <a href="#" class="link-arrow">Ver detalhes</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card-eco">
            <div class="card-img-wrapper">
              <img src="../img/poço.webp" alt="Banhos">
            </div>
            <div class="card-body">
              <h3 class="card-title">Banhos Naturais</h3>
              <p class="card-text">Renove as energias em cachoeiras e lagoas cristalinas.</p>
              <a href="#" class="link-arrow">Ver detalhes</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="cta-banner">
      <h2>Pronto para sua próxima aventura?</h2>
      <p>Junte-se a milhares de exploradores conscientes.</p>
      <a href="login.php" class="btn-white">Reservar Agora</a>
    </section>

  </div> <div class="fab-container">
    <div class="fab-menu" id="fabMenu">
      <a href="#"><span class="material-icons">info</span> Sobre Nós</a>
      <a href="#"><span class="material-icons">support_agent</span> Contato</a>
      <hr>
      <div style="text-align:center; font-size:0.8rem; color:#888;">Ecoway © 2025</div>
    </div>
    <button class="fab-btn" onclick="toggleFab()">
      <span class="material-icons" id="fabIcon">more_horiz</span>
    </button>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".hero-swiper", {
      slidesPerView: 1,
      spaceBetween: 0,
      loop: true,
      effect: "slide",
      speed: 600,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });

    // Função do Menu Flutuante
    function toggleFab() {
      const menu = document.getElementById('fabMenu');
      const icon = document.getElementById('fabIcon');
      if (menu.style.display === 'block') {
        menu.style.display = 'none';
        icon.innerText = 'more_horiz';
      } else {
        menu.style.display = 'block';
        icon.innerText = 'close';
      }
    }
  </script>

</body>
</html>