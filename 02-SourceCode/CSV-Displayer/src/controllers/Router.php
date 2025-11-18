<?php
/**
 * Author: Damien Loup & Thomas Rey
 * Date: 17-06-2025
 * Description: This file contains the Router class, which is responsible for routing HTTP requests to the appropriate controllers and actions.
 */
require_once(__DIR__ . "/../routes/routes.php");
require_once(__DIR__ . "/../core/Response.php");

/**
 * Router class handles the routing of HTTP requests to the appropriate controllers and actions.
 * It maintains a list of routes and provides methods to add routes and route requests based on the HTTP method and action.
 * This class is responsible for determining which controller and function to call based on the request method and action.
 * It also validates the parameters required for each route and returns appropriate responses.
 */
class Router 
{
    /** @var Route[] */
    public static ?array $routes = [];

    /**
     * Routes the request based on the HTTP method and action.
     *
     * @param string $method The HTTP method (GET, POST, DELETE).
     * @param string|null $action The action to route to.
     * @return 
     */
    public static function route(string $method, ?string $action): Response
    {
        // Check if the action is set
        if ($action == null) 
            return new Response(httpCode: 400, view: View::getView(viewName:"400"));
        
        // Get the route based on the method and action with the associated parameters
        [$route, $params] = self::getRoute(method: $method, action: $action);
        
        // If no route is found, return a 404 response
        if ($route == null)
            return new Response(httpCode: 404, view: View::getView(viewName:"404"));

        $controller = new ($route?->getController())();
        $function = $route?->getFunction();

        if (!class_exists($route?->getController()) || !method_exists($controller, $function))
            return new Response(httpCode: 500, view: View::getView(viewName:"500"));

        return $controller->$function($params);
    }

    /**
     * Retrieves a route based on the HTTP method and action.
     *
     * @param string $method The HTTP method (GET, POST, DELETE).
     * @param string $action The action to route to.
     * @return array|null An array containing the route and parameters if found, null otherwise.
     */
    private static function getRoute(string $method, string $action): ?array
    {
        // Filter the routes based on the method and action
        $routes = array_filter(self::$routes, function($r) use ($method, $action) 
        {
            return $r->getMethod() === $method && $r->getAction() === $action;
        });

        // Check if the params are valid with the route
        $params = [];
        foreach ($routes as $route) 
        {
            // Get the params from the route
            $params = array_intersect_key($_GET, array_flip($route->getParams()));

            // Return the route if all required params are present
            if (count($params) === count($route->getParams()) && count($params) === count($_GET) - 1)
                return [$route, $params];
        }

        // If no route matches, return null
        return null;
    }

    /**
     * Adds a route to the router.
     *
     * @param Route $route The route to add.
     */
    public static function addRoute(Route $route): void 
    {
        self::$routes[] = $route;
    }
}
?>