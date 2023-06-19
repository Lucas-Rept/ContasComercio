<?php

    namespace Borges\Comercial\Dominio\Repositorio;
    use Borges\Comercial\Dominio\Model\Cliente;

    interface RepositorioCliente{
        public function create(Cliente $cliente);
        public function delete(Cliente $cliente);
        public function update(Cliente $cliente);
        public function read(Cliente $cliente);
        public function readAll();
    }
    