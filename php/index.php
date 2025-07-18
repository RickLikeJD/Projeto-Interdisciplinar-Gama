<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/estilo.css">

<section id="trilhas" class="trails-section">
  <h2>Nossas Trilhas Populares</h2>
  <div class="trails-grid">
    <div class="trail-card">
      <img src="../img/ponteitapiraco.jpg" alt="Trilha 1">
      <h3>Trilhas da reserva do Itapiracó</h3>
      <p>Nível: Fácil | Distância: 6.3km | Duração: 1.28 horas</p>
      <a href="http://localhost/gama/php/itapiraco.php" class="button secondary">Detalhes</a>
    </div>
    <div class="trail-card">
      <img src="../img/praçadobommenino.jpg" alt="Trilha 2">
      <h3>Tilhas do Parque do Bom menino</h3>
      <p>Nível: Fácil | Distância:  2,96km | Duração: 45 Minutos</p>
      <a href="http://localhost/gama/php/parquebommenino.php" class="button secondary">Detalhes</a>
    </div>
    <div class="trail-card">
      <img src="https://via.placeholder.com/350x200/228B22/FFFFFF?Text=Trilha+3" alt="Trilha 3">
      <h3>Travessia da Mata Atlântica</h3>
      <p>Nível: Difícil | Distância: 12km | Duração: 6 horas</p>
      <a href="#" class="button secondary">Detalhes</a>
    </div>
  </div>
  <div class="view-all">
    <a href="#">Ver Todas as Trilhas</a>
  </div>
</section>

<section id="sobre" class="about-section">
  <h2>Sobre Nós</h2>
  <p>Bem-vindo ao guia de trilhas florestais de São Luís! Nosso objetivo é conectar os amantes da natureza com as incríveis trilhas que nossa região tem a oferecer...</p>
</section>

<section id="contato" class="contact-section">
  <h2>Entre em Contato</h2>
  <p>Tem alguma dúvida ou sugestão? Entre em contato conosco!</p>
  <form action="index.php#contato" method="POST">
    <div class="form-group">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="mensagem">Mensagem:</label>
      <textarea id="mensagem" name="mensagem" rows="5" required></textarea>
    </div>
    <button type="submit" class="button">Enviar Mensagem</button>
  </form>

  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $nome = htmlspecialchars($_POST["nome"]);
      $email = htmlspecialchars($_POST["email"]);
      $mensagem = htmlspecialchars($_POST["mensagem"]);

      echo "<p><strong>Obrigado, $nome! Sua mensagem foi recebida.</strong></p>";
    }
  ?>
</section>

<?php include 'footer.php'; ?>
