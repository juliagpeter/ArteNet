<?php
Class LanceDAO {
    private $conexao;

    public function __construct() {
        try {
            $this->conexao = new PDO("mysql:host=localhost;dbname=artenet;charset=utf8", "root", "");
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function inserirLance(Lance $lance) {
        try {
            $query = $this->conexao->prepare(
                "INSERT INTO lances (produto_id, pessoa_id, valor) 
                 VALUES (:produto_id, :pessoa_id, :valor)"
            );

            $resultado = $query->execute([
                'produto_id' => $lance->getProdutoId(),
                'pessoa_id' => $lance->getPessoaId(),
                'valor' => $lance->getValor()
            ]);

            return $resultado;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function getUltimoLanceId() {
        try {
            $query = $this->conexao->query("SELECT LAST_INSERT_ID() AS id");
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['id'];
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    public function listarLances() {
        try {
            $query = $this->conexao->prepare("SELECT * FROM lances");
            $query->execute();
            $lances = $query->fetchAll(PDO::FETCH_ASSOC);
            return $lances;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function getLanceById($lance_id) {
        try {
            $query = $this->conexao->prepare("SELECT * FROM lances WHERE id = :id");
            $query->execute(['id' => $lance_id]);
            $lance = $query->fetch(PDO::FETCH_ASSOC);
            return $lance;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function alterarLance($lance) {
        try {
            $query = $this->conexao->prepare("
            UPDATE lances
            SET valor = :valor, produto_id = :produto_id, pessoa_id = :pessoa_id
            WHERE id = :id
        ");
            $resultado = $query->execute([
                'valor' => $lance->getValor(),
                'produto_id' => $lance->getProdutoId(),
                'pessoa_id' => $lance->getPessoaId(),
                'id' => $lance->getId()
            ]);
            return $resultado;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }


    public function deletarLance($lance_id) {
        try {
            $query = $this->conexao->prepare("DELETE FROM lances WHERE id = :id");
            $resultado = $query->execute(['id' => $lance_id]);
            return $resultado;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}
?>
