<?php
class Router {

    public array $routesGET  = [];
    public array $routesPOST = [];

    public function get(string $uri, array $callback) : void {
        $this->routesGET[$uri] = $callback;
    }

    public function post(string $uri, array $callback) : void {
        $this->routesPOST[$uri] = $callback;
    }

    public function match() : void {
        $uri      = $_SERVER['PATH_INFO'] ?? '/';
        $method   = $_SERVER['REQUEST_METHOD'];
        $routes   = "routes$method";
        $params   = [];
        $callback = null;
        $pattern  = null;

        foreach ($this->$routes as $route => $callback) {
            //Replace dynamic routes with a pattern
            if (strpos($route, ':' ) !== false) {
                $pattern = preg_replace('#:[a-zA-Z]+#','([a-zA-Z]+)', $route);
            }
            
            // If a match is found with the pattern, the parameters and path with the matching pattern are obtained.
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                $uri    = $route;
                $params = array_slice($matches, 1);
            }
        }

        if ($method == 'GET') {
            $callback = $this->routesGET[$uri] ?? null;
        }
        if ($method == 'POST') {
            $callback = $this->routesPOST[$uri] ?? null;
        }

        $data = (object)[
            'router' => $this,
            'params' => $params,
            'query'  => (object)$_GET,
            'body'   => (object)$_POST
        ];

        if ($callback) {
            call_user_func($callback, $data);
        } else {
            http_response_code(404);
            echo "404 Not Found...";
            return;
        }
    }

    public function render($view, $data = []) {

        //Transform array in variables
        foreach ($data as $key => $value) {
            $$key = $value;
        }

        ob_start();
        require __DIR__ ."/../views/$view.php";
        $content = ob_get_clean();
        require __DIR__ ."/../views/layouts/main.php";
    }

}