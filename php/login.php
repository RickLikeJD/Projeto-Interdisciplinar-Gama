<?php
// Inicia a sessão no início do script, antes de qualquer saída
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../gama/conexao.php'); // Seu arquivo de conexão
?>

<?php include 'header.php'; // Seu cabeçalho HTML ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Um fundo mais claro para o login */
        }
        .login-container {
            margin-top: 100px;
        }
        .card-title {
            color: #333; /* Cor mais escura para o título no card claro */
        }
        /* Ajuste para o corpo escuro se header.php definir assim */
        <?php if (isset($CORPO_ESCURO) && $CORPO_ESCURO === true): ?>
        body {
            background-color: #212529; /* bg-dark do Bootstrap */
            color: #f8f9fa; /* text-white do Bootstrap */
        }
        .card {
            background-color: #343a40; /* Um cinza escuro para o card */
            border-color: #495057;
        }
        .card-title, .form-label {
            color: #f8f9fa; /* Texto branco para títulos e labels dentro do card escuro */
        }
        .form-control {
            background-color: #495057;
            color: #f8f9fa;
            border-color: #6c757d;
        }
        .form-control:focus {
            background-color: #495057;
            color: #f8f9fa;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .alert-danger {
             background-color: #dc3545;
             color: white;
        }
        <?php endif; ?>
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4">Login</h2>

                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (!isset($conn) || $conn->connect_error) {
                                echo "<div class='alert alert-danger'>Erro de conexão com o banco de dados. Por favor, tente mais tarde.</div>";
                                // Log do erro: error_log("Erro de conexão: " . ($conn ? $conn->connect_error : "Variável \$conn não definida"));
                            } else {
                                $usuario_login = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : '';
                                $senha_login = isset($_POST["senha"]) ? $_POST["senha"] : ''; // Não faça trim na senha antes de verificar

                                if (empty($usuario_login) || empty($senha_login)) {
                                    echo "<div class='alert alert-danger'>Usuário e senha são obrigatórios!</div>";
                                } else {
                                    // Use prepared statements para buscar o usuário
                                    // A coluna para o nome de usuário é 'usuario' e para senha é 'password' na tabela 'tbuser'
                                    $sql = "SELECT id, usuario, password FROM tbuser WHERE usuario = ?";
                                    $stmt = $conn->prepare($sql);

                                    if ($stmt) {
                                        $stmt->bind_param("s", $usuario_login);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            $user_data = $result->fetch_assoc();
                                            // Verificar a senha usando password_verify()
                                            if (password_verify($senha_login, $user_data['password'])) {
                                                // Senha correta, iniciar sessão
                                                // session_start(); // Já iniciado no topo do script
                                                $_SESSION['usuario_id'] = $user_data['id']; // Armazene o ID do usuário, é mais útil
                                                $_SESSION['usuario_nome'] = $user_data['usuario']; // Ou o nome de usuário, como preferir
                                                header("Location: ../php/index.php"); // Redirecionar para a página inicial
                                                exit();
                                            } else {
                                                // Senha incorreta
                                                echo "<div class='alert alert-danger'>Usuário ou senha inválido!</div>";
                                            }
                                        } else {
                                            // Usuário não encontrado
                                            echo "<div class='alert alert-danger'>Usuário ou senha inválido!</div>";
                                        }
                                        $stmt->close();
                                    } else {
                                        // Erro ao preparar a consulta
                                        echo "<div class='alert alert-danger'>Erro no sistema. Por favor, tente novamente mais tarde.</div>";
                                        // Log do erro: error_log("Erro ao preparar statement: " . $conn->error);
                                    }
                                }
                                $conn->close(); // Fechar a conexão
                            }
                        }
                        ?>

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group mb-3">
                                <label for="usuario" class="form-label">Usuário:</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="senha" class="form-label">Senha:</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p>Não tem uma conta? <a href="cadastro.php" class="text-decoration-none">Cadastre-se</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>