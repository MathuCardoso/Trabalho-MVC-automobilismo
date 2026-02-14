<?php

namespace App\service;

use App;
use Exception;
use RuntimeException;

class Service
{
    public function saveFile(array $file, object $obj, string $folderName)
    {

        $fileArray = explode(".", $file['name']);
        $fileExtension = ".{$fileArray[1]}";
        $fileNameToSave = $obj->getNome() . uniqid() . $fileExtension;
        $fileNameToSave = str_replace(" ", "", $fileNameToSave);

        if (move_uploaded_file($file['tmp_name'], App::DIR_UPLOADS . "{$folderName}/{$fileNameToSave}")) {
            return App::URL_UPLOADS . "{$folderName}/{$fileNameToSave}";
        } else {
            throw new RuntimeException("Não foi possível salvar o arquivo.");
        }
    }

    public function unlinkFile(string $fileName)
    {
        $fileName = str_replace("/", "\\", $fileName);
        $absolutePath = __DIR__ . '/../../' . $fileName;


        if (!file_exists($absolutePath)) {
            return false;
        }

        if (!unlink($absolutePath)) {
            "Erro ao excluir arquivo.";
            return false;
        }

        return true;
    }
}
