<!DOCTYPE html>
<html>
<?php
include_once('../componentes/cabecalho.php');
include_once('../componentes/header.php');
?>
<title>Alterar Usuário</title>
</head>
<body>

<main>
    <section>
        <form action="../controller/PessoaController.php" method="post">
            <p><label for="nome">nome: </label><input type="text" name="nome" id="nome" value="<?php echo $retorno['nome']; ?>"></p>
            <p><label for="nascimento">Nascimento: </label><input type="date" name="nascimento" id="nascimento" value="<?php echo $retorno['nascimento']; ?>"></p>
            <p><label for="email">Email: </label><input type="text" name="email" id="email" value="<?php echo $retorno['email']; ?>"></p>
            <p><label for="genero">Gênero: </label>
                <select name="genero" id="genero">
                    <option value="M" <?php echo ($retorno['genero'] == 'M') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="F" <?php echo ($retorno['genero'] == 'F') ? 'selected' : ''; ?>>Feminino</option>
                    <option value="Outro" <?php echo ($retorno['genero'] == 'Outro') ? 'selected' : ''; ?>>Outro</option>
                </select></p>
            <p><label for="senha">Senha: </label><input type="password" name="senha" id="senha" value="<?php echo $retorno['senha']; ?>"></p>
            <p><label for="cpf">CPF: </label><input type="text" name="cpf" id="cpf" value="<?php echo $retorno['cpf']; ?>"></p>
            <input type="hidden" id='pessoa_id' name='pessoa_id' value="<?php echo $retorno['pessoa_id']; ?>">
            <p>
                <label for="imagem">Foto Atual:</label><br>
                <img src="../imagens/<?php echo $retorno['imagem'];?>" alt="Imagem Atual" style="max-width: 150px; max-height: 150px;"><br>
                <label for="imagem">Alterar Foto: </label>
                <input type="file" name="imagem" id="imagem">
            </p>
            <p> <input type="submit" id='alterar' name='alterar' value="Alterar">
            </p>
        </form>
    </section>
</main>
</body>
</html>