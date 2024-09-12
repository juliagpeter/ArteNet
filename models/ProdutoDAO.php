<?php
class ProdutoDAO {
    private $conexao;

    public function __construct() {
        try {
            $this->conexao = new PDO("mysql:host=localhost;dbname=artenet;charset=utf8", "root", "");
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function inserirProduto($produto) {
        try {
            $query = $this->conexao->prepare(
                "INSERT INTO produto (nome, descricao, lance_minimo, tecnica, categoria_id, artista_id, imagem, estoque)
                 VALUES (:nome, :descricao, :lance_minimo, :tecnica, :categoria_id, :artista_id, :imagem, :estoque)"
            );

            $resultado = $query->execute([
                'nome' => $produto->getNome(),
                'descricao' => $produto->getDescricao(),
                'lance_minimo' => $produto->getLanceMinimo(),
                'tecnica' => $produto->getTecnica(),
                'categoria_id' => $produto->getCategoriaId(),
                'artista_id' => $produto->getArtistaId(),
                'imagem' => $produto->getImagem(),
                'estoque' => $produto->getEstoque()
            ]);
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function alterarProduto($produto) {
        try {
            $query = $this->conexao->prepare(
                "UPDATE produto 
                 SET nome = :nome, descricao = :descricao, lance_minimo = :lance_minimo, tecnica = :tecnica, 
                     categoria_id = :categoria_id, artista_id = :artista_id, imagem = :imagem, estoque = :estoque
                 WHERE produto_id = :produto_id"
            );

            $resultado = $query->execute([
                'nome' => $produto->getNome(),
                'descricao' => $produto->getDescricao(),
                'lance_minimo' => $produto->getLanceMinimo(),
                'tecnica' => $produto->getTecnica(),
                'categoria_id' => $produto->getCategoriaId(),
                'artista_id' => $produto->getArtistaId(),
                'imagem' => $produto->getImagem(),
                'estoque' => $produto->getEstoque(),
                'produto_id' => $produto->getProdutoId()
            ]);
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deletarProduto($produto) {
        try {
            $query = $this->conexao->prepare("DELETE FROM produto WHERE produto_id = :produto_id");
            $resultado = $query->execute(['produto_id' => $produto->getProdutoId()]);
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function listarProduto() {
        try {
            $query = $this->conexao->prepare("
            SELECT 
                p.*, 
                pe.nome AS nome_artista, 
                pe.imagem AS imagem_artista, 
                c.nome AS categoria,
                COALESCE(MAX(l.valor), 0) AS lance_atual
            FROM 
                produto p
            LEFT JOIN 
                categoria c ON p.categoria_id = c.categoria_id
            LEFT JOIN 
                artista a ON p.artista_id = a.artista_id
            LEFT JOIN 
                pessoa pe ON a.pessoa_id = pe.pessoa_id
            LEFT JOIN 
                lances l ON p.produto_id = l.produto_id
            GROUP BY 
                p.produto_id
        ");
            $query->execute();
            $produtos = $query->fetchAll();
            return $produtos;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function buscarProduto($produto) {
        try {
            $query = $this->conexao->prepare("
            SELECT 
                p.*, 
                pe.nome AS nome_artista, 
                pe.imagem AS imagem_artista, 
                c.nome AS categoria,
                COALESCE(MAX(l.valor), 0) AS lance_atual
            FROM 
                produto p
            LEFT JOIN 
                categoria c ON p.categoria_id = c.categoria_id
            LEFT JOIN 
                artista a ON p.artista_id = a.artista_id
            LEFT JOIN 
                pessoa pe ON a.pessoa_id = pe.pessoa_id
            LEFT JOIN 
                lances l ON p.produto_id = l.produto_id
            GROUP BY 
                p.produto_id
            ");
            $query->execute(['produto_id' => $produto->getProdutoId()]);
            $produto = $query->fetch(PDO::FETCH_ASSOC);
            return $produto ? $produto : false;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function pesquisarProduto($produto) {
        try {
            $query = $this->conexao->prepare("
SELECT p.*, 
       COALESCE(MAX(l.valor), 0) AS lance_atual,
       c.nome AS categoria
FROM produto p
LEFT JOIN lances l ON p.produto_id = l.produto_id
LEFT JOIN categoria c ON p.categoria_id = c.categoria_id
WHERE UPPER(p.nome) LIKE UPPER(:nome)
GROUP BY p.produto_id;

");
            $query->execute(['nome' => '%' . strtoupper($produto->getNome()) . '%']);
            $produtos = $query->fetchAll(PDO::FETCH_ASSOC);
            return $produtos ? $produtos : false;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getProdutoById($produto_id) {
        try {
            $query = $this->conexao->prepare("SELECT * FROM produto WHERE produto_id = :produto_id");
            $query->execute(['produto_id' => $produto_id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }


    public function listarArtistas() {
        try {
            $query = $this->conexao->prepare("
            SELECT a.artista_id, p.nome AS nome_artista 
            FROM artista a
            INNER JOIN pessoa p ON a.pessoa_id = p.pessoa_id
        ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function listarCategorias() {
        try {
            $query = $this->conexao->prepare("SELECT categoria_id, nome FROM categoria");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>