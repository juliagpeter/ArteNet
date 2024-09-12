function toggleMenu() {
    const navList = document.querySelector('.nav-list');
    navList.classList.toggle('show');
}

function confirma_excluir() {
    return confirm("Confirma Exclusão?");
}

document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.getElementById('formulario-cadastro');

    formulario.addEventListener('submit', function(evento) {
        let valido = true;

        // nome
        const campoNome = document.getElementById('nome');
        const erroNome = document.getElementById('erro-nome');
        if (!campoNome.value) {
            erroNome.textContent = 'Por favor, insira seu nome.';
            valido = false;
        } else {
            erroNome.textContent = '';
        }

        // nascimento
        const campoNascimento = document.getElementById('nascimento');
        const erroNascimento = document.getElementById('erro-nascimento');
        if (!campoNascimento.value) {
            erroNascimento.textContent = 'Por favor, insira sua data de nascimento.';
            valido = false;
        } else {
            erroNascimento.textContent = '';
        }

        // email
        const campoEmail = document.getElementById('email');
        const erroEmail = document.getElementById('erro-email');
        if (!campoEmail.value || !validarEmail(campoEmail.value)) {
            erroEmail.textContent = 'Por favor, insira um email válido.';
            valido = false;
        } else {
            erroEmail.textContent = '';
        }

        // gênero
        const campoGenero = document.getElementById('genero');
        const erroGenero = document.getElementById('erro-genero');
        if (!campoGenero.value) {
            erroGenero.textContent = 'Por favor, selecione seu gênero.';
            valido = false;
        } else {
            erroGenero.textContent = '';
        }

        // senha
        const campoSenha = document.getElementById('senha');
        const erroSenha = document.getElementById('erro-senha');
        if (!campoSenha.value || campoSenha.value.length < 3) {
            erroSenha.textContent = 'A senha deve ter pelo menos 3 caracteres.';
            valido = false;
        } else {
            erroSenha.textContent = '';
        }

        // cpf
        const campoCPF = document.getElementById('cpf');
        const erroCPF = document.getElementById('erro-cpf');
        if (!campoCPF.value) {
            erroCPF.textContent = 'Por favor, insira seu CPF.';
            valido = false;
        } else {
            erroCPF.textContent = '';
        }

        // imagem
        const campoImagem = document.getElementById('imagem');
        const erroImagem = document.getElementById('erro-imagem');
        if (campoImagem.files.length === 0) {
            erroImagem.textContent = 'Por favor, selecione uma foto.';
            valido = false;
        } else {
            erroImagem.textContent = '';
        }

        if (!valido) {
            evento.preventDefault(); // impede se tiver erro
        }
    });
});

function validarEmail(email) {
    const padraoEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return padraoEmail.test(email);
}
