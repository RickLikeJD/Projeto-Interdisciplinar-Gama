<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecoway - Ecoturismo</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
  
  <!-- CSS customizado -->
  <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>

  <!-- Header -->
  <?php include 'header2.php'; ?>

  <!-- Hero Section -->
  <section class="hero d-flex align-items-center text-center text-white" style="background: url('img/natureza.jpg') no-repeat center center/cover; min-height: 90vh;">
    <div class="container">
      <h1 class="display-3 fw-bold">Explore a Natureza com a Ecoway</h1>
      <p class="lead">Descubra aventuras inesquecíveis em meio à natureza.</p>
      <a href="aventuras.php" class="btn btn-success btn-lg mt-3">Comece Agora</a>
    </div>
  </section>
    <!-- Primeiro bloco: imagem à esquerda, texto à direita -->
 <section class="hero">
  <div class="hero-content">
    <h1>Conecte-se com a Natureza em Experiências Únicas</h1>
    <p>
      Descubra roteiros de ecoturismo, trilhas guiadas e aventuras sustentáveis 
      que aproximam você da natureza de forma responsável e memorável.
    </p>
   <div class="hero-text" >
      <ul>
      <li>Passeios ecológicos pensados para todos os níveis de aventureiros.</li>
      <li>Experiências autênticas em meio à natureza preservada.</li>
      <li>Guias especializados para sua segurança e conhecimento.</li>
      <li>Práticas sustentáveis que respeitam o meio ambiente.</li>
      </ul>
   </div>
    <a href="#servicos" class="btn">Explore Nossas Aventuras</a>
  </div>
  <div class="hero-image">
    <img src="../img/praçadobommenino.jpg" alt="Ecoturismo em meio à natureza">
  </div>
</section>


  <!-- Seção de Categorias -->
  <section class="categorias py-5 text-center">
    <div class="container">
      <h2 class="mb-4">Nossas Experiências</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <img src="../img/jansen.jfif" class="card-img-top" alt="Trilhas">
            <div class="card-body">
              <h3 class="card-title">Trilhas</h3>
              <p class="card-text">Caminhe por rotas incríveis e conecte-se com a natureza.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <img src="../img/camping.jpg" class="card-img-top" alt="Acampamentos">
            <div class="card-body">
              <h3 class="card-title">Acampamentos</h3>
              <p class="card-text">Durma sob as estrelas em lugares paradisíacos.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <img src="../img/poço.webp" class="card-img-top" alt="Banhos">
            <div class="card-body">
              <h3 class="card-title">Banhos</h3>
              <p class="card-text">banhos em cachoeiras e lagoas paradisíacas.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


<!-- Tira essa porra do footer e coloca em um botao de 3 pontinhos like-->
  <!-- CTA -->
  <section class="cta text-center text-white py-5" style="background: #2ecc71;">
    <div class="container">
      <h2 class="mb-3">Pronto para sua próxima aventura?</h2>
      <a href="login.php" class="btn btn-light btn-lg">Reserve agora</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2025 Ecoway - Todos os direitos reservados</p>
  </footer>

  <!-- Scripts Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 