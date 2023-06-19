<?php

    namespace Borges\Comercial\Infraestrutura\Repositorio;

    use Borges\Comercial\Dominio\Repositorio\RepositorioProduto;
    use Borges\Comercial\Dominio\Model\produto;
    use PDO;

    class PdoRepositorioProduto implements RepositorioProduto{

        private PDO $conexao;

        public function __construct(PDO $conexao)
        {
            $this->conexao = $conexao;
        }

        public function create(Produto $produto){
            if($produto->getId() == NULL){
                $slqInsert = "INSERT INTO produto (id_cliente, nome, preco, quantidade, data) VALUES (:id_cliente, :nome, :preco, :quantidade, :data)";
                $stmt = $this->conexao->prepare($slqInsert);
                $stmt->bindValue(":id_cliente", $produto->getIdCliente(), PDO::PARAM_INT);
                $stmt->bindValue(":nome", $produto->getNome(), PDO::PARAM_STR);
                $stmt->bindValue(":preco", $produto->getPreco(), PDO::PARAM_INT);
                $stmt->bindValue(":quantidade", $produto->getQuantidade(), PDO::PARAM_STR);
                $stmt->bindValue(":data", $produto->getDataDeCompra(), PDO::PARAM_STR);
                $sucesso = $stmt->execute();

                if($sucesso){
                    $produto->setId($this->conexao->lastInsertId());
                }
            }
        }

        public function delete(Produto $produto){
            $sqlDelete = "DELETE FROM produto WHERE id = :id";
            $stmt = $this->conexao->prepare($sqlDelete);
            $stmt->bindValue(":id", $produto->getId(), PDO::PARAM_INT);
            $stmt->execute();
        }

        public function update(Produto $produto){
            if($produto->getId() != NULL){
                $sqlUpdate = "UPDATE produto SET id_usuario = :id_usuario, nome = :nome, preco = :preco, quantidade = :quantidade";
                $stmt = $this->conexao->prepare($sqlUpdate);
                $stmt->bindValue(":id_cliente", $produto->getIdCliente(), PDO::PARAM_INT);
                $stmt->bindValue(":nome", $produto->getNome(), PDO::PARAM_STR);
                $stmt->bindValue(":preco", $produto->getPreco(), PDO::PARAM_INT);
                $stmt->bindValue(":quantidade", $produto->getQuantidade(), PDO::PARAM_STR);
                $stmt->execute();
            }
        }

        public function read(Produto $produto){
            if($produto->getId() != NULL){
                $sqlConsult = "SELECT * FROM produto WHERE id = :id";
                $stmt = $this->conexao->prepare($sqlConsult);
                $stmt->bindValue(":id", $produto->getId(), PDO::PARAM_INT);
                $stmt->execute();
                
                if($stmt->rowCount() > 0){
                    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($resultado as $dados){ 
                        $produto->setIdCliente($dados['id_cliente']);
                        $produto->setNome($dados['nome']);
                        $produto->setPreco($dados['preco']);
                        $produto->setQuantidade($dados['quantidade']);
                        $produto->setDataDeCompra($dados['data']);
                    }
                }
            }
        }

        public function readAll()
        {
            $sqlConsult = "SELECT * FROM produto ORDER BY data";
            $stmt = $this->conexao->query($sqlConsult);
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $produtos = [];

            foreach($resultado as $dados){
                $produto = new Produto($dados['id'], $dados['id_cliente'], $dados['nome'], $dados['preco'], $dados['quantidade']);
                $produto->setDataDeCompra($dados['data']);
                $produtos[] = $produto;

            }

            return $produtos;
        }

        public function readAllCliente(int $idCliente)
        {
            $sqlConsult = "SELECT * FROM produto WHERE id_cliente = :id_cliente ORDER BY data";
            $stmt = $this->conexao->prepare($sqlConsult);
            $stmt->bindValue(":id_cliente", $idCliente, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $produtos = [];

            foreach($resultado as $dados){
                $produto = new Produto($dados['id'], $dados['id_cliente'], $dados['nome'], $dados['preco'], $dados['quantidade']);
                $produto->setDataDeCompra($dados['data']);
                $produtos[] = $produto;

            }

            return $produtos;
        }

        function deleteAllCliente(int $idCliente)
        {
            $sqlDelete = "DELETE FROM produto WHERE id_cliente = :id_cliente";
            $stmt = $this->conexao->prepare($sqlDelete);
            $stmt->bindValue(":id_cliente", $idCliente, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
