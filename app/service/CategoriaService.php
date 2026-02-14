<?php

namespace App\service;

use App;
use App\model\Categoria;
use RuntimeException;

class CategoriaService
{

    public function validate(Categoria $c, bool $logoValidate = true)
    {
        $erros = [];
        if (!$c->getNome()) {
            $erros['nome'] = "Preencha este campo.";
        }

        if ($logoValidate) {
            if ($c->getLogo()['size'] <= 0) {
                $erros['logo'] = "Escollha uma logo.";
            }
        }


        return $erros;
    }
}
