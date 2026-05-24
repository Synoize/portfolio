<?php
class Router {
    private $routes = [];
    
    public function get($path, $view) {
        $this->routes['GET'][$path] = $view;
    }
    
    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }
    
    public function dispatch($method, $path) {
        // Remove leading slash and trailing slash
        $path = '/' . trim($path, '/');
        
        // Check if route exists
        if (isset($this->routes[$method][$path])) {
            $view = $this->routes[$method][$path];
            
            if (is_callable($view)) {
                return call_user_func($view);
            } else {
                return $view;
            }
        }
        
        // Handle 404
        return '404';
    }
    
    public function getRoutes() {
        return $this->routes;
    }
}
?>
