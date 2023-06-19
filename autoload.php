<?php

spl_autoload_register(
    function(string $nomeCompletoClasse)
    {
        $caminhoCompleto = str_replace("Borges\\Comercial", "src", $nomeCompletoClasse);
        $caminhoArquivo = str_replace("\\", DIRECTORY_SEPARATOR, $caminhoCompleto);
        $caminhoArquivo .= ".php";
        if(file_exists($caminhoArquivo))
        {
            require_once $caminhoArquivo;
        }
    }
);
