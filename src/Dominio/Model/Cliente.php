<?php

    namespace Borges\Comercial\Dominio\Model;

use DateTime;

    class Cliente{
        private ?int $id;
        private string $nome;
        private string $endereco;
        private DateTime $dataAtualizacao;
        private string $dataConta;

        public function __construct(?int $id, string $nome, string $endereco)
        {
            $this->id = $id;
            $this->nome = $nome;
            $this->endereco = $endereco;
            $this->dataAtualizacao = new DateTime();
            $this->dataConta = $this->dataAtualizacao->format("Y/m/d H:i:s");
        }

        public function getId() : ?int
        {
            return $this->id;
        }

        public function getNome() : string
        {
            return $this->nome;
        }

        public function getEndereco() : string
        {
            return $this->endereco;
        }

        public function getDataConta() : string
        {
            $data = $this->dataConta;
            $data = substr($data, 0, 10);
            $data = implode("/", array_reverse(explode("-", $data)));

            return $data;
        }

        public function setId(?int $id) : void
        {
            $this->id = $id;
        }

        public function setNome(string $nome) : void
        {
            $this->nome = $nome;
        }

        public function setEndereco(string $endereco) : void
        {
            $this->endereco= $endereco;
        }

        public function setDataConta(string $data) : void
        {
            $this->dataConta = $data;
        }
    }
