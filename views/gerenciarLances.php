<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.ico">
    <link rel="stylesheet" href="../styles/gerenciar.css">
    <script src="../scripts/script.js"></script>
    <title>Gerenciar</title>
    <?php
    include_once('../componentes/cabecalho.php');
    include_once('../models/LanceDAO.php');
    include_once('../models/ProdutoDAO.php');
    ?>
</head>
<body>
<header>
    <nav class="navbar">
        <button class="menu-toggle" onclick="toggleMenu()">☰ Menu</button>
        <ul class="nav-list">
            <li><a href="index.php">Página Inicial</a></li>
            <li><a href="cadastrarPessoa.php">Adicionar Pessoa</a></li>
            <li><a href="pesquisarPessoa.php">Pesquisar Pessoa</a></li>
            <li><a href="listarPessoas.php">Listar Pessoas</a></li>
            <li><a href="cadastrarProduto.php">Adicionar Produto</a></li>
            <li><a href="listarProdutos.php">Listar Produto</a></li>
            <li><a href="gerenciarLances.php">Gerenciar Lances</a></li>
            <li>
                <form method="POST" action="../controller/PessoaController.php">
                    <button type="submit" name="sair" class="logout-button">Sair</button>
                </form>
            </li>
        </ul>
    </nav>
</header>
<main>
    <h2>Gerenciar os Lances</h2>

    <?php
    // Instancia o LanceDAO e recupera todos os lances
    $lanceDAO = new LanceDAO();
    $lances = $lanceDAO->listarLances();

    if (empty($lances)) {
        echo "<p>Não há lances cadastrados.</p>";
    } else {
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Produto ID</th>
                <th>Pessoa ID</th>
                <th>Valor</th>
                <th>Data e Hora</th>
                <th>Ações</th>
              </tr>";

        foreach ($lances as $lance) {
            ?>
            <tr>
                <td><?php echo $lance['id']; ?></td>
                <td><?php echo $lance['produto_id']; ?></td>
                <td><?php echo $lance['pessoa_id']; ?></td>
                <td><?php echo $lance['valor']; ?></td>
                <td><?php echo $lance['data_hora']; ?></td>
                <td>
                    <!-- Formulário para editar -->
                    <form action="alterarLance.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $lance['id']; ?>">
                        <button type="submit">Editar</button>
                    </form>

                    <!-- Formulário para excluir -->
                    <form action="../controller/LanceController.php" method="POST" style="display:inline;" onsubmit="return confirma_excluir();">
                        <input type="hidden" name="id" value="<?php echo $lance['id']; ?>">
                        <input type="hidden" name="action" value="deletar">
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
            <?php
        }

        echo "</table>";
    }
    ?>
</main>

<script type="text/javascript">
    function confirma_excluir() {
        return confirm("Confirma exclusão?");
    }
</script>

</body>
</html>