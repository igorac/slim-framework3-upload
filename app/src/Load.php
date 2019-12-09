<?php

namespace App\src;

class Load
{

    /**
     * Responsável por carregar o arquivo
     * 
     * @param string $file
     */
    public static function file(string $file): array
    {   
        $filePath = path().$file;

        if (!file_exists($filePath)) {
            throw new \Exception("Esse arquivo não existe: {$filePath}");
        } 

        return require $filePath;
    }
}