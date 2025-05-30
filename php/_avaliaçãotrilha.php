<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Avaliação</title>
    <link rel="stylesheet" href="../css/avaliaçãotrilha.css"> </head>
<body>

    <h1>Formulário de Avaliação da Trilha</h1>

    <form id="avaliacaoTrilhaForm" action="processar_avaliacao.php" method="POST">
        <div>
            <label for="trilhaNome">Nome da Trilha:</label>
            <select id="trilhaNome" name="trilhaNome" required> <option value="">Selecione uma trilha</option> <option value="parque_rangedor">Parque do Rangedor</option>
                <option value="parque_itapiracó">Parque do Itapiracó</option>
                <option value="parque_bom_menino">Parque do Bom Menino</option>
            </select>
        </div>

        <div>
            <label for="quantidadeEstrelas">Quantidade de Estrelas (1 a 5):</label>
            <select id="quantidadeEstrelas" name="quantidadeEstrelas" required> <option value="1">1 Estrela</option>
                <option value="2">2 Estrelas</option>
                <option value="3">3 Estrelas</option>
                <option value="4">4 Estrelas</option>
                <option value="5" selected>5 Estrelas</option> </select>
        </div>

        <div>
            <label for="comentarios">Comentários:</label>
            <textarea id="comentarios" name="comentarios" rows="4" placeholder="Deixe seu comentário sobre a trilha..." required></textarea> </div>

        <div>
            <input type="submit" value="Enviar Avaliação">
        </div>
    </form>

    <script src="scriptavaliação.js"></script>
</body>
</html>