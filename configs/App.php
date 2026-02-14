<?php
class App
{
    public const SEPARATOR = DIRECTORY_SEPARATOR;
    public const URL_BASE = "/";
    public const DIR_APP = __DIR__  . App::SEPARATOR . ".." .
        App::SEPARATOR . "app" . App::SEPARATOR;
    public const URL_VIEW = __DIR__ . "/../public/view/";
    public const URL_HTML_PUBLIC = "/public/";
    public const URL_PUBLIC = __DIR__ . "/../public/";
    public const DIR_COMPONENTS = __DIR__ . "/../public/components/";
    public const URL_ASSETS = "/public/assets/";
    public const DIR_UPLOADS = __DIR__ . "/../public/uploads/";
    public const URL_UPLOADS = "/public/uploads/";
    public const URL_HTML_UPLOADS = "/public/uploads/";
    public const DIR_RACER_DEFAULT = "/public/assets/racer_default.png";
    public const DIR_RACING_TEAM_DEFAULT = "/public/assets/racing_team_default.png";
}
