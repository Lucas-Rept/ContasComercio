<?php

    namespace Borges\Comercial\Infraestrutura\Repositorio;

    use Borges\Comercial\Dominio\Repositorio\RepositorioCliente;
    use Borges\Comercial\Dominio\Model\Cliente;
    use PDO;

    class PdoRepositorioCliente implements RepositorioCliente{

        private PDO $conexao;

        public function __construct(PDO $conexao)
        {
            $this->conexao = $conexao;
        }

        public function create(Cliente $cliente){
            if($cliente->getId() == NULL){
                $slqInsert = "INSERT INTO cliente (nome, endereco, data) VALUES (:nome, :endereco, :data)";
                $stmt = $this->conexao->prepare($slqInsert);
                $stmt->bindValue(":nome", $cliente->getNome(), PDO::PARAM_STR);
                $stmt->bindValue(":endereco", $cliente->getEndereco(), PDO::PARAM_STR);
                $stmt->bindValue(":data", $cliente->getDataConta(), PDO::PARAM_STR);
                $sucesso = $stmt->execute();

                if($sucesso){
                    $cliente->setId($this->conexao->lastInsertId());
                }
            }
        }

        public function delete(Cliente $cliente){
            $sqlDelete = "DELETE FROM cliente WHERE id = :id";
            $stmt = $this->conexao->prepare($sqlDelete);
            $stmt->bindValue(":id", $cliente->getId(), PDO::PARAM_INT);
            $stmt->execute();
        }

        public function update(Cliente $cliente){
            if($cliente->getId() != NULL){
                $sqlUpdate = "UPDATE cliente SET nome = :nome, endereco = :endereco";
                $stmt = $this->conexao->prepare($sqlUpdate);
                $stmt->bindValue(":nome", $cliente->getNome(), PDO::PARAM_STR);
                $stmt->bindValue(":endereco", $cliente->getEndereco(), PDO::PARAM_STR);
                $stmt->execute();
            }
        }

        public function read(Cliente $cliente){
            if($cliente->getId() != NULL){
                $sqlConsult = "SELECT * FROM cliente WHERE id = :id";
                $stmt = $this->conexao->prepare($sqlConsult);
                $stmt->bindValue(":id", $cliente->getId(), PDO::PARAM_INT);
                $stmt->execute();
                
                if($stmt->rowCount() > 0){
                    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($resultado as $dados){ 
                        $cliente->setNome($dados['nome']);
                        $cliente->setEndereco($dados['endereco']);
                        $cliente->setDataConta($dados['data']);
                    }
                }
            }
        }

        public function readAll()
        {
            $sqlConsult = "SELECT * FROM cliente ORDER BY nome";
            $stmt = $this->conexao->query($sqlConsult);
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $clientes = [];

            foreach($resultado as $dados){
                $cliente = new Cliente($dados['id'], $dados['nome'], $dados['endereco']);
                $cliente->setDataConta($dados['data']);
                $clientes[] = $cliente;
            }

            return $clientes;
        }

        public function readByName(string $nome){
            $sqlConsult = "SELECT * FROM cliente WHERE nome LIKE ('$nome%') ORDER BY nome";
            $stmt = $this->conexao->query($sqlConsult);
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $clientes = [];

            foreach($resultado as $dados){
                $cliente = new Cliente($dados['id'], $dados['nome'], $dados['endereco']);
                $cliente->setDataConta($dados['data']);
                $clientes[] = $cliente;
            }

            return $clientes;
        }
    }
