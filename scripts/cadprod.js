document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-produto');

    form.addEventListener('submit', function(event) {
        let valido = true;

        // Nome
        const nome = document.getElementById('nome');
        const erroNome = document.getElementById('erro-nome');
        if (nome.value.trim() === '') {
            erroNome.textContent = 'O nome é obrigatório.';
            valido = false;
        } else {
            erroNome.textContent = '';
        }

        // Descrição
        const descricao = document.getElementById('descricao');
        const erroDescricao = document.getElementById('erro-descricao');
        if (descricao.value.trim() === '') {
            erroDescricao.textContent = 'A descrição é obrigatória.';
            valido = false;
        } else {
            erroDescricao.textContent = '';
        }

        // Lance mínimo
        const lanceMinimo = document.getElementById('lance_minimo');
        const erroLanceMinimo = document.getElementById('erro-lance-minimo');
        if (lanceMinimo.value.trim() === '' || parseFloat(lanceMinimo.value) <= 0) {
            erroLanceMinimo.textContent = 'O lance mínimo deve ser um valor positivo.';
            valido = false;
        } else {
            erroLanceMinimo.textContent = '';
        }

        // Técnica
        const tecnica = document.getElementById('tecnica');
        const erroTecnica = document.getElementById('erro-tecnica');
        if (tecnica.value === '') {
            erroTecnica.textContent = 'A técnica é obrigatória.';
            valido = false;
        } else {
            erroTecnica.textContent = '';
        }

        // Estoque
        const estoque = document.getElementById('estoque');
        const erroEstoque = document.getElementById('erro-estoque');
        if (estoque.value.trim() === '' || parseInt(estoque.value) < 0) {
            erroEstoque.textContent = 'O estoque deve ser um valor não negativo.';
            valido = false;
        } else {
            erroEstoque.textContent = '';
        }

        // Categoria
        const categoria = document.getElementById('categoria');
        const erroCategoria = document.getElementById('erro-categoria');
        if (categoria.value === '') {
            erroCategoria.textContent = 'A categoria é obrigatória.';
            valido = false;
        } else {
            erroCategoria.textContent = '';
        }

        // Artista
        const artista = document.getElementById('artista');
        const erroArtista = document.getElementById('erro-artista');
        if (artista.value === '') {
            erroArtista.textContent = 'O artista é obrigatório.';
            valido = false;
        } else {
            erroArtista.textContent = '';
        }

        // Imagem
        const imagem = document.getElementById('imagem');
        const erroImagem = document.getElementById('erro-imagem');
        if (imagem.files.length === 0) {
            erroImagem.textContent = 'A foto é obrigatória.';
            valido = false;
        } else {
            erroImagem.textContent = '';
        }

        if (!valido) {
            event.preventDefault(); // Impede o envio do formulário se houver erros
        }
    });
});