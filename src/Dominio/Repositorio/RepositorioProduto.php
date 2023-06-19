<?php

    namespace Borges\Comercial\Dominio\Repositorio;
    use Borges\Comercial\Dominio\Model\Produto;

    interface RepositorioProduto{
        public function create(Produto $produto);
        public function delete(Produto $produto);
        public function update(Produto $produto);
        public function read(Produto $produto);
        public function readAll();
        public function readAllCliente(int $idCliente);
        public function deleteAllCliente(int $idCliente);
    }
    