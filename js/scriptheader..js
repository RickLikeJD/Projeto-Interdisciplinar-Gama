function atualizarCarrinho() {
  let lista = document.getElementById("lista-carrinho");
  const btnFinalizar = document.getElementById("btnFinalizar");

  lista.innerHTML = "";

  if (carrinho.length === 0) {
    lista.innerHTML = "Nenhum produto adicionado.";
    // Esconde o botão se o carrinho estiver vazio
    btnFinalizar.style.display = "none";
  } else {
    // Mostra o botão se houver itens
    btnFinalizar.style.display = "block";

    // Este é o seu código existente para listar os itens
    carrinho.forEach((item, index) => {
      lista.innerHTML += ' ' + item.nome + ' R$ ' + item.preco.toFixed(2).replace('.', ',') + ' <button onclick="removerCarrinho(' + index + ')">X</button>';
    });
  }
}