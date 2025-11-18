<?php 
/**
 * Author: Damien Loup & Thomas Rey
 * Date: 17-06-2025
 * Description: This file contains the Route class, which represents a route in the application.
 */
require_once(__DIR__ . "/../Controllers/Router.php");

/**
 * Route class represents a route in the application.
 * It contains information about the HTTP method, action, controller, function, and parameters.
 * This class provides static methods to define routes for different HTTP methods (GET, POST, DELETE).
 */
class Route
{
    private string $controller, $function;          // Controller class name and function to call
    private string $method;                         // HTTP method (GET, POST, DELETE)
    private string $action;                         // Action to route to (e.g., "/projects", "/tasks")
    private array $params = [];                     // Parameters to pass to the function

    /**
     * Gets the HTTP method of the route.
     * @return string The HTTP method of the route.
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Gets the action of the route.
     * @return string The action of the route.
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Gets the controller of the route.
     * @return mixed The controller of the route.
     */
    public function getController(): mixed
    {
        return $this->controller;
    }

    /**
     * Gets the function of the route.
     * @return string The function of the route.
     */
    public function getFunction(): string
    {
        return $this->function;
    }

    /**
     * Gets the parameters of the route.
     * @return array The parameters of the route.
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Constructor for the Route class.
     * @param string $method The HTTP method of the route.
     * @param string $action The action of the route.
     * @param mixed $controller The controller of the route.
     * @param string $function The function of the route.
     * @param array $params The parameters of the route.
     */
    public function __construct(string $method, string $action, mixed $controller, string $function, array $params = [])
    {
        $this->method = $method;
        $this->action = $action;
        $this->controller = $controller;
        $this->function = $function;
        $this->params = $params;
    }
    
    /**
     * Adds a new route to the router.
     * This method is used to define a route for the GET HTTP method.
     * 
     * @param string $action The action to route to (e.g., "/projects", "/tasks").
     * @param mixed $controller The controller class name or instance.
     * @param string $function The function to call in the controller.
     * @param array $params Optional parameters to pass to the function.
     */
    public static function get(string $action, mixed $controller, string $function, array $params = []): void // Route
    {
        Router::addRoute(new self("GET", $action, $controller, $function, $params));
    }
    
    /**
     * Adds a new route to the router for the POST HTTP method.
     * This method is used to define a route for creating resources.
     * 
     * @param string $action The action to route to (e.g., "/projects", "/tasks").
     * @param mixed $controller The controller class name or instance.
     * @param string $function The function to call in the controller.
     * @param array $params Optional parameters to pass to the function.
     */
    public static function post(string $action, mixed $controller, string $function, array $params = []): void
    {
        Router::addRoute(new self("POST", $action, $controller, $function, $params));
    }

    /**
     * Adds a new route to the router for the DELETE HTTP method.
     * This method is used to define a route for deleting resources.
     * 
     * @param string $action The action to route to (e.g., "/projects", "/tasks").
     * @param mixed $controller The controller class name or instance.
     * @param string $function The function to call in the controller.
     * @param array $params Optional parameters to pass to the function.
     */
    public static function delete(string $action, mixed $controller, string $function, array $params = []): void
    {
        Router::addRoute(new self("DELETE", $action, $controller, $function, $params));
    }
}
?>