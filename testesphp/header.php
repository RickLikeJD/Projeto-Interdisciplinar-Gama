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

    <link rel="stylesheet" href="style.css">

    <?php if ($currentPage == 'login.php' || $currentPage == 'cadastro.php') : ?>
    <style>
        body {
            background-color: #333;
            color: white;
            text-align: center;
        }
        /* Esconde a navbar nessas páginas, se desejar */
        .navbar {
            display: none;
        }
    </style>
    <?php endif; ?>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="gamainicial.php">Gama</a>

        <?php if ($currentPage != 'login.php' && $currentPage != 'cadastro.php') : ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'trilhas.php') ? 'active' : ''; ?>" href="trilhas.php">Trilhas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'sobre.php') ? 'active' : ''; ?>" href="sobre.php">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'contato.php') ? 'active' : ''; ?>" href="contato.php">Contato</a>
                    </li>

                    <?php if (isset($_SESSION['usuario_id'])) : ?>
                        <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
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
                        <li class="nav-item ms-lg-3">
                            <a class="nav-link btn btn-login" href="login.php">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>