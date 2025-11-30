<!doctype html>
<html lang="pt-BR">
<head>   
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Perfil</title>
  <link rel="stylesheet" href="../css/perfil.css">
</head>


<body>
  <div class="container">
    <!-- SIDEBAR: perfil resumido -->
    <aside class="card sidebar">
      <img src="../img/fotoPerfil.jpg" alt="Avatar" class="avatar">
      <h1 class="user-name">Hiago</h1>
      <p class="muted user-email">hiago@gmail.com</p>

      <div class="stats">
        <div class="stat">
          <div class="small">Km total</div>
          <div class="big">50 km</div>
        </div>
        <div class="stat">
          <div class="small">Trilhas</div>
          <div class="big">12</div>
        </div>
      </div>

      <h2 class="about-title">Sobre</h2>
      <p class="muted about-text">Sempre em busca de novas aventuras!</p>
    </aside>

    <!-- CONTEÚDO: editar perfil e trilhas -->
    <main>
      <section class="card">
        <h2 class="section-title">Editar Perfil</h2>

        <!-- Nota: action/inputs podem ser ligados ao backend -->
        <form id="form-profile" method="post" enctype="multipart/form-data" class="form-grid" data-action="/api/profile/update">
          <label for="name">Nome</label>
          <input type="text" id="name" name="name" value="" required>

          <label for="bio">Bio (curta)</label>
          <textarea id="bio" name="bio" rows="4" maxlength="800">Sempre em busca de novas aventuras!</textarea>

          <label for="avatar">Adicionar foto de perfil </label>
          <div class="file-row">
            <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png,image/webp">
            <button type="submit" class="btn">Salvar perfil</button>
          </div>

          
        </form>
      </section>

      <section class="card">
  <h2 class="section-title">Alterar senha</h2>

  <!-- BOTÃO QUE MOSTRA / ESCONDE O FORMULÁRIO -->
  <button id="btn-show-password-form" class="btn" type="button">
    Trocar senha
  </button>

  <!-- FORMULÁRIO INICIALMENTE ESCONDIDO -->
  <div id="password-form-container" style="display: none; margin-top:20px;">

    <form id="form-password" class="form-grid" 
          data-action="/api/profile/change-password" method="post">
          
      <label for="current_password">Senha atual</label>
      <input type="password" id="current_password" name="current_password" placeholder="Senha atual" required>

      <label for="new_password">Nova senha</label>
      <input type="password" id="new_password" name="new_password" placeholder="Nova senha" required>

      <label for="confirm_password">Confirmar nova senha</label>
      <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar nova senha" required>

      <div class="pw-row">
        <button type="submit" class="btn">Confirmar troca</button>
      </div>
    </form>

  </div>
</section>

      <section class="card">
        <h2 class="section-title">Minhas Trilhas (últimas 12)</h2>

        <ul class="trail-list">
          <li class="trail-item">
            <div class="trail-main">
              <div>
                <strong>Trilha das Águas</strong>
                <div class="muted small">12/03/2024</div>
              </div>
              <div class="trail-distance">5,4 km</div>
            </div>
          </li>

          <li class="trail-item">
            <div class="trail-main">
              <div>
                <strong>Morro do Cedro</strong>
                <div class="muted small">01/03/2024</div>
              </div>
              <div class="trail-distance">8,2 km</div>
            </div>
          </li>

          <!-- repita itens conforme necessário -->
        </ul>
      </section>
    </main>
  </div>

  <script>
    /* Pequena melhoria: intercepta submit e envia via fetch JSON (exemplo).
       Remova se você preferir submissão tradicional. */
    document.addEventListener('submit', function (e) {
      const form = e.target;
      if (!form.dataset.action) return; // ignora forms sem data-action
      e.preventDefault();

      const url = form.dataset.action;
      const formData = new FormData(form);

      fetch(url, { method: 'POST', body: formData })
        .then(r => r.json ? r.json() : r.text())
        .then(data => {
          // aqui você mostra mensagens na UI. Ex.: alert(JSON.stringify(data))
          console.log('Resposta do servidor:', data);
          alert('Enviado (exemplo). Integre com seu backend.');
        })
        .catch(err => {
          console.error(err);
          alert('Erro ao enviar (exemplo). Ver console.');
        });
    });
  </script>

<script>
  document.getElementById("btn-show-password-form")
    .addEventListener("click", function () {
      const box = document.getElementById("password-form-container");

      // Alterna visibilidade
      if (box.style.display === "none") {
        box.style.display = "block";
        this.textContent = "Ocultar";
      } else {
        box.style.display = "none";
        this.textContent = "Trocar senha";
      }
    });
</script>


</body>
</html>