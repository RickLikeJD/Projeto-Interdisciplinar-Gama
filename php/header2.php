<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$currentPage = basename($_SERVER['PHP_SELF']);
$isAuthPage = in_array($currentPage, ['login.php', 'cadastro.php']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $isAuthPage ? 'Login - Gama' : 'Gama' ?></title>
  <!-- Script do header -->
  <script src="../js/scriptheader.js"></script>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS personalizado -->
  <link rel="stylesheet" href="../css/stylehed.css">

  <?php if ($isAuthPage): ?>
  <style>
    body { background: #333; color: #fff; text-align: center; }
    .navbar { display: none; }
  </style>
  <?php endif; ?>
</head>
<body>

<?php if (!$isAuthPage): ?>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="gamainicial.php">Ecoway</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCategorias" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorias
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownCategorias">
              <li><a class="dropdown-item" href="gamainicial.php">Trilhas</a></li>
              <li><a class="dropdown-item" href="#">Ficção Científica</a></li>
              <li><a class="dropdown-item" href="#">Fantasia</a></li>
              <li><a class="dropdown-item" href="#">Terror</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Ver Todas</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link <?= $currentPage=='sobre.php' ? 'active' : '' ?>" href="sobre.php">Sobre</a></li>
        <li class="nav-item"><a class="nav-link <?= $currentPage=='contato.php' ? 'active' : '' ?>" href="produtos.php">Aventuras</a></li>

        <!-- Usuário / Login -->
        <?php if (isset($_SESSION['usuario_id'])): ?>
          <li class="nav-item dropdown ms-3">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <?= htmlspecialchars($_SESSION['usuario_nome']) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
              <li><a class="dropdown-item" href="configuracoes.php">Configurações</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="logout.php">Sair</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item ms-3">
            <a class="nav-link btn btn-login" href="login.php">Login</a>
          </li>
        <?php endif; ?>

        <!-- Botão Carrinho (imagem) -->
        <li class="nav-item ms-3">
          <button class="btn btn-light p-0 border-0" onclick="abrirCarrinho()" aria-label="Abrir carrinho" style="background:none;">
            <img src="../img/carrinho.webp" alt="Carrinho" style="width:32px; height:32px;">
          </button>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div id="carrinho-overlay" class="carrinho-overlay" onclick="fecharCarrinho()"></div>

<div id="carrinho" class="carrinho" aria-hidden="true">
  <button class="fechar" onclick="fecharCarrinho()" aria-label="Fechar carrinho">&times;</button>
  <h2>Meu Carrinho</h2>
  <ul id="lista-carrinho">
    <li>Nenhum produto adicionado.</li>
  </ul>
</div>
<?php endif; ?>

<!-- Overlay (fecha se clicar fora) -->
<div id="carrinho-overlay" class="carrinho-overlay" onclick="fecharCarrinho()"></div>

<!-- Painel Carrinho (agora alinhado à direita via CSS) -->
<div id="carrinho" class="carrinho" aria-hidden="true">
  <button class="fechar" onclick="fecharCarrinho()" aria-label="Fechar carrinho">&times;</button>
  <h2>Meu Carrinho</h2>
  <ul id="lista-carrinho">
    <li>Nenhum produto adicionado.</li>
  </ul>
</div>

<script>
  // carrinho em memória (pode ser substituído por integração com servidor/ sessão)
  let carrinho = [];

  function abrirCarrinho() {
    document.getElementById('carrinho').classList.add('open');
    document.getElementById('carrinho-overlay').classList.add('open');
    document.getElementById('carrinho').setAttribute('aria-hidden', 'false');
  }

  function fecharCarrinho() {
    document.getElementById('carrinho').classList.remove('open');
    document.getElementById('carrinho-overlay').classList.remove('open');
    document.getElementById('carrinho').setAttribute('aria-hidden', 'true');
  }

  function adicionarCarrinho(nome, preco) {
    carrinho.push({ nome, preco });
    atualizarCarrinho();
    abrirCarrinho();
  }

  function atualizarCarrinho() {
    let lista = document.getElementById('lista-carrinho');
    lista.innerHTML = "";
    if (carrinho.length === 0) {
      lista.innerHTML = "<li>Nenhum produto adicionado.</li>";
      return;
    }
    carrinho.forEach((item, index) => {
      lista.innerHTML += `<li>
        <span>${item.nome}</span>
        <span>
          R$ ${item.preco.toFixed(2).replace('.', ',')}
          <button class="btn btn-sm btn-danger ms-2" onclick="removerCarrinho(${index})">❌</button>
        </span>
      </li>`;
    });
  }

  function removerCarrinho(index) {
    carrinho.splice(index, 1);
    atualizarCarrinho();
  }

  // fecha com Esc
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') fecharCarrinho();
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
