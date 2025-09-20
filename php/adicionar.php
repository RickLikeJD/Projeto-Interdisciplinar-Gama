<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    // Upload da imagem
    $imagem = $_FILES['imagem']['name'];
    $caminho = "uploads/" . basename($imagem);

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
        // Conectar ao banco
        $conn = new mysqli("localhost", "root", "", "mydb");

        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        $sql = "INSERT INTO produtos (titulo, descricao, preco, imagem) 
                VALUES ('$titulo', '$descricao', '$preco', '$caminho')";
        $conn->query($sql);

        echo "Produto cadastrado com sucesso!";
        $conn->close();
    } else {
        echo "Erro ao enviar a imagem.";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <label>Título:</label><br>
    <input type="text" name="titulo" required><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao" required></textarea><br><br>

    <label>Preço:</label><br>
    <input type="number" step="0.01" name="preco"><br><br>

    <label>Imagem:</label><br>
    <input type="file" name="imagem" required><br><br>

    <button type="submit">Adicionar Produto</button>
</form>
