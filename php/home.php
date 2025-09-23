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

  <!-- Seção de Categorias -->
  <section class="categorias py-5 text-center">
    <div class="container">
      <h2 class="mb-4">Nossas Experiências</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <img src="img/trilha.jpg" class="card-img-top" alt="Trilhas">
            <div class="card-body">
              <h3 class="card-title">Trilhas</h3>
              <p class="card-text">Caminhe por rotas incríveis e conecte-se com a natureza.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <img src="img/acampamento.jpg" class="card-img-top" alt="Acampamentos">
            <div class="card-body">
              <h3 class="card-title">Acampamentos</h3>
              <p class="card-text">Durma sob as estrelas em lugares paradisíacos.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <img src="img/rafting.jpg" class="card-img-top" alt="Rafting">
            <div class="card-body">
              <h3 class="card-title">Rafting</h3>
              <p class="card-text">Adrenalina garantida em corredeiras desafiadoras.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Benefícios -->
  <section class="beneficios bg-light py-5 text-center">
    <div class="container">
      <h2 class="mb-4">Por que escolher a Ecoway?</h2>
      <ul class="list-unstyled fs-5">
        <li>🌿 Turismo sustentável</li>
        <li>👨‍👩‍👧‍👦 Experiências para toda a família</li>
        <li>🧑‍🏫 Guias especializados</li>
        <li>⭐ Avaliação 5 estrelas</li>
      </ul>
    </div>
  </section>

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
