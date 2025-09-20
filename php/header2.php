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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <li><a class="dropdown-item" href="gamainicial.php">trilhas</a></li>
        <li><a class="dropdown-item" href="#">Ficção Científica</a></li>
        <li><a class="dropdown-item" href="#">Fantasia</a></li>
        <li><a class="dropdown-item" href="#">Terror</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Ver Todas</a></li>
    </ul>
  </li>
        <li class="nav-item"><a class="nav-link <?= $currentPage=='sobre.php' ? 'active' : '' ?>" href="sobre.php">Sobre</a></li>
        <li class="nav-item"><a class="nav-link <?= $currentPage=='contato.php' ? 'active' : '' ?>" href="contato.php">add+ produto</a></li>

        <?php if (isset($_SESSION['usuario_id'])): ?>
          <li class="nav-item dropdown">
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
          <li class="nav-item ms-lg-3">
            <a class="nav-link btn btn-login" href="login.php">Login</a>  
    
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
