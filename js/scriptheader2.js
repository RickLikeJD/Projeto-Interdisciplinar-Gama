// carrinho em memória (pode ser substituído por integração com servidor/ sessão)
  let carrinho = [];

  function abrirCarrinho() {
    document.getElementById('carrinho').classList.add('open');
    document.getElementById('carrinho-overlay').classList.add('open');
    document.getElementById('carrinho').setAttribute('aria-hidden', 'false');
  }

  function fecharCarrinho() {
    document.getElementById('carrinho').classList.remove('open');
    document.getElementById('carrinho-overlay').classList.remove('open');
    document.getElementById('carrinho').setAttribute('aria-hidden', 'true');
  }

  function adicionarCarrinho(nome, preco) {
    carrinho.push({ nome, preco });
    atualizarCarrinho();
    abrirCarrinho();
  }

  function atualizarCarrinho() {
  let lista = document.getElementById("lista-carrinho");
  const btnFinalizar = document.getElementById("btnFinalizar");
  
  lista.innerHTML = "";

  if (carrinho.length === 0) {
    lista.innerHTML = "Nenhum produto adicionado.";
    btnFinalizar.style.display = "none";
  } else {
    btnFinalizar.style.display = "block";

    carrinho.forEach((item, index) => {
      lista.innerHTML += '<li>' + item.nome + ' R$ ' + item.preco.toFixed(2).replace('.', ',') + ' <button onclick="removerCarrinho(' + index + ')">X</button></li>';
    });
  }
}

  function removerCarrinho(index) {
    carrinho.splice(index, 1);
    atualizarCarrinho();
  }

  // fecha com Esc
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') fecharCarrinho();
  });