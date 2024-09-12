<?php
require_once('../models/Lance.php');
require_once('../models/LanceDAO.php');
require_once('../models/ProdutoDAO.php');
require_once('../componentes/config_upload.php');

# CADASTRO LANCE
if (isset($_POST['cadastrar'])) {
    $produto_id = $_POST['produto_id'];
    $pessoa_id = $_POST['pessoa_id'];
    $valor = $_POST['valor'];

    // Validação dos campos
    if (!empty($produto_id) && !empty($pessoa_id) && !empty($valor)) {

        // Instancia o ProdutoDAO e recupera as informações do produto
        $produtoDAO = new ProdutoDAO();
        $produto = $produtoDAO->getProdutoById($produto_id);

        if ($produto) {
            $preco_minimo = $produto['lance_minimo']; // Ajuste conforme o nome da coluna
            $preco_atual = isset($produto['preco_atual']) ? $produto['preco_atual'] : 0; // Ajuste conforme o nome da coluna

            // Verifica se o valor do lance é maior ou igual ao preço mínimo
            if ($valor >= $preco_minimo) {

                // Cria uma instância da classe Lance
                $lance = new Lance();
                $lance->setProdutoId($produto_id);
                $lance->setPessoaId($pessoa_id);
                $lance->setValor($valor);

                // Instancia o LanceDAO e insere o lance
                $lanceDAO = new LanceDAO(); // Usa o construtor para conectar ao banco de dados
                $retorno = $lanceDAO->inserirLance($lance);

                if ($retorno) {
                    // Verifica se o novo lance é maior que o lance atual (preco_atual)
                    if ($valor > $preco_atual) {
                        // Atualiza o preço atual do produto e o lance atual
                        $novo_lance_id = $lanceDAO->getUltimoLanceId(); // Recupera o ID do último lance inserido
                    }

                    echo "Lance inserido com sucesso!";
                    header('Location:../views/index.php');
                    exit(); // Garante que o script termina após o redirecionamento
                } else {
                    echo "Erro ao inserir lance.";
                }
            } else {
                echo "O valor do lance deve ser maior ou igual ao preço mínimo.";
            }
        } else {
            echo "Produto não encontrado.";
        }
    } else {
        echo "Preencha todos os campos obrigatórios.";
    }
}

#ALTERAR LANCE
if (isset($_POST['alterar'])) {
    // Verifica se o id foi enviado corretamente
    $lance_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $produto_id = isset($_POST['produto_id']) ? (int)$_POST['produto_id'] : 0;
    $pessoa_id = isset($_POST['pessoa_id']) ? (int)$_POST['pessoa_id'] : 0;
    $valor = isset($_POST['valor']) ? (float)$_POST['valor'] : 0.0;

    // Verifica se todos os dados obrigatórios foram enviados
    if ($lance_id > 0 && $produto_id > 0 && $pessoa_id > 0 && $valor > 0) {
        // Instancia a classe Lance e preenche com os dados recebidos
        $lance = new Lance();
        $lance->setId($lance_id);
        $lance->setProdutoId($produto_id);
        $lance->setPessoaId($pessoa_id);
        $lance->setValor($valor);

        // Instancia o DAO e tenta fazer a alteração
        $lanceDAO = new LanceDAO();
        $retorno = $lanceDAO->alterarLance($lance);

        if ($retorno) {
            // Se a alteração for bem-sucedida, redireciona para a página de gerenciamento de lances
            header('Location:../views/gerenciarLances.php');
            exit;
        } else {
            echo 'Erro ao alterar o lance.';
        }
    } else {
        echo 'Preencha todos os campos obrigatórios.';
    }
}

#DELETAR PRODUTO
if (isset($_POST['action']) && $_POST['action'] === 'deletar') {
    // Recupera o ID do lance a ser deletado via POST
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id > 0) {
        // Instancia o LanceDAO e tenta deletar o lance
        $lanceDAO = new LanceDAO();
        $retorno = $lanceDAO->deletarLance($id);

        if ($retorno) {
            // Redireciona de volta para a página de gerenciamento se a deleção for bem-sucedida
            header('Location:../views/gerenciarLances.php');
            exit;
        } else {
            echo 'Erro ao deletar o lance.';
        }
    } else {
        echo 'ID inválido.';
    }
}
?>