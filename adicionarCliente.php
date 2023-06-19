<?php

    require_once "autoload.php";

    use Borges\Comercial\Dominio\Model\Cliente;
    use Borges\Comercial\Infraestrutura\Repositorio\PdoRepositorioCliente;
    use Borges\Comercial\Infraestrutura\Persistencia\CriadorConexao;

    if(isset($_POST)){
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
    }

    $cliente = new Cliente(NULL, $nome, $endereco);
    $repositorio = new PdoRepositorioCliente(CriadorConexao::criarConexao());

    $repositorio->create($cliente);
    $servername = CriadorConexao::serverName();

    header("location: http://$servername/contasComercio");

