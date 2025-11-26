<?php
include 'header2.php';
$nome_trilha_atual = "parque do itapiracó"; // Exemplo
?>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reserva do Itapiracó</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style2.css"> <!-- CSS separado -->
</head>
<body>
  <div class="container conteudo">
    <img src="../img/itapiraco1.jpeg" alt="Reserva do Itapiracó"> <!-- ajuste o caminho conforme sua estrutura -->

    <div class="texto">
      <h2>Reserva do Itapiracó</h2>
      <p>
        Antes de se tornar uma unidade de conservação, a área abrigava a Estação de Pesquisa do Ministério da Agricultura, sendo espaço utilizado para o cultivo de frutas cítricas e outras árvores frutíferas, além da criação de porcos e aves.
      </p>
      <p>
        Com a desativação das atividades do Campo Experimental do Itapiracó, a área foi devolvida ao Departamento de Patrimônio da União (DPU).
      </p>
      <p>
        A Secretaria de Meio Ambiente do Maranhão obteve um Termo de Comodato para administrar a área, e após estudos, a APA do Itapiracó foi criada pelo Decreto nº 15.618 de 1997.
      </p>
      <p>
        Em 2017, o espaço ganhou praças, campos de futebol, trilhas, parquinhos e mais de 10 km de áreas para caminhada, tornando-se o maior centro de lazer do estado.
      </p>

     

    </div>
  </div>
   <div class="container trilhas">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <h3 class="text-center">Trilhas da Reserva do Itapiracó</h3>
      
      <p>
        A Área de Proteção Ambiental (APA) do Itapiracó, localizada entre São Luís e São José de Ribamar, no Maranhão, é uma importante reserva ecológica que cobre aproximadamente 322 hectares. É um dos poucos remanescentes de floresta nativa dentro da área urbana da capital maranhense e oferece diversas trilhas ecológicas que variam em extensão e dificuldade, sendo ideais tanto para iniciantes quanto para caminhantes mais experientes.
      </p>
      <p>
        Entre as trilhas mais conhecidas da APA, destaca-se a Trilha 1, com cerca de 6,3 km de extensão. Ela é considerada fácil e pode ser percorrida em aproximadamente 1h30, sendo ideal para iniciantes e famílias. Outra opção bastante procurada é a Trilha da APA Itapiracó, com 4,87 km, considerada de dificuldade moderada, por conta do desnível leve ao longo do caminho. Para quem busca uma trilha mais extensa e desafiadora, existe a Trilha da APA Itapiracó circular, com 8,37 km de percurso, também de dificuldade moderada, ideal para caminhadas mais longas e exploratórias.
      </p>
      <p>
        Há também trilhas mais curtas, como a Trilha Reserva do Itapiracó - Cohatrac, com apenas 2,08 km, perfeita para caminhadas rápidas, e a trilha que percorre o Complexo Esportivo da Reserva do Itapiracó, com cerca de 5 km, que combina a experiência da natureza com áreas de lazer e prática esportiva.
      </p>
    </div>
  </div>
</div>

    <main>

        <section class="avaliacoes-da-trilha">
            <?php
            // 3. Inclui o template de avaliações
            // O template usará as variáveis $conn e $nome_trilha_atual
            include 'template-avaliacoes.php';
            ?>
        </section>
    </main>

<footer>
  <div class="social-media">
    <a href="https://www.instagram.com/reservadoitapiraco?igsh=d3FwaHA0d3Vicmt5" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="instagram-button">
      <img src="../img/instagram.webp" 
           alt="Instagram" 
           class="instagram-icon">
    </a>
     <span class="instagram-text"> Instagram oficial da reserva do Itapiracó </span>
  </div>

</footer>

<?php include 'footer.php'; ?>
