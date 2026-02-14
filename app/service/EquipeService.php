<?php

namespace App\service;

use App\model\Equipe;

class EquipeService
{

    public function validate(Equipe $e)
    {
        $erros = [];

        if (!$e->getNome()) {
            $erros['nome'] = "Preencha este campo";
        }

        if (!$e->getSede()) {
            $erros['sede'] = "Preencha este campo";
        }

        if (!$e->getCor1()) {
            $erros['cor1'] = "Preencha este campo";
        }

        if (!$e->getCor2()) {
            $erros['cor2'] = "Preencha este campo";
        }

        if (!$e->getCategoria()->getId()) {
            $erros['categoria'] = "Preencha este campo";
        }

        return $erros;
    }
}
