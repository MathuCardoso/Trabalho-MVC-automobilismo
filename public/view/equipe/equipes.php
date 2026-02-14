<?php

$view
    ->setLinks([
        "css/equipe.css",
        "css/form.css",
        "css/list.css"
    ])
    ->includeHtmlHeader();
?>

<div class="container container-equipe">


    <?php require_once App::URL_VIEW . "equipe/list.php" ?>

    <div class="form-container">

        <form class="form" method="POST">


            <h2>
                <?= isset($equipe) && $equipe->getId() !== 0 ?
                    $equipe->getNome() :
                    "Cadastro de Equipe" ?>
            </h2>
            <div class="form-group">

                <div class="form-control">
                    <?php if (isset($erros['nome'])): ?>

                        <label for="inpNome" class="invalid"><?= $erros['nome'] ?></label>

                    <?php else: ?>

                        <label for="inpNome">Nome da equipe</label>

                    <?php endif; ?>
                    <input
                        class="inp"
                        id="inpNome"
                        type="text"
                        name="nome"
                        placeholder="Ex: Red Bull Racing"
                        value="<?= isset($equipe) ? $equipe->getNome() : ''; ?>">
                </div>

                <div class="form-control">
                    <?php if (isset($erros['sede'])): ?>

                        <label for="inpSede" class="invalid"><?= $erros['sede'] ?></label>

                    <?php else: ?>

                        <label for="inpIdade">Sede da equipe</label>

                    <?php endif; ?>
                    <input
                        class="inp"
                        id="inpSede"
                        type="text"
                        name="sede"
                        placeholder="Ex: Woking - REINO UNIDO"
                        value="<?= isset($equipe) ? $equipe->getSede() : ''; ?>">

                </div>

                <div class="form-control">
                    <?php if (isset($erros['cor1'])): ?>

                        <label for="inpCor1" class="invalid"><?= $erros['cor1'] ?></label>

                    <?php else: ?>

                        <label for="inpCor1">Cor 1 da equipe</label>

                    <?php endif; ?>
                    <input
                        class="inp"
                        id="inpCor1"
                        name="cor1"
                        type="color"
                        value="<?= isset($equipe) ? $equipe->getCor1() : ''; ?>">

                </div>

                <div class="form-control">
                    <?php if (isset($erros['cor2'])): ?>

                        <label for="inpCor2" class="invalid"><?= $erros['cor2'] ?></label>

                    <?php else: ?>

                        <label for="inpCor2">Cor 2 da equipe</label>

                    <?php endif; ?>
                    <input
                        class="inp"
                        id="inpCor2"
                        name="cor2"
                        type="color"
                        value="<?= isset($equipe) ? $equipe->getCor2() : ''; ?>">

                </div>

                <div class="form-control">
                    <?php if (isset($erros['categoria'])): ?>

                        <label for="selCategoria" class="invalid"><?= $erros['categoria'] ?></label>

                    <?php else: ?>

                        <label for="selCategoria">Categoria da equipe</label>

                    <?php endif; ?>
                    <select name="categoria" id="selCategoria" class="sel">
                        <option value="">Escolha uma categoria</option>
                        <?php foreach ($categorias as $c): ?>

                            <option value="<?= $c->getId(); ?>"

                                <?= isset($equipe) && $equipe->getCategoria()->getId() === $c->getId() ? 'selected' : ''; ?>>
                                <?= $c->getNome(); ?>
                            </option>

                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="buttons">

                <button
                    class="btn btn-submit" id="btn-submit"
                    type="submit">
                    SALVAR
                </button>


                <?php if (isset($equipe)): ?>

                    <a href="" class="btn btn-back" id="btn-back" title="Voltar">

                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>

                    </a>

                <?php endif; ?>

            </div>

            <?php if (isset($equipe) && $equipe->getId() !== 0): ?>

                <input type="number" name="id" value="<?= $equipe->getId() ?>" hidden>
                <input type="text" name="__method" value="put" hidden>
                <input type="text" name="__status" value="submitted" hidden>

            <?php endif; ?>
        </form>
    </div>

</div>
<?php
$view
    ->includeHtmlFooter();
?>