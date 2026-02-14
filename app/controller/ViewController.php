<?php

namespace App\controller;

use App;

require_once __DIR__ . "/../../configs/App.php";
class ViewController
{

    private ?string $title;
    private ?array $links;
    private ?array $scriptLink;
    private ?string $outsideLink;

    public function __construct()
    {
        $this->title = "MVC Automobilismo";
        $this->outsideLink = null;
    }


    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
    public function getLinks()
    {
        if (!empty($this->links)) {
            foreach ($this->links as $l) {
                if (file_exists(App::URL_PUBLIC . $l)) {
                    echo "<link 
                rel='stylesheet' 
                href='" . App::URL_HTML_PUBLIC . "$l'>";
                } else {
                    echo "O arquivo " . App::URL_HTML_PUBLIC . $l . "Não existe!";
                    return;
                }
            }
        } else {
            return;
        }
    }

    public function setLinks(array $links = [])
    {
        $this->links = $links;

        return $this;
    }

    public function getScriptLink()
    {
        if (!empty($this->scriptLink)) {
            foreach ($this->scriptLink as $l) {
                if (file_exists(App::URL_PUBLIC . $l)) {
                    echo "<script 
                    src='" . App::URL_HTML_PUBLIC . $l . "'></script>";
                } else {
                    echo "O arquivo " . App::URL_HTML_PUBLIC . $l . " Não existe!";
                    return;
                }
            }
        } else {
            return;
        }
    }

    public function setScriptLink(array $script = [])
    {
        $this->scriptLink = $script;

        return $this;
    }

    /**
     * Get the value of outsideLink
     */
    public function getOutsideLink()
    {
        return $this->outsideLink;
    }

    /**
     * Set the value of outsideLink
     *
     * @return  self
     */
    public function setOutsideLink($outsideLink)
    {
        $this->outsideLink = $outsideLink;

        return $this;
    }


    public function includeHtmlHeader()
    {
        require_once App::DIR_COMPONENTS . "app_head.php";
    }

    public function includeHtmlFooter()
    {
        require_once App::DIR_COMPONENTS . "app_footer.php";
    }

    public function routeIs(string $route): bool
    {
        if ($_SERVER['REQUEST_URI'] === $route)
            return true;

        return false;
    }
}
