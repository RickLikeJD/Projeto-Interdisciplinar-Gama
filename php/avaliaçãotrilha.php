<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Avaliação</title>
    <link rel="stylesheet" href="../css/avaliaçãotrilha.css">
</head>
<body>

    <h1>Formulário de Avaliação da Trilha</h1>

    <form id="avaliacaoTrilhaForm">
        <div>
            <label for="trilhaNome">Nome da Trilha:</label>
            <select id="trilhaNome" name="trilhaNome">
                <option value="parque_rangedor">parque do rangedor</option>
                <option value="parque_itapiracó">parque do itapiracó</option>
                <option value="parque_bom_menino">parque do bom menino</option>                
                </select>
        </div>

        <div>
            <label for="quantidadeEstrelas">Quantidade de Estrelas (1 a 5):</label>
            <select id="quantidadeEstrelas" name="quantidadeEstrelas">
                <option value="1">1 Estrela</option>
                <option value="2">2 Estrelas</option>
                <option value="3">3 Estrelas</option>
                <option value="4">4 Estrelas</option>
                <option value="5">5 Estrelas</option>
            </select>
        </div>

        <div>
            <label for="comentarios">Comentários:</label>
            <textarea id="comentarios" name="comentarios" rows="4" placeholder="Deixe seu comentário sobre a trilha..."></textarea>
        </div>

        <div>
            <input type="submit" value="Enviar Avaliação">
        </div>
    </form>

    <script src="scriptavaliação.js"></script>
</body>
</html>