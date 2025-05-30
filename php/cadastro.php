<?php
// Start session if not already started (good practice, though not strictly needed if header.php does it)
if (session_status() == PHP_SESSION_NONE) {
    // session_start(); // Uncomment if your header.php doesn't handle session start and you need sessions
}

include('../gama/conexao.php');

// --- Form Processing Logic ---
$cadastro_feedback_message = ''; // To store success or error messages
$cadastro_feedback_type = ''; // 'alert-success' or 'alert-danger'

$usuario_value = ''; // To repopulate fields on error
$email_value = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : ''; // Don't trim password itself
    $confirmarSenha = isset($_POST['confirmarSenha']) ? $_POST['confirmarSenha'] : '';

    // Store for repopulation
    $usuario_value = htmlspecialchars($usuario);
    $email_value = htmlspecialchars($email);

    if (empty($usuario) || empty($email) || empty($senha) || empty($confirmarSenha)) {
        $cadastro_feedback_message = 'Preencha todos os campos.';
        $cadastro_feedback_type = 'alert-danger';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $cadastro_feedback_message = 'Email inválido.';
        $cadastro_feedback_type = 'alert-danger';
    } elseif (strlen($senha) < 6) { // Example: Minimum password length
        $cadastro_feedback_message = 'A senha deve ter pelo menos 6 caracteres.';
        $cadastro_feedback_type = 'alert-danger';
    } elseif ($senha !== $confirmarSenha) {
        $cadastro_feedback_message = 'As senhas não coincidem.';
        $cadastro_feedback_type = 'alert-danger';
    } else {
        // Check if connection is valid
        if (!isset($conn) || $conn->connect_error) {
            $cadastro_feedback_message = "Erro de conexão com o banco de dados.";
            $cadastro_feedback_type = 'alert-danger';
        } else {
            $sql = "SELECT id FROM tbuser WHERE email = ? OR usuario = ?"; // Check for existing email OR username
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $email, $usuario);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // To give a more specific message, you could run two separate queries
                // For now, a general message:
                $cadastro_feedback_message = 'Este email ou nome de usuário já está cadastrado.';
                $cadastro_feedback_type = 'alert-danger';
            } else {
                $stmt->close(); // Close previous statement

                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                $sql_insert = "INSERT INTO tbuser (usuario, email, password) VALUES (?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param('sss', $usuario, $email, $senhaHash);

                if ($stmt_insert->execute()) {
                    $cadastro_feedback_message = 'Cadastro realizado com sucesso! Você pode fazer login agora.';
                    $cadastro_feedback_type = 'alert-success';
                    // Clear form values on success
                    $usuario_value = '';
                    $email_value = '';
                    // Potentially redirect to login page after a short delay or directly
                    // header('Location: login.php');
                    // exit;
                } else {
                    $cadastro_feedback_message = 'Erro ao cadastrar: ' . $stmt_insert->error;
                    $cadastro_feedback_type = 'alert-danger';
                }
                $stmt_insert->close();
            }
            // Ensure statement is closed if it was opened in the email/user check
            if (isset($stmt) && $stmt instanceof mysqli_stmt) { // Check if $stmt was initialized
                 if(!isset($stmt_insert)) $stmt->close(); // Close only if not closed already
            }
        }
    }
    if (isset($conn) && $conn->ping()) { // Close connection if it was opened and is still active
        $conn->close();
    }
}

// Determine body class for dark mode
// This assumes $CORPO_ESCURO might be set in your 'header.php' or a global config included before it.
// If 'header.php' itself outputs the <body> tag, this logic might need to be inside 'header.php'.
$body_classes = '';
if (isset($CORPO_ESCURO) && $CORPO_ESCURO === true) {
    $body_classes .= ' dark-mode';
}
?>

<?php include 'header.php'; // Seu cabeçalho HTML ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Gama</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/login.css">
</head>
<body class="<?php echo trim($body_classes); ?>">

<div class="container login-container"> 
    <div class="row justify-content-center">
        <div class="col-12"> 

            <div class="card"> 
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Cadastro</h2>

                    <?php
                    if (!empty($cadastro_feedback_message)) {
                        echo '<div class="alert ' . $cadastro_feedback_type . '">' . htmlspecialchars($cadastro_feedback_message) . '</div>';
                    }
                    ?>

                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $usuario_value; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $email_value; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control" required minlength="6">
                        </div>

                        <div class="mb-3">
                            <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
                            <input type="password" name="confirmarSenha" id="confirmarSenha" class="form-control" required minlength="6">
                        </div>

                        <div class="d-grid mt-4"> 
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <p>Já tem uma conta? <a href="login.php">Fazer login</a></p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
