<?php

$view
    ->setLinks([
        "css/categoria.css",
        "css/form.css",
        "css/list.css"
    ])
    ->setTitle("Form")
    ->includeHtmlHeader();
?>

<div class="container container-categoria">


    <?php require_once App::URL_VIEW . "categoria/list.php" ?>

    <div class="form-container">

        <form class="form" method="POST" enctype="multipart/form-data">


            <h2>
                <?= isset($categoria) && $categoria->getId() !== 0 ?
                    $categoria->getNome() :
                    "Cadastro de Categoria" ?>
            </h2>
            <div class="form-group">

                <div class="form-control">
                    <?php if (isset($erros['nome'])): ?>

                        <label for="inpNome" class="invalid"><?= $erros['nome'] ?></label>

                    <?php else: ?>

                        <label for="inpNome">Nome da categoria</label>

                    <?php endif; ?>
                    <input
                        class="inp"
                        id="inpNome"
                        type="text"
                        name="nome"
                        placeholder="Ex: Fórmula 1"
                        value="<?= isset($categoria) ? $categoria->getNome() : '' ?>">
                </div>

                <div class="form-control">
                    <?php if (isset($erros['logo'])): ?>

                        <label for="selLogo" class="invalid"><?= $erros['logo'] ?></label>

                    <?php else: ?>

                        <label for="inpLogo">Logo da categoria</label>

                    <?php endif; ?>
                    <button type="button" class="inp" id="selLogo">Escolha uma logo</button>

                    <input
                        class="inp selImg"
                        id="selLogo"
                        type="file"
                        name="logo"
                        hidden>
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
                
                <?= isset($categoria) && $categoria->getId() !== 0 ? $categoria->getLogo() : '/public/assets/racing_team_default.png' ?>" id="imgPreview">
            </div>

            <div class="buttons">

                <button
                    class="btn btn-submit" id="btn-submit"
                    type="submit">
                    SALVAR
                </button>
            </div>


            <?php if (isset($categoria) && $categoria->getId() !== 0): ?>

                <input type="number" name="id" value="<?= $categoria->getId() ?>" hidden>
                <input type="text" name="__method" value="put" hidden>
                <input type="text" name="__status" value="submitted" hidden>
            <?php endif; ?>
        </form>
    </div>

</div>

<?php
$view
    ->setScriptLink(['js/fileReader.js'])
    ->includeHtmlFooter();
?>