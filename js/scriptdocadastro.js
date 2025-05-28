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
function validaremail(){
  const email = document.getElementById("email").value;
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!regex.test(email)) {
    alert("⚠️ Por favor, insira um endereço de e-mail válido.");
    return false;
  }

  return true;
}
function emailexistente() {
  const email = document.getElementById("email").value;
  // Simulação de verificação de e-mail existente
  const emailsExistentes = []
  alert(" ⚠️ E-mail já cadastrado. Por favor, tente outro.");
  if (emailsExistentes.includes(email)) {
    return false;
  }
  return true;
}