<?php

namespace App\routing;

require_once __DIR__ . "/../../autoload.php";

class Route
{

    public static function get(
        string $uri,
        array $action
    ) {
        self::handleRoute($uri, $action, "GET");
    }

    public static function post(
        string $uri,
        array $action
    ) {
        if (!isset($_POST['__method'])) {
            self::handleRoute($uri, $action, "POST");
        }
        return;
    }

    public static function put(
        string $uri,
        array $action
    ) {


        if (isset($_POST['__method']) && $_POST['__method'] == "put") {
            $_SERVER['REQUEST_METHOD'] = "PUT";
            self::handleRoute($uri, $action, "PUT");
        }
        return;
    }

    public static function delete(string $uri, array $action)
    {

        if (isset($_POST['__method']) && $_POST['__method'] == "delete") {
            $_SERVER['REQUEST_METHOD'] = "DELETE";
            self::handleRoute($uri, $action, "DELETE");
        }
        return;
    }

    private static function handleRoute(string $uri, array $action, string $httpMethod)
    {

        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (
            ($_SERVER['REQUEST_METHOD'] === $httpMethod) &&
            ($uri === $url)
        ) {

            [$className, $method] = $action;

            $class = new $className();
            $class->$method();
            exit;
        } else {
            return;
        }
    }
}
