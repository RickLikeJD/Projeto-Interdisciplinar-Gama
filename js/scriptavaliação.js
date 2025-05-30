document.addEventListener('DOMContentLoaded', function() {
    

    const form = document.getElementById('avaliacaoTrilhaForm');

    if (form) { 
        form.addEventListener('submit', function(event) {
            event.preventDefault(); 
            
            const trilhaSelect = document.getElementById('trilhaNome');
            const estrelasSelect = document.getElementById('quantidadeEstrelas');
            const comentariosTextarea = document.getElementById('comentarios');
            
            const nomeTrilha = trilhaSelect.options[trilhaSelect.selectedIndex].text;
            const estrelas = estrelasSelect.value;
            const comentarios = comentariosTextarea.value;
            
            
            if (!comentarios.trim() && estrelas === "0") { 
                alert('Por favor, selecione a quantidade de estrelas e deixe um comentário.');
                return; 
            }

            alert(`Avaliação Recebida:\n\nTrilha: ${nomeTrilha}\nEstrelas: ${estrelas}\nComentários: "${comentarios}"`);
            
            
            const dadosParaEnviar = {
                trilha: trilhaSelect.value, 
                estrelas: parseInt(estrelas), 
                comentarios: comentarios
            };

            fetch('/api/avaliacoes', { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(dadosParaEnviar),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Falha ao enviar avaliação. Status: ' + response.status);
                }
                return response.json(); 
            })
            .then(data => {
                console.log('Sucesso:', data);
                alert('Avaliação enviada com sucesso!');
                form.reset(); 
            })
            .catch((error) => {
                console.error('Erro:', error);
                alert('Ocorreu um erro ao enviar sua avaliação: ' + error.message);
            });
            
            
        });
    } else {
        console.error('Elemento do formulário #avaliacaoTrilhaForm não encontrado.');
    }
});