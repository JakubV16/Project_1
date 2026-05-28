<?php

namespace App\Core;

class Router {
    private array $routes = [];

    public function add(string $path, object $controller, string $method) :void {
        $this->routes[$path]=[
            "controller"=>$controller,
            "method"=>$method,
        ];
    }

    public function resolve() :void {

        $requestUri = $_SERVER["REQUEST_URI"];
        $path = parse_url($requestUri, PHP_URL_PATH);
        $basePath="/Project_1/public";
        $path = str_replace($basePath,"",$path);
        
        if(isset($this->routes[$path])){
            $route = $this->routes[$path];
            $controller= $route["controller"];
            $method= $route["method"];

            $controller->$method();
        }
        else{
            http_response_code(404);
            echo"404 - Stránka, ktorú hľadáte neexistuje!";

        }
    }
}


/*
$uri = $_SERVER["REQUEST_URI"];

$path = parse_url($uri, PHP_URL_PATH);

$basePath="/Project_1/public";

$path = str_replace($basePath,"",$path);

echo $path;
*/