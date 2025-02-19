<?php

namespace Tiagolopes\AbFilmes\Utils;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    private function addMethod(string $httpMethod, string $uri, string $controller, string $method): void
    {
        $this->routes[$httpMethod][$uri] = [
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get(string $uri, string $controller, string $method = 'index'): self
    {
        $this->addMethod('GET', $uri, $controller, $method);

        return $this;
    }

    public function post(string $uri, string $controller, string $method = 'index'): self
    {
        $this->addMethod('POST', $uri, $controller, $method);

        return $this;
    }

    public function run(): void
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (! isset($this->routes[$httpMethod][$uri])) {
            header('Location: /');
            return;
        }

        $routeInfo = $this->routes[$httpMethod][$uri];

        $controllerClass = $routeInfo['controller'];
        $method = $routeInfo['method'];

        $controller = new $controllerClass();
        $controller->$method();
    }
}
