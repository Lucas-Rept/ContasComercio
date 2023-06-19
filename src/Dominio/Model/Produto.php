<?php

    namespace Borges\Comercial\Dominio\Model;
    use DateTime;

    class Produto{

        private ?int $id;
        private int $id_cliente;
        private string $nome;
        private int $preco;
        private float $quantidade;
        private DateTime $dataDeAtualizacao;
        private string $dataDeCompra;

        public function __construct(?int $id, int $id_cliente, string $nome, int $preco, float $quantidade)
        {
            $this->id = $id;
            $this->id_cliente = $id_cliente;
            $this->nome = $nome;
            $this->preco = $preco;
            $this->quantidade = $quantidade;
            $this->dataDeAtualizacao = new DateTime();
            $this->dataDeCompra = $this->dataDeAtualizacao->format("Y/m/d H:i:s");
        }

        public function getId() : ?int
        {
            return $this->id;
        }

        public function getIdCliente() : int
        {
            return $this->id_cliente;
        }

        public function getNome() : string
        {
            return $this->nome;
        }

        public function getPreco() : int
        {
            return $this->preco;
        }

        public function getQuantidade() : float
        {
            return $this->quantidade;
        }

        public function getDataDeCompra() : string
        {
            $data = $this->dataDeCompra;
            $data =  substr($data, 0, 10);
            $data = implode("/", array_reverse(explode("-", $data)));
            return $data;
        }

        public function setId(?int $id) : void
        {
            $this->id = $id;
        }

        public function setIdCliente(int $id_cliente) : void 
        {
            $this->id_cliente = $id_cliente;
        }

        public function setNome(string $nome) : void
        {
            $this->nome = $nome;
        }

        public function setPreco(int $preco) : void
        {
            $this->preco = $preco;
        }

        public function setQuantidade(int $quantidade) : void
        {
            $this->quantidade = $quantidade;
        }

        public function setDataDeCompra(string $data) : void
        {   
            $this->dataDeCompra = $data;
        }
    }