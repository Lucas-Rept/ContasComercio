<?php

    require_once "autoload.php";

    use Borges\Comercial\Dominio\Model\Cliente;
    use Borges\Comercial\Infraestrutura\Repositorio\PdoRepositorioCliente;
    use Borges\Comercial\Infraestrutura\Persistencia\CriadorConexao;
use Borges\Comercial\Infraestrutura\Repositorio\PdoRepositorioProduto;

    if(isset($_POST)){
        $id = $_POST['id_cliente'];
    }

    $cliente = new Cliente($id, "sem nome", "sem endereço");
    $repositorioProduto = new PdoRepositorioProduto(CriadorConexao::criarConexao());
    $repositorioCliente = new PdoRepositorioCliente(CriadorConexao::criarConexao());

    $repositorioProduto->deleteAllCliente($id);
    $repositorioCliente->delete($cliente);
    $servername = CriadorConexao::serverName();

    header("location: http://$servername/contasComercio");

