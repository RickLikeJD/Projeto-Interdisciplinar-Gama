<?php
/* ==========================================================================
   1. LÓGICA PHP (Processamento e Busca de Dados)
   ========================================================================== */
session_start();

// Configurações do Banco de Dados
$host = "localhost";
$user = "root";
$pass = "root";
$db   = "mydb"; 

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se está logado
if (!isset($_SESSION['usuario_nome'])) {
    header("Location: login.php"); 
    exit;
}

$nome_sessao = $_SESSION['usuario_nome'];
$msg = ""; 

// --- ATUALIZAR NOME DE USUÁRIO ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_profile') {
    $novo_nome = $_POST['name']; 
    
    // Verifica se já existe esse nome (opcional, mas bom ter)
    $sql_check = "SELECT id FROM tbUser WHERE usuario = ? AND usuario != ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $novo_nome, $nome_sessao);
    $stmt_check->execute();
    
    if($stmt_check->get_result()->num_rows > 0) {
        $msg = "<div class='alert error'>Esse nome de usuário já está em uso.</div>";
    } else {
        $sql_update = "UPDATE tbUser SET usuario = ? WHERE usuario = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("ss", $novo_nome, $nome_sessao);
        
        if ($stmt->execute()) {
            $_SESSION['usuario_nome'] = $novo_nome; 
            $nome_sessao = $novo_nome; 
            $msg = "<div class='alert success'>Nome atualizado com sucesso!</div>";
        } else {
            $msg = "<div class='alert error'>Erro ao atualizar.</div>";
        }
    }
}

// --- ATUALIZAR SENHA ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_password') {
    $senha_atual = $_POST['current_password'];
    $nova_senha  = $_POST['new_password'];
    $conf_senha  = $_POST['confirm_password'];

    $sql_busca_senha = "SELECT password FROM tbUser WHERE usuario = ?";
    $stmt = $conn->prepare($sql_busca_senha);
    $stmt->bind_param("s", $nome_sessao);
    $stmt->execute();
    $result_senha = $stmt->get_result();
    $user_data = $result_senha->fetch_assoc();

    if (!$user_data) {
        $msg = "<div class='alert error'>Erro interno.</div>";
    } elseif ($user_data['password'] !== $senha_atual) {
        $msg = "<div class='alert error'>A senha atual está incorreta.</div>";
    } elseif ($nova_senha !== $conf_senha) {
        $msg = "<div class='alert error'>As senhas novas não coincidem.</div>";
    } else {
        $sql_up_pass = "UPDATE tbUser SET password = ? WHERE usuario = ?";
        $stmt_up = $conn->prepare($sql_up_pass);
        $stmt_up->bind_param("ss", $nova_senha, $nome_sessao);
        
        if ($stmt_up->execute()) {
            $msg = "<div class='alert success'>Senha alterada com sucesso!</div>";
        } else {
            $msg = "<div class='alert error'>Erro ao alterar senha.</div>";
        }
    }
}

// --- BUSCAR DADOS COMPLETOS ---
$sql = "SELECT * FROM tbUser WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nome_sessao);
$stmt->execute();
$meu_perfil = $stmt->get_result()->fetch_assoc();

if (!$meu_perfil) { echo "Erro ao carregar perfil."; exit; }
?>

<?php include 'header2.php'; ?>

<!doctype html>
<html lang="pt-BR">
<head>   
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Meu Perfil</title>
  <link rel="stylesheet" href="../css/perfil.css">
  <style>
      .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; color: #fff; font-weight: bold; text-align: center; }
      .success { background-color: #4CAF50; }
      .error { background-color: #f44336; }
  </style>
</head>

<body>
  <div class="container">
    
    <aside class="card sidebar">
      <img src="../img/fotoPerfil.jpg" alt="Avatar" class="avatar">
      
      <h1 class="user-name"><?php echo htmlspecialchars($meu_perfil['usuario']); ?></h1>
      <p class="muted user-email"><?php echo htmlspecialchars($meu_perfil['email']); ?></p>
      
      <br>
      
      <h2 class="about-title">Sobre</h2>
      <p class="muted about-text">Usuário da plataforma.</p>
    </aside>

    <main>
      
      <?php if(!empty($msg)) echo $msg; ?>

      <section class="card">
        <h2 class="section-title">Editar Perfil</h2>

        <form method="post" enctype="multipart/form-data" class="form-grid">
          <input type="hidden" name="action" value="update_profile">

          <label for="name">Nome de Usuário</label>
          <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($meu_perfil['usuario']); ?>" required>

          <label for="bio">Bio (Desativado)</label>
          <textarea id="bio" name="bio" rows="4" disabled>Edição indisponível.</textarea>

          <label for="avatar">Foto (Desativado)</label>
          <div class="file-row">
            <input type="file" id="avatar" name="avatar" disabled>
            <button type="submit" class="btn">Salvar Nome</button>
          </div>
        </form>
      </section>

      <section class="card">
        <h2 class="section-title">Alterar senha</h2>

        <button id="btn-show-password-form" class="btn" type="button">Trocar senha</button>

        <div id="password-form-container" style="display: none; margin-top:20px;">
          <form class="form-grid" method="post">
            <input type="hidden" name="action" value="change_password">
            
            <label for="current_password">Senha atual</label>
            <input type="password" id="current_password" name="current_password" required>

            <label for="new_password">Nova senha</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirmar nova senha</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <div class="pw-row">
              <button type="submit" class="btn">Confirmar troca</button>
            </div>
          </form>
        </div>
      </section>

      <section class="card">
        <h2 class="section-title">Minhas Trilhas</h2>
        <p class="muted">Nenhuma trilha recente.</p>
      </section>

    </main>
  </div>

  <script>
    document.getElementById("btn-show-password-form").addEventListener("click", function () {
        const box = document.getElementById("password-form-container");
        if (box.style.display === "none") {
          box.style.display = "block";
          this.textContent = "Cancelar";
        } else {
          box.style.display = "none";
          this.textContent = "Trocar senha";
        }
    });
  </script>

</body>
</html>