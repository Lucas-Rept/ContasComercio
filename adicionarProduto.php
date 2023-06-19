<?php

require_once "autoload.php";

use Borges\Comercial\Infraestrutura\Persistencia\CriadorConexao;
use Borges\Comercial\Infraestrutura\Repositorio\PdoRepositorioProduto;
use Borges\Comercial\Dominio\Model\Produto;

if(isset($_POST)){
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $id_cliente = $_POST['id_cliente'];
}

$preco = floatval($preco);
$preco = $preco * 100;

$produto = new Produto(NULL, $id_cliente, $nome, $preco, $quantidade);

$repositorio = new PdoRepositorioProduto(CriadorConexao::criarConexao());
$repositorio->create($produto);

$servername = CriadorConexao::serverName();

header("location: http://$servername/contasComercio/clientePagina.php?id=$id_cliente");