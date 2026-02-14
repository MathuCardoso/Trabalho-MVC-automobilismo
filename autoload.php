<?php
require_once __DIR__ . "/configs/App.php";

spl_autoload_register(function (string $fullClassName) {
    $prefix = "App\\";
    $appUrl = App::DIR_APP;

    $len = strlen($prefix);

    if (!str_starts_with($fullClassName, $prefix)) {
        return;
    }

    $nomeRelativoClass = substr($fullClassName, $len);
    
    $filePath = $appUrl .
        str_replace("\\", DIRECTORY_SEPARATOR, $nomeRelativoClass) . ".php";

    if (file_exists($filePath)) {
        require_once $filePath;
    }
});
