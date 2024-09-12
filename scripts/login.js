document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.getElementById('formulario-login');

    formulario.addEventListener('submit', function(evento) {
        let valido = true;

        // validar email
        const campoEmail = document.getElementById('email');
        const erroEmail = document.getElementById('erro-email');
        if (!campoEmail.value || !validarEmail(campoEmail.value)) {
            erroEmail.textContent = 'Insira um email válido.';
            valido = false;
        } else {
            erroEmail.textContent = '';
        }

        // validar senha
        const campoSenha = document.getElementById('senha');
        const erroSenha = document.getElementById('erro-senha');
        if (!campoSenha.value || campoSenha.value.length < 3) {
            erroSenha.textContent = 'Senha inválida.';
            valido = false;
        } else {
            erroSenha.textContent = '';
        }

        if (!valido) {
            evento.preventDefault(); // nao envia o form se n for valid
        }
    });
});

function validarEmail(email) {
    const padraoEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return padraoEmail.test(email);
}
