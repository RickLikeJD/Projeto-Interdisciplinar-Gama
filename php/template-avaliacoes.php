<?php
require_once '../gama/conexao.php';

if (!isset($conn) || $conn->connect_error) {
    $error_message = isset($conn) ? "Erro de conexão mysqli: " . htmlspecialchars($conn->connect_error) : "A conexão com o banco de dados (\$conn) não foi estabelecida ou é inválida.";
    echo "<p style='color:red;'><strong>Erro:</strong> " . $error_message . "</p>";
    return;
}

if (!isset($nome_trilha_atual) || empty($nome_trilha_atual)) {
    echo "<p style='color:red;'><strong>Erro:</strong> O nome da trilha atual (\$nome_trilha_atual) não foi definido.</p>";
    return;
}

// Se recebeu um POST, insere avaliação no banco
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedback = trim($_POST['feedback'] ?? '');
    $estrelas = intval($_POST['estrelas'] ?? 0);

    if ($feedback && $estrelas >= 1 && $estrelas <= 5) {
        $sql_insert = "INSERT INTO tbAvaliacoes (nome_trilha, feedback_texto, estrelas, data_avaliacao)
                       VALUES (?, ?, ?, NOW())";
        $stmt_insert = $conn->prepare($sql_insert);
        if ($stmt_insert) {
            $stmt_insert->bind_param('ssi', $nome_trilha_atual, $feedback, $estrelas);
            $stmt_insert->execute();
            $stmt_insert->close();
            echo "<script>window.location.href='" . $_SERVER['REQUEST_URI'] . "';</script>";
            exit;        
        }
    }
}

// Busca avaliações
$avaliacoes = [];

$sql = "SELECT feedback_texto, estrelas, data_avaliacao
        FROM tbAvaliacoes
        WHERE nome_trilha = ?
        ORDER BY id DESC";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param('s', $nome_trilha_atual);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $avaliacoes[] = $row;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Avaliações - <?php echo htmlspecialchars($nome_trilha_atual); ?></title>
    <style>
        body {
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', 'Roboto', sans-serif;
        }

        .container-avaliacoes {
            max-width: 700px;
            margin: 40px auto;
            padding: 25px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .container-avaliacoes h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .avaliacao-item {
            background: #fafafa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #eaeaea;
            transition: box-shadow 0.3s;
        }

        .avaliacao-item:hover {
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        }

        .avaliacao-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .avaliacao-estrelas {
            color: #ffc107;
            font-weight: bold;
            font-size: 1.1em;
        }

        .avaliacao-data {
            color: #888;
            font-size: 0.9em;
        }

        .avaliacao-texto {
            color: #444;
            font-style: italic;
            line-height: 1.6;
            font-size: 1em;
        }

        .sem-avaliacoes {
            text-align: center;
            color: #777;
            padding: 20px;
            background: #fefefe;
            border-radius: 8px;
            border: 1px dashed #ccc;
        }

        /* Formulário */
        .form-avaliacao {
            background: #fafafa;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
        }

        .form-avaliacao textarea {
            width: 100%;
            height: 100px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            resize: vertical;
            font-size: 1em;
            margin-bottom: 10px;
        }

        .form-avaliacao select {
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            font-size: 1em;
        }

        .form-avaliacao button {
            background-color: #007bff;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .form-avaliacao button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container-avaliacoes">
    <h2>Avaliações para: <?php echo htmlspecialchars($nome_trilha_atual); ?> 📝</h2>

    <?php if (count($avaliacoes) > 0): ?>
        <?php foreach ($avaliacoes as $avaliacao): ?>
            <div class="avaliacao-item">
                <div class="avaliacao-header">
                    <span class="avaliacao-estrelas">
                        <?php
                        $num_estrelas = (int)$avaliacao['estrelas'];
                        for ($i = 1; $i <= 5; $i++) {
                            echo ($i <= $num_estrelas) ? '⭐' : '☆';
                        }
                        ?>
                        (<?php echo $num_estrelas; ?>/5)
                    </span>
                    <span class="avaliacao-data">
                        <?php
                        $data_formatada = date('d/m/Y H:i', strtotime($avaliacao['data_avaliacao']));
                        echo $data_formatada;
                        ?>
                    </span>
                </div>
                <p class="avaliacao-texto">
                    "<?php echo nl2br(htmlspecialchars($avaliacao['feedback_texto'])); ?>"
                </p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="sem-avaliacoes">Ainda não há avaliações para "<?php echo htmlspecialchars($nome_trilha_atual); ?>". Seja o primeiro a avaliar!</p>
    <?php endif; ?>

    <!-- Formulário de avaliação -->
    <div class="form-avaliacao">
        <h3>Deixe sua avaliação:</h3>
        <form method="post">
            <label for="estrelas">Nota:</label><br>
            <select name="estrelas" id="estrelas" required>
                <option value="" disabled selected>Escolha...</option>
                <option value="5">5 ⭐⭐⭐⭐⭐ - Excelente</option>
                <option value="4">4 ⭐⭐⭐⭐ - Muito bom</option>
                <option value="3">3 ⭐⭐⭐ - Bom</option>
                <option value="2">2 ⭐⭐ - Regular</option>
                <option value="1">1 ⭐ - Ruim</option>
            </select><br>

            <label for="feedback">Comentário:</label><br>
            <textarea name="feedback" id="feedback" placeholder="Escreva aqui seu comentário..." required></textarea><br>

            <button type="submit">Enviar Avaliação</button>
        </form>
    </div>
</div>

</body>
</html>
