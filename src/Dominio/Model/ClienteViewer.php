<?php

    namespace Borges\Comercial\Dominio\Model;

    class ClienteViewer{

        public function linkContaGen(Cliente $cliente)
        {
            echo "<li class='cliente-link'><a href='clientePagina.php?id={$cliente->getId()}'>{$cliente->getNome()} | {$cliente->getEndereco()}</a> <button class='deletar-conta-botao' idCliente = '{$cliente->getId()}'>Deletar</button></li>";
        }

    }
