<?php

$view
    ->setLinks([
        "css/piloto.css",
        "css/form.css",
        "css/list.css"
    ])
    ->setTitle("Pilotos")
    ->includeHtmlHeader();
?>

<div class="container container-piloto">

    <?php require_once App::URL_VIEW . "piloto/list.php" ?>

    <div class="form-container">

        <form class="form" method="POST" enctype="multipart/form-data">


            <h2>
                <?= isset($piloto) && $piloto->getId() !== 0 ?
                    "Edição de Piloto" :
                    "Cadastro de Piloto" ?>
            </h2>

            <div class="form-group">

                <div class="form-control">
                    <?php if (isset($erros['nome'])): ?>

                        <label for="inpNome" class="invalid"><?= $erros['nome'] ?></label>

                    <?php else: ?>

                        <label for="inpNome">Nome do piloto</label>

                    <?php endif; ?>
                    <input
                        class="inp"
                        id="inpNome"
                        type="text"
                        name="nome"
                        placeholder="Ex: Felipe Drugovich"
                        value="<?= isset($piloto) ? $piloto->getNome() : "" ?>">
                </div>

                <div class="form-control">
                    <?php if (isset($erros['idade'])): ?>

                        <label for="inpIdade" class="invalid"><?= $erros['idade'] ?></label>

                    <?php else: ?>

                        <label for="inpIdade">Idade do piloto</label>

                    <?php endif; ?>
                    <input
                        class="inp"
                        id="inpIdade"
                        type="number"
                        name="idade"
                        placeholder="Ex: 21"
                        value="<?= isset($piloto) ? $piloto->getIdade() : "" ?>">

                </div>

                <div class="form-control">
                    <?php if (isset($erros['nacional'])): ?>

                        <label for="inpNacional" class="invalid"><?= $erros['nacional'] ?></label>

                    <?php else: ?>

                        <label for="inpNacional">Nacionalidade do piloto</label>

                    <?php endif; ?>
                    <select
                        class="sel"
                        id="inpNac"
                        name="nacional"
                        nomeSelecionado="<?= $piloto ? $piloto->getNacionalidade() : "" ?>">
                        <option value="">===Nacionalidade===</option>
                    </select>


                </div>

                <div class="form-control">
                    <label for="inpFoto" class="fotoLabel">Foto do piloto</label>
                    <button type="button" class="inp" id="selFoto">Escolha uma foto</button>
                    <input
                        class="inp selImg"
                        id="inpFoto"
                        type="file"
                        name="foto"
                        hidden>
                </div>

                <div class="form-control">
                    <?php if (isset($erros['equipe'])): ?>

                        <label for="selEquipe" class="invalid"><?= $erros['equipe'] ?></label>

                    <?php else: ?>

                        <label for="selEquipe">Equipe do piloto</label>

                    <?php endif; ?>
                    <select name="equipe" id="selEquipe" class="sel">
                        <option value="">===Equipe===</option>

                        <?php foreach ($equipes as $e): ?>

                            <option value="<?= $e->getId() ?>"
                                <?= isset($piloto) && $piloto->getEquipe()->getId() == $e->getId() ? "selected" : "" ?>>
                                <?= $e->getNome() ?>
                            </option>

                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-control">

                    <?php if (isset($erros['numero'])): ?>

                        <label for="selNum" class="invalid"><?= $erros['numero'] ?></label>

                    <?php else: ?>

                        <label for="selNum">Número do piloto</label>

                    <?php endif; ?>

                    <select name="numero" id="selNum" class="sel">
                        <option value="">===Numero===</option>

                        <?php for ($i = 0; $i <= 99; $i++): ?>

                            <option value="<?= $i ?>"

                                <?= isset($piloto) && $piloto->getNumero() === $i ? 'selected' : '' ?>>
                                <?= $i ?>
                            </option>

                        <?php endfor; ?>

                    </select>

                </div>
            </div>

            <div class="preview">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
                    class="loading"
                    preserveAspectRatio="xMidYMid" style="
                    shape-rendering: auto; display: none; background: transparent;" width="50" height="50" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g>
                        <circle stroke-dasharray="164.93361431346415 56.97787143782138" r="35" stroke-width="10" stroke="#ffffff" fill="none" cy="50" cx="50">
                            <animateTransform keyTimes="0;1" values="0 50 50;360 50 50" dur="1s" repeatCount="indefinite" type="rotate" attributeName="transform"></animateTransform>
                        </circle>
                    </g>
                </svg>
                <img src="
                
                <?= isset($piloto) && $piloto->getId() !== 0 ? $piloto->getFotoPerfil() : '/public/assets/racer_default.png' ?>" id="imgPreview">
            </div>

            <div class=" buttons">

                <button
                    title="Salvar piloto"
                    class="btn btn-submit" id="btn-submit"
                    type="submit">SALVAR</button>

                <?php if (isset($piloto)): ?>

                    <a href="" class="btn btn-back" id="btn-back" title="Voltar">

                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>

                    </a>

                <?php endif; ?>
            </div>

            <?php if (isset($piloto) && $piloto->getId() !== 0): ?>

                <input type="number" name="id" value="<?= $piloto->getId() ?>" hidden>
                <input type="text" name="__method" value="put" hidden>
                <input type="text" name="__status" value="submitted" hidden>
            <?php endif; ?>

        </form>
    </div>

</div>

<?php

$view->setScriptLink([
    "/js/paises.js",
    "/js/fileReader.js"
])
    ->includeHtmlFooter();
?>