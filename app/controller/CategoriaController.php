<?php

namespace App\controller;

use App;
use App\controller\Controller;
use App\model\Categoria;
use App\repository\CategoriaDAO;
use App\service\CategoriaService;
use App\service\Service;
use PDOException;

class CategoriaController extends Controller
{

    private CategoriaDAO $catDAO;
    private CategoriaService $catService;
    private Service $service;

    public function __construct()
    {
        $this->catDAO = new CategoriaDAO();
        $this->catService = new CategoriaService();
        $this->service = new Service();
    }

    public function index()
    {
        $this->loadView(
            'categoria/categorias',
            ['categorias' => $this->getAll()]
        );
    }

    public function findCategoria(int $id)
    {
        return $this->catDAO->findById($id);
    }

    public function getAll()
    {
        return $this->catDAO->list();
    }

    public function create()
    {
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
        $logo = $_FILES['logo'] ?? null;

        $categoria = new Categoria();
        $categoria->setNome($nome);
        $categoria->setLogo($logo);


        $erros = $this->catService->validate($categoria);

        if (empty($erros)) {

            try {
                $logo = $this->service->saveFile($logo, $categoria, "categorias");
                $categoria->setLogo($logo);
                $this->catDAO->insert($categoria);
                header("location: /categorias");
                exit;
            } catch (PDOException $p) {
                echo "Erro ao inserir categoria no banco de dados.";
                echo $p->getMessage();
                return;
            }
        }

        $this->loadView(
            "categoria/categorias",
            [
                "erros" => $erros,
                "categorias" => $this->getAll(),
            ]
        );
    }

    public function update()
    {
        $id = isset($_POST['id']) && $_POST['id'] > 0 ? $_POST['id'] : null;

        $categoria = $this->findCategoria($id);

        if (!$categoria)
            return "Categoria não encontrada";

        if (isset($_POST['__status']) && $_POST['__status'] === "submitted") {

            $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
            $logo = $_FILES['logo'] ?? null;

            $categoriaPut = new Categoria();
            $categoriaPut->setId($categoria->getId());
            $categoriaPut->setNome($nome);
            $categoriaPut->setLogo($logo);


            $erros = $this->catService->validate($categoriaPut, false);

            if (empty($erros)) {
                try {
                    if ($logo) {
                        if ($logo['size'] <= 0) {
                            $categoriaPut->setLogo($categoria->getLogo());
                        } else {
                            if ($categoria->getLogo() !== App::DIR_RACING_TEAM_DEFAULT) {
                                if ($this->service->unlinkFile($categoria->getLogo())) {
                                     $categoriaPut->setLogo($this->service->saveFile($logo, $categoriaPut, "categorias"));
                                }
                            }
                        }
                    } else {
                        $categoriaPut->setLogo(App::DIR_RACING_TEAM_DEFAULT);
                    }
                    $this->catDAO->update($categoriaPut);
                    header("location: categorias");
                    exit;
                } catch (PDOException $p) {
                    echo "Erro ao atualizar categoria.";
                    echo $p->getMessage();
                    exit;
                }
            }
        }
        $this->loadView(
            "categoria/categorias",
            [
                'erros' => $erros ?? null,
                'categoria' => $categoria,
                'categorias' => $this->getAll(),
            ]
        );
    }


    public function destroy()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            return "Id não informado.";
        }

        try {
            $this->catDAO->delete($id);
            header("location: /categorias");
            exit;
        } catch (PDOException $p) {
            echo "Erro ao deletar categoria de id {$id}";
            echo $p->getMessage();
        }
    }
}
