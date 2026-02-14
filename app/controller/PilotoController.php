<?php

namespace App\controller;

use App;
use App\controller\Controller;
use App\model\Equipe;
use App\model\Piloto;
use App\repository\EquipeDAO;
use App\repository\PilotoDAO;
use App\service\PilotoService;
use App\service\Service;
use PDOException;

class PilotoController extends Controller
{
    private PilotoService $pilotoS;
    private Service $service;
    private PilotoDAO $pilotoD;
    private EquipeDAO $equipeD;

    public function __construct()
    {
        $this->pilotoS = new PilotoService();
        $this->service = new Service();
        $this->pilotoD = new PilotoDAO();
        $this->equipeD = new EquipeDAO();
    }

    public function index()
    {

        $this->loadView(
            'piloto/pilotos',
            [
                'pilotos' => $this->list(),
                "equipes" => $this->equipeD->list()
            ]
        );
    }

    public function list()
    {
        return $this->pilotoD->list();
    }

    public function findPilotoById(int $id)
    {
        return $this->pilotoD->findById($id);
    }

    public function create()
    {

        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
        $idade = is_numeric($_POST['idade']) ? trim($_POST['idade']) : null;
        $nacional = isset($_POST['nacional']) ? trim($_POST['nacional']) : null;
        $numero = is_numeric($_POST['numero']) ? trim($_POST['numero']) : null;
        $foto = $_FILES['foto'] ?? null;
        $idEquipe = is_numeric($_POST['equipe']) ? trim($_POST['equipe']) : null;

        $piloto = new Piloto();
        $piloto->setNome($nome);
        $piloto->setIdade($idade);
        $piloto->setNacionalidade($nacional);
        $piloto->setNumero($numero);
        $piloto->setFotoPerfil($foto);
        $equipe = new Equipe();
        $equipe->setId($idEquipe);
        $piloto->setEquipe($equipe);

        $erros = $this->pilotoS->validate($piloto);

        if (empty($erros)) {
            try {
                if (!($foto['size'] <= 0)) {
                    $piloto->setFotoPerfil($this->service->saveFile($foto, $piloto, "pilotos"));
                } else {
                    $piloto->setFotoPerfil(App::URL_ASSETS . "racer_default.png");
                }
                $this->pilotoD->insert($piloto);
                header("location: /pilotos");
                exit;
            } catch (PDOException $p) {
                echo "Erro ao inserir piloto.";
                echo $p->getMessage();
                exit;
            }
        }
        $this->loadView(
            "piloto/pilotos",
            [
                'erros' => $erros,
                'piloto' => $piloto,
                'pilotos' => $this->list(),
                'equipes' => $this->equipeD->list()
            ]
        );
    }

    public function update()
    {
        $id = isset($_POST['id']) && $_POST['id'] > 0 ? $_POST['id'] : null;

        $piloto = $this->findPilotoById($id);

        if (!$piloto)
            return "Piloto não encontrado";

        if (isset($_POST['__status']) && $_POST['__status'] === "submitted") {

            $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
            $idade = isset($_POST['idade']) ? trim($_POST['idade']) : null;
            $nacional = isset($_POST['nacional']) ? trim($_POST['nacional']) : null;
            $numero = isset($_POST['numero']) ? trim($_POST['numero']) : null;
            $foto = $_FILES['foto'] ?? null;
            $idEquipe = is_numeric($_POST['equipe']) ? trim($_POST['equipe']) : null;

            $pilotoPut = new Piloto();
            $pilotoPut->setId($piloto->getId());
            $pilotoPut->setNome($nome);
            $pilotoPut->setIdade($idade);
            $pilotoPut->setNacionalidade($nacional);
            $pilotoPut->setNumero($numero);
            $pilotoPut->setFotoPerfil($foto);
            $equipe = new Equipe();
            $equipe->setId($idEquipe);
            $pilotoPut->setEquipe($equipe);


            $erros = $this->pilotoS->validate($pilotoPut);

            if (empty($erros)) {
                try {
                    if ($foto) {
                        if ($foto['size'] <= 0) {
                            $pilotoPut->setFotoPerfil($piloto->getFotoPerfil());
                        } else {
                            if ($piloto->getFotoPerfil() !== App::DIR_RACER_DEFAULT) {
                                if ($this->service->unlinkFile($piloto->getFotoPerfil())) {
                                    $pilotoPut->setFotoPerfil($this->service->saveFile($foto, $pilotoPut, "pilotos"));
                                }
                            }
                        }
                    } else {
                        $pilotoPut->setFotoPerfil(App::DIR_RACER_DEFAULT);
                    }
                    $this->pilotoD->update($pilotoPut);
                    header("location: pilotos");
                    exit;
                } catch (PDOException $p) {
                    echo "Erro ao atualizar piloto.";
                    echo $p->getMessage();
                    exit;
                }
            }
        }
        $this->loadView(
            "piloto/pilotos",
            [
                'erros' => $erros ?? null,
                'piloto' => $piloto,
                'pilotos' => $this->list(),
                'equipes' => $this->equipeD->list()
            ]
        );
    }

    public function destroy()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            return "Id não informado.";
        }

        if ($piloto = $this->findPilotoById($id)) {

            if ($this->service->unlinkFile($piloto->getFotoPerfil())) {

                try {
                    $this->pilotoD->delete($piloto->getId());
                    header("location: /pilotos");
                    exit;
                } catch (PDOException $p) {
                    echo "Erro ao deletar piloto de id {$id}";
                    echo $p->getMessage();
                }
            } else {
                echo "O caminho deve estar errado.<br>";
                echo $piloto->getFotoPerfil();
            }
        } else {
            return "O piloto de id {$id} não existe.";
        }
    }
}
