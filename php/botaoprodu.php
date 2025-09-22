<?php
$conn = new mysqli("localhost", "root", "", "mydb");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbProdutos ORDER BY data_criacao DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha Loja</title>
    <!-- Importando o CSS externo -->
    <link rel="stylesheet" href="../css/inicial.css">
</head>
<body>
    <h1>Produtos</h1>
    <a href="adicionar.php">+ Adicionar Produto</a>
    <div class="container">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="produto">
                    <?php if (!empty($row['imagem'])): ?>
                        <img src="<?php echo $row['imagem']; ?>" alt="Imagem do produto">
                    <?php else: ?>
                        <img src="sem-imagem.png" alt="Sem imagem">
                    <?php endif; ?>
                    <h2><?php echo htmlspecialchars($row['titulo']); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($row['descricao'])); ?></p>
                    <p><strong>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></strong></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhum produto cadastrado ainda.</p>
        <?php endif; ?>
    </div>
</body>
</html>
