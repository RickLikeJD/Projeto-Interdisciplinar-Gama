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

$avaliacoes = [];

$sql = "SELECT feedback_texto, estrelas, data_avaliacao
        FROM tbAvaliacoes
        WHERE nome_trilha = ?
        ORDER BY id DESC";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo "<p style='color:red;'><strong>Erro ao preparar a consulta:</strong> " . htmlspecialchars($conn->error) . "</p>";
    return;
}

$stmt->bind_param('s', $nome_trilha_atual);

if (!$stmt->execute()) {
    echo "<p style='color:red;'><strong>Erro ao executar a consulta:</strong> " . htmlspecialchars($stmt->error) . "</p>";
    $stmt->close();
    return;
}

$result = $stmt->get_result();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $avaliacoes[] = $row;
    }
} else {
    echo "<p style='color:red;'><strong>Erro ao obter resultados:</strong> " . htmlspecialchars($stmt->error) . "</p>";
    $stmt->close();
    return;
}

$stmt->close();
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
</div>

</body>
</html>
