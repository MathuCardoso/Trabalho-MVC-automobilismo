<?php

namespace App\service;

use App\model\Piloto;
use App\repository\EquipeDAO;
use App\repository\PilotoDAO;

class PilotoService
{

    private PilotoDao $pilotoD;
    private EquipeDAO $equipeD;

    public function __construct()
    {
        $this->pilotoD = new PilotoDAO();
        $this->equipeD = new EquipeDAO();
    }

    public function validate(Piloto $piloto)
    {
        $erros = [];

        if (!$piloto->getNome()) {
            $erros['nome'] = "Preencha este campo.";
        } else if (!str_contains($piloto->getNome(), " ")) {
            $erros['nome'] = "Preencha o sobrenome.";
        }
        if (!$piloto->getIdade()) {
            $erros['idade'] = "Preencha este campo.";
        } else if (!is_int($piloto->getIdade())) {
            $erros['idade'] = "Digite um número!";
        } else if ($piloto->getIdade() >= 70) {
            $erros['idade'] = "Idoso.";
        }
        if (!$piloto->getNacionalidade()) {
            $erros['nacional'] = "Preencha este campo.";
        }

        if (!$piloto->getNumero()) {
            $erros['numero'] = "Preencha este campo.";
        } else if (
            $piloto->getId() === 0 &&
            $this->pilotoD->findByNumber($piloto->getNumero())
        ) {
            $erros['numero'] = "Esse número já está em uso.";
        }

        if (!$piloto->getEquipe()->getId()) {
            $erros['equipe'] = "Preencha este campo.";
        } else if (!$this->equipeD->isEquipeLivre($piloto->getEquipe())) {
            $erros['equipe'] = "Dupla já formada.";
        }


        return $erros;
    }
}
