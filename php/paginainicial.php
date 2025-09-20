<?php
$conn = new mysqli("localhost", "root", "", "meusite");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM produtos ORDER BY criado_em DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha Loja</title>
    <style>
        .produto {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px;
            width: 250px;
            display: inline-block;
            vertical-align: top;
        }
        .produto img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Produtos</h1>
    <a href="adicionar.php">+ Adicionar Produto</a>
    <div>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="produto">
                <img src="<?php echo $row['imagem']; ?>" alt="Imagem do produto">
                <h2><?php echo $row['titulo']; ?></h2>
                <p><?php echo $row['descricao']; ?></p>
                <p><strong>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></strong></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
