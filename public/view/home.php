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
            <img src="https://naspistas.com/wp-content/uploads/2023/10/max-verstappen.jpg" alt="">
            <span>PILOTOS</span>
        </div>
    </a>

    <a href="/equipes">
        <div class="card card-equipe">
            <img src="https://cdn-7.motorsport.com/images/amp/2jXPBbp6/s1000/ferrari-sf-25.jpg" alt="">
            <span>EQUIPES</span>
        </div>
    </a>

    <a href="/categorias">
        <div class="card card-categoria">
            <img src="https://support.formula1.com/file-asset/F1_TV_White_Logo_Red_Background?v=1" alt="">
            <span>CATEGORIAS</span>
        </div>
    </a>

</div>

<?php
$view
    ->includeHtmlFooter();
