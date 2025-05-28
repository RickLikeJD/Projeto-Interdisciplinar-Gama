<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gama login</title>
    <!--a merda do boot-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!--so pra separar-->
    <link rel="stylesheet" href="style.css"/>

</head>
<body>
    <header class="site-header text-center mb-4">
  <img src="logo2.png" alt="Logo do site" class="site-logo">
  <h2 class="site-title">Gama</h2>
</header>
    <div class="login-container">
        <h1 class="text-center">Cadastro</h1>
        <form onsubmit="return validarSenha()">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" required>
            </div>
            <div class="mb-3">
                <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="confirmarSenha" required>
            </div>

     <div class="d-grid">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </form>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
<script src="script.js"></script>
</html>