// script do header
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
  let lista = document.getElementById('lista-carrinho');
  lista.innerHTML = "";
  if (carrinho.length === 0) {
    lista.innerHTML = "<li>Nenhum produto adicionado.</li>";
    return;
  }
  let htmlContent = "";
  carrinho.forEach((item, index) => {
    htmlContent += <li>
      <span>${item.nome}</span>
      <span>
        R$ ${item.preco.toFixed(2).replace('.', ',')}
        <button class="btn btn-sm btn-danger ms-2" onclick="removerCarrinho(${index})">❌</button>
      </span>
    </li>;
  });
  lista.innerHTML = htmlContent;
}

function removerCarrinho(index) {
  carrinho.splice(index, 1);
  atualizarCarrinho();
  if (carrinho.length === 0) {
    fecharCarrinho();
  }
}

// Evento para fechar o carrinho com a tecla Esc
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') fecharCarrinho();
});