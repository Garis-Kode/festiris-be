<?php

namespace App\Helpers;

class Router
{
    /**
     * Includes all files in a folder
     *
     * @param string $folder
     * @return void
     */
    public static function includeFiles(string $folder): void
    {
        $files = glob($folder . '/*.php');
        foreach ($files as $file) {
            require_once $file;
        }
    }
}