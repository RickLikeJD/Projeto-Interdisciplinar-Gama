<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($currentPage == 'login.php' || $currentPage == 'cadastro.php') ? 'Login - Gama' : 'Gama'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php if ($currentPage == 'login.php' || $currentPage == 'cadastro.php') : ?>
    <style>
        body {
            background-color: #333;
            color: white;
            text-align: center;
        }
        .navbar {
            background-color: transparent !important;
            border: none;
        }
    </style>
    <?php endif; ?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #9c9c9c !important;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="gamainicial.php">
            <img src="../img/logo2.png" alt="Logo" width="50" height="50">
            <span class="ms-2" style="color: black !important;">Gama</span>
        </a>

        <?php if ($currentPage != 'login.php' && $currentPage != 'cadastro.php') : ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'trilhas.php') ? 'active' : ''; ?>" href="trilhas.php" style="color:rgb(63, 156, 86) !important;">Trilhas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'sobre.php') ? 'active' : ''; ?>" href="sobre.php" style="color:rgb(63, 156, 86) !important;">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'contato.php') ? 'active' : ''; ?>" href="contato.php" style="color:rgb(63, 156, 86) !important;">Contato</a>
                    </li>

                    <?php if (isset($_SESSION['usuario_id'])) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" style="color:rgb(63, 156, 86) !important;">
                                <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
                                <li><a class="dropdown-item" href="configuracoes.php">Configurações</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="logout.php">Sair</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php" style="color:rgb(63, 156, 86) !important;">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>
// dsd
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
