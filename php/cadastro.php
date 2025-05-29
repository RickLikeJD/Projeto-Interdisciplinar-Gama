<?php
include('../gama/conexao.php');
?>

<?php include 'header.php'; // Seu cabeçalho HTML ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Gama</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<!-- Container -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card mt-5">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Cadastro</h2>

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
                        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
                        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';
                        $confirmarSenha = isset($_POST['confirmarSenha']) ? trim($_POST['confirmarSenha']) : '';

                        if (empty($usuario) || empty($email) || empty($senha) || empty($confirmarSenha)) {
                            echo '<div class="alert alert-danger">Preencha todos os campos.</div>';
                        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo '<div class="alert alert-danger">Email inválido.</div>';
                        } elseif ($senha !== $confirmarSenha) {
                            echo '<div class="alert alert-danger">As senhas não coincidem.</div>';
                        } else {
                            $sql = "SELECT id FROM tbuser WHERE email = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('s', $email);
                            $stmt->execute();
                            $stmt->store_result();

                            if ($stmt->num_rows > 0) {
                                echo '<div class="alert alert-danger">Este email já está cadastrado.</div>';
                            } else {
                                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                                $sql = "INSERT INTO tbuser (usuario, email, password) VALUES (?, ?, ?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('sss', $usuario, $email, $senhaHash);

                                if ($stmt->execute()) {
                                    echo '<div class="alert alert-success">Cadastro realizado com sucesso!</div>';
                                    // header('Location: login.php');
                                    // exit;
                                } else {
                                    echo '<div class="alert alert-danger">Erro ao cadastrar: ' . $stmt->error . '</div>';
                                }
                            }
                            $stmt->close();
                        }
                        $conn->close();
                    }
                    ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
                            <input type="password" name="confirmarSenha" id="confirmarSenha" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <p>Já tem uma conta? <a href="login.php" class="text-decoration-none">Fazer login</a></p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
