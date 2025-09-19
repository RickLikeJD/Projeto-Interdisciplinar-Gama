<?php
// ABSOLUTELY FIRST: Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// THEN: Include necessary files like database connection
include('../gama/conexao.php'); // Seu arquivo de conexão

// THEN: All PHP logic, including potential redirects
$login_error_message = ''; // Variable to hold error messages for display in HTML
$usuario_form_value = ''; // To repopulate username field on error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_form_value = isset($_POST['usuario']) ? htmlspecialchars(trim($_POST['usuario'])) : ''; // Store for repopulation

    if (!isset($conn) || $conn->connect_error) {
        $login_error_message = "Erro de conexão com o banco de dados. Por favor, tente mais tarde.";
    } else {
        $usuario_login = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : '';
        $senha_login = isset($_POST["senha"]) ? $_POST["senha"] : '';

        if (empty($usuario_login) || empty($senha_login)) {
            $login_error_message = "Usuário e senha são obrigatórios!";
        } else {
            $sql = "SELECT id, usuario, password FROM tbuser WHERE usuario = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("s", $usuario_login);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $user_data = $result->fetch_assoc();
                    if (password_verify($senha_login, $user_data['password'])) {
                        $_SESSION['usuario_id'] = $user_data['id'];
                        $_SESSION['usuario_nome'] = $user_data['usuario'];
                        
                        $stmt->close();
                        $conn->close(); 
                        
                        header("Location: ../php/gamainicial.php"); 
                        exit(); 
                    } else {
                        $login_error_message = "Usuário ou senha inválido!";
                    }
                } else {
                    $login_error_message = "Usuário ou senha inválido!";
                }
                $stmt->close(); 
            } else {
                $login_error_message = "Erro no sistema. Por favor, tente novamente mais tarde.";
            }
        }
        if (isset($conn) && $conn->ping()) { 
            $conn->close();
        }
    }
}

// Determine body class for dark mode
$body_classes = '';
if (isset($CORPO_ESCURO) && $CORPO_ESCURO === true) { // Assuming $CORPO_ESCURO might be set in header.php or elsewhere
    $body_classes .= ' dark-mode';
}
?>

<?php
include 'header.php'; 
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/style2.css">
    
    <link rel="stylesheet" href="../css/login.css"> 
    
    </head>
<body class="<?php echo trim($body_classes); ?>">
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4">EcoWay</h2>

                        <?php
                        if (!empty($login_error_message)) {
                            echo "<div class='alert alert-danger'>{$login_error_message}</div>";
                        }
                        ?>

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group mb-3"> 
                                <label for="usuario" class="form-label">Usuário:</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required value="<?php echo $usuario_form_value; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="senha" class="form-label">Senha:</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                            <div class="d-grid mt-4"> 
                                <button type="submit" class="btn btn-primary">Login</button>
                                <div class="social-login text-center">
                                 <p>Ou entre com:</p>
                                <button class="btn-google">
                                <img src="https://img.icons8.com/color/16/000000/google-logo.png"/> 
                                  Login com Google
                                </button>
                               <button class="btn-facebook">
                              <img src="https://img.icons8.com/color/16/000000/facebook-new.png"/> 
                             Login com Facebook
                               </button>
                                </div>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>