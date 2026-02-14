<style>
    header {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 10vh;
        background: linear-gradient(320deg,
                rgb(0, 0, 0, 0.8),
                rgba(0, 0, 0, 0.7),
                rgb(0, 0, 0, 0.9));
        backdrop-filter: blur(10px);
        border-bottom-right-radius: 20px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding-inline: 10px;
        box-shadow: 2px 0px 10px transparent;
        z-index: 99;

        ul {
            width: 100%;
            display: flex;
            justify-content: space-between;
            list-style: none;
            gap: 15px;
            margin-left: 15px;

            .nav-bar {
                width: 80%;
                display: flex;
                justify-content: flex-start;
                gap: 15px;
            }

            .brand {
                width: 20%;

                img {
                    max-width: 75px;
                    position: absolute;
                    top: 50%;
                    right: 20px;
                    transform: translateY(-50%);
                }
            }

            li {
                font-size: 1.2rem;
                letter-spacing: 1px;
            }


            a {
                text-decoration: none;
                padding: 5px 7px;
                border-radius: 7px;
                color: white;
                transition: all 0.1s ease;
            }
        }

        #pilotos {
            &:hover {
                background-color: var(--roxo);
            }
        }

        #equipes {
            &:hover {
                background-color: var(--vermelho);
            }
        }

        #categorias {
            &:hover {
                background-color: var(--azul);
            }
        }


    }
</style>

<header style="box-shadow: 
<?= $view->routeIs('/pilotos') ? '2px 0px 10px var(--roxo)' : '' ?>
<?= $view->routeIs('/equipes') ? '2px 0px 10px var(--vermelho)' : '' ?>
<?= $view->routeIs('/categorias') ? '2px 0px 10px var(--azul)' : '' ?>;
">


    <ul>

        <div class="nav-bar">

            <a id="pilotos" href="<?= "/pilotos" ?>"
                style="background-color: <?= $view->routeIs('/pilotos') ? 'var(--roxo)' : '' ?>;">
                <li>Pilotos</li>
            </a>
            <a id="equipes" href="<?= "/equipes" ?>"
                style="background-color: <?= $view->routeIs('/equipes') ? 'var(--vermelho)' : '' ?>;">
                <li>Equipes</li>
            </a>
            <a id="categorias" href="<?= "/categorias" ?>"
                style="background-color: <?= $view->routeIs('/categorias') ? 'var(--azul)' : '' ?>;">
                <li>Categorias</li>
            </a>

        </div>

        <div class="brand">

            <a href="/">
                <img src="/public/assets/fia.png" alt="" width="10%">
            </a>
        </div>

    </ul>


</header>