<?php

    namespace Borges\Comercial\Infraestrutura\Persistencia;
    
    use PDO;
    use PDOException;

    class CriadorConexao
    {
        public static function criarConexao()
        {
            try{
                $pdo = new PDO("mysql:host=localhost;dbname=comercio", "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            }
            catch(PDOException $exception)
            {
                echo "Error: " . $exception->getMessage();
            }
        }

        public static function serverName(){
            return "localhost";
        }
    }
