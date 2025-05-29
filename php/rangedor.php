<?php include 'header.php'; // Seu cabeçalho HTML ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parque Estadual do Sítio do Rangedor</title>
    <link rel="stylesheet" href="../css/rangedor.css">
</head>
<body>
<section id="nova-secao" class="content-section">
    <div class="container">
        <h2>Parque do Rangedor</h2>
        <div class="flex-container">
        <div class="imagem-container">
                <img src="../img/rangedor.webp" alt="Descrição da Imagem">
            </div>
            <div class="texto-container">
            <p class="intro-text">Criado originalmente como Estação Ecológica em 2005 (Decreto nº 21.797) e posteriormente alterado, o Parque do Rangedor é uma unidade de proteção integral. Sua principal função ecológica é a reposição de aquíferos, fundamental para o abastecimento de lençóis freáticos da cidade. Além disso, atua como um regulador térmico em meio à crescente urbanização e abriga uma diversidade de espécies vegetais nativas, como jatobá, pau-pombo, angelim, babaçu e tucum. Projetos de infraestrutura no parque foram planejados para ocupar áreas já degradadas, com iniciativas de reflorestamento com árvores nativas, visando a conservação ambiental..</p>  
            </div>
        </div>
    </div>
</section>

    <section id="visite" class="content-section">
        <div class="container">
            <div class="visit-info-grid">
                <div class="visit-info-item">
                    <h3>Localização</h3>
                    <p>Av. dos Holandeses, S/N - Calhau<br>São Luís - MA, 65071-380<br>(Referência: Próximo ao Golden Shopping Calhau)</p>
                </div>
                <div class="visit-info-item">
                    <h3>Horário de Funcionamento</h3>
                    <p>Diariamente: 05:00 – 21:00 (Horário pode variar, confirme antes de visitar)</p>
                </div>
            </div>
            <div class="map-placeholder text-center">
                 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.73519498002!2d-44.26160012529963!3d-2.5021674383630706!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7f68e8b80c60671%3A0x8c34ac0556677809!2sParque%20Estadual%20do%20S%C3%ADtio%20do%20Rangedor!5e0!3m2!1spt-BR!2sbr!4v1716999029739!5m2!1spt-BR!2sbr" width="100%" height="450" style="border:0; max-width: 800px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; <span id="currentYear"></span> Parque Estadual do Sítio do Rangedor. Todos os direitos reservados.</p>
            <p>Governo do Estado do Maranhão | Secretaria de Meio Ambiente e Recursos Naturais (SEMA)</p>
            <div class="social-links">
                <a href="#">[Facebook]</a>
                <a href="#">[Instagram]</a>            
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>

</body>
</html>