<?php

namespace Borges\Comercial\Dominio\Model;

class ProdutoViewer{

    public function listItemProduto(Produto $produto)
        {
            $preco = ($produto->getPreco() / 100) * $produto->getQuantidade();
            $quantidade = str_replace(".", ",", (string)$produto->getQuantidade());
            $precoString = number_format($preco, 2, ",", "");
            echo "<li class='detalhes-produto'><span class='quantidade-produto'>$quantidade</span> <span class='nome-produto'>{$produto->getNome()}</span> <span class='preco-produto'>R$ $precoString</span> <span class='data-produto'>{$produto->getDataDeCompra()}</span></li>";

            return $preco;
        }
} 
