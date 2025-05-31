<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/estilo.css">

<section id="trilhas" class="trails-section py-5">
  <div class="container">
    <h2 class="text-center mb-5">Nossas Trilhas Populares</h2>
    <div class="row d-flex align-items-stretch">
      <!-- Card 1 -->
      <div class="col-md-4 mb-4">
        <div class="card trail-card">
          <img src="../img/ponteitapiraco.jpg" class="card-img-top" alt="Trilha da reserva do Itapiracó">
          <div class="card-body ">
            <h5 class="card-title">Trilhas da reserva do Itapiracó</h5>
            <p class="card-text">Nível: Fácil | Distância: 6.3km | Duração: 1.28 horas</p>
            <a href="http://localhost/projeto-interdisciplinar/php/itapiraco.php" class="btn btn-primary mt-auto">Detalhes</a>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-4 mb-4">
        <div class="card trail-card">
          <img src="../img/praçadobommenino.jpg" class="card-img-top" alt="Trilhas do Parque do Bom menino">
          <div class="card-body">
            <h5 class="card-title">Trilhas do Parque do Bom Menino</h5>
            <p class="card-text">Nível: Fácil | Distância: 2,96km | Duração: 45 Minutos</p>
            <a href="http://localhost/projeto-interdisciplinar/php/parquebommenino.php" class="btn btn-primary mt-auto">Detalhes</a>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-4 mb-4">
        <div class="card trail-card">
          <img src="../img/rangedor.jpeg" alt="Parque do Rangedor">
          <div class="card-body ">
            <h5 class="card-title">Parque do Rangedor</h5>
            <p class="card-text">Nível: Fácil | Distância: 3.8km | Duração: 55 Minutos</p>
            <a href="http://localhost/projeto-interdisciplinar/php/rangedor.php" class="btn btn-primary mt-auto">Detalhes</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Ver todas as trilhas -->
    <div class="text-center mt-4">
      <a href="#" class="btn btn-outline-secondary">Ver Todas as Trilhas</a>
    </div>
  </div>
</section>

<section id="sobre" class="about-section py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4">Sobre Nós</h2>
    <p class="text-center">Bem-vindo ao guia de trilhas florestais de São Luís! Nosso objetivo é conectar os amantes da natureza com as incríveis trilhas que nossa região tem a oferecer...</p>
  </div>
</section>

<section id="contato" class="contact-section py-5">
  <div class="container">
    <h2 class="text-center mb-4">Entre em Contato</h2>
    <p class="text-center">Tem alguma dúvida ou sugestão? Entre em contato conosco!</p>
    <form action="http://localhost/projeto-interdisciplinar/php/gamainicial.php#contato" method="POST" class="mx-auto" style="max-width: 600px;">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" id="nome" name="nome" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="mensagem" class="form-label">Mensagem:</label>
        <textarea id="mensagem" name="mensagem" rows="5" class="form-control" required></textarea>
      </div>
      <button type="submit" class="btn btn-success">Enviar Mensagem</button>
    </form>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = htmlspecialchars($_POST["nome"]);
        $email = htmlspecialchars($_POST["email"]);
        $mensagem = htmlspecialchars($_POST["mensagem"]);

        echo "<p class='text-success mt-3'><strong>Obrigado, $nome! Sua mensagem foi recebida.</strong></p>";
      }
    ?>
  </div>
</section>

<?php include 'footer.php'; ?>
