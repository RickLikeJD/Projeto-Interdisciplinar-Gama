<?php
// Inicia a sessão ANTES de qualquer HTML
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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    :root {
      --primary: #163a2b;       /* Verde Escuro */
      --primary-hover: #0e291e; 
      --bg-body: #faf9f6;       /* Creme Suave */
      --text-main: #2d3330;
      --radius: 16px;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--bg-body);
      color: var(--text-main);
      overflow-x: hidden; /* Evita rolagem lateral */
    }

    /* === HERO SECTION (CAPA) === */
    .hero {
      padding: 60px 0; /* Espaçamento vertical */
      display: flex;
      align-items: center;
      min-height: 80vh; /* Ocupa quase a tela toda */
    }

    .badge-eco {
      background-color: #e8f5e9;
      color: var(--primary);
      padding: 6px 14px;
      border-radius: 30px;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.8rem;
      letter-spacing: 1px;
      margin-bottom: 20px;
      display: inline-block;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 700;
      line-height: 1.2;
      color: var(--primary);
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 1.1rem;
      color: #666;
      margin-bottom: 30px;
      max-width: 500px;
    }

    /* Lista Personalizada */
    .hero-list {
      list-style: none;
      padding: 0;
      margin-bottom: 30px;
    }

    .hero-list li {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 12px;
      font-size: 1rem;
      font-weight: 500;
    }

    .hero-list .material-icons {
      color: var(--primary);
      font-size: 22px;
    }

    /* Botão Principal */
    .btn-eco {
      background-color: var(--primary);
      color: #fff;
      padding: 15px 35px;
      border-radius: 50px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s;
      display: inline-block;
      border: none;
    }

    .btn-eco:hover {
      background-color: var(--primary-hover);
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(22, 58, 43, 0.2);
      color: #fff;
    }

    /* Imagens com cantos arredondados e sombra */
    .img-hero, .img-intro {
      border-radius: var(--radius);
      box-shadow: 0 20px 40px rgba(0,0,0,0.1);
      width: 100%;
      object-fit: cover;
    }
    
    .img-hero { height: 500px; } /* Altura fixa pra ficar bonito */

    /* === SEÇÃO INTRO (SOBRE) === */
    .intro-section { padding: 80px 0; }
    
    .section-title {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 20px;
    }

    /* === CARDS === */
    .card-eco {
      border: none;
      border-radius: var(--radius);
      background: #fff;
      transition: all 0.3s;
      height: 100%;
      border: 1px solid #eee;
    }

    .card-eco:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
      border-color: var(--primary);
    }

    .card-img-wrapper {
      height: 250px;
      overflow: hidden;
      border-top-left-radius: var(--radius);
      border-top-right-radius: var(--radius);
    }

    .card-eco img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s;
    }

    .card-eco:hover img { transform: scale(1.1); }

    .card-body { padding: 25px; }
    .card-title { font-weight: 700; color: var(--primary); margin-bottom: 10px; }
    .link-arrow { color: var(--primary); font-weight: 600; text-decoration: none; }

    /* === BANNER FINAL (CTA) === */
    .cta-banner {
      /* Ajuste o caminho da imagem se necessário */
      background: linear-gradient(rgba(22, 58, 43, 0.85), rgba(22, 58, 43, 0.7)), url('../img/camping.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed; /* Efeito Parallax */
      padding: 100px 20px;
      text-align: center;
      color: #fff;
      border-radius: var(--radius);
      margin: 50px 0 100px 0; /* Margem em baixo pro menu flutuante */
    }

    .btn-white {
      background: #fff;
      color: var(--primary);
      padding: 15px 40px;
      border-radius: 50px;
      font-weight: 700;
      text-decoration: none;
      display: inline-block;
      margin-top: 20px;
      transition: all 0.3s;
    }

    .btn-white:hover {
      background: #f1f1f1;
      transform: scale(1.05);
      color: var(--primary);
    }

    /* Menu Flutuante */
    .fab-container { position: fixed; bottom: 30px; right: 30px; z-index: 1000; display: flex; flex-direction: column; align-items: flex-end; }
    .fab-btn { width: 60px; height: 60px; background-color: var(--primary); color: #fff; border-radius: 50%; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: transform 0.3s; }
    .fab-btn:hover { transform: scale(1.1); }
    .fab-menu { display: none; background: #fff; padding: 20px; border-radius: 12px; width: 220px; margin-bottom: 15px; box-shadow: 0 5px 25px rgba(0,0,0,0.15); }
    .fab-menu a { display: block; padding: 8px 0; color: var(--text-main); text-decoration: none; display: flex; align-items: center; gap: 10px; }
    .fab-menu a:hover { color: var(--primary); }

    /* Responsivo */
    @media (max-width: 991px) {
      .hero { text-align: center; display: block; padding-top: 40px;}
      .hero h1 { font-size: 2.5rem; }
      .hero p { margin: 0 auto 30px auto; }
      .hero-list { display: inline-block; text-align: left; margin-bottom: 40px;}
      .img-hero { margin-top: 30px; height: auto; }
      .row.reverse-mobile { flex-direction: column-reverse; } /* Para intro */
    }
  </style>
</head>
<body>

  <?php include 'header2.php'; ?>

  <div class="container">
    
    <section class="hero">
      <div class="row align-items-center">
        <div class="col-lg-6">
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
          <img src="../img/praçadobommenino.jpg" alt="Natureza" class="img-hero">
        </div>
      </div>
    </section>

    <section class="intro-section">
      <div class="row align-items-center reverse-mobile g-5">
        <div class="col-lg-6">
           <img src="../img/carolina.webp" alt="Carolina" class="img-intro"> 
        </div>
        <div class="col-lg-6">
          <h2 class="section-title">Por que a Ecoway?</h2>
          <p>A Ecoway nasceu com o propósito de tornar o contato com a natureza mais acessível, seguro e transformador. Nosso compromisso é oferecer experiências que unam aventura e responsabilidade ambiental.</p>
          <p>Valorizamos cada detalhe das vivências ao ar livre: da escolha dos roteiros à capacitação de nossos guias, tudo é planejado para que você explore lugares únicos com tranquilidade.</p>
        </div>
      </div>
    </section>

    <section class="py-5">
      <div class="text-center mb-5">
        <h2 class="section-title">Nossas Experiências</h2>
        <p>Escolha o seu próximo destino</p>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="card-eco">
            <div class="card-img-wrapper">
              <img src="../img/jansen.jfif" alt="Trilhas">
            </div>
            <div class="card-body">
              <h3 class="card-title">Trilhas</h3>
              <p>Caminhe por rotas incríveis e descubra paisagens inexploradas.</p>
              <a href="#" class="link-arrow">Ver detalhes →</a>
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
              <p>Durma sob as estrelas com toda segurança e conforto.</p>
              <a href="#" class="link-arrow">Ver detalhes →</a>
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
              <p>Renove as energias em cachoeiras e lagoas cristalinas.</p>
              <a href="#" class="link-arrow">Ver detalhes →</a>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
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