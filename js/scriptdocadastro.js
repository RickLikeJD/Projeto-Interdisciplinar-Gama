function validarSenha() {
  const senha = document.getElementById("senha").value;
  const confirmarSenha = document.getElementById("confirmarSenha").value;
  if (senha !== confirmarSenha) {
    alert("⚠️ As senhas não coincidem.");
    return false;
  }

  return true;
}
function validarFormulario() {
  const email = document.getElementById("email").value;
  const senha = document.getElementById("senha").value;
  const confirmarSenha = document.getElementById("confirmarSenha").value;

  if ( !email || !senha || !confirmarSenha) {
    alert("⚠️ Todos os campos são obrigatórios.");
    return false;
  }

  if (!validarSenha()) {
    return false;
  }

  return true;
}