<?php
$view
    ->setLinks([
        "css/main.css",
        "css/home.css"
    ])
    ->setTitle("FIA")
    ->includeHtmlHeader();
?>

<div class="container">

    <a href="/pilotos">
        <div class="card card-piloto">
            <img src="<?= App::URL_ASSETS . "pilotoImg.webp" ?>" alt="">
            <span>PILOTOS</span>
        </div>
    </a>

    <a href="/equipes">
        <div class="card card-equipe">
            <img src="<?= App::URL_ASSETS . "equipeImg.jpg" ?>" alt="">
            <span>EQUIPES</span>
        </div>
    </a>

    <a href="/categorias">
        <div class="card card-categoria">
            <img src="<?= App::URL_ASSETS . "categoriaImg.webp" ?>" alt="">
            <span>CATEGORIAS</span>
        </div>
    </a>

</div>

<?php
$view
    ->includeHtmlFooter();
