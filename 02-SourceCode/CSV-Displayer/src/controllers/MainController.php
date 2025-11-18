<?php
require_once(__DIR__ . "/../core/Request.php");
require_once(__DIR__ ."/../core/Response.php");
require_once(__DIR__ . "/Router.php");

class MainController 
{
    private static ?MainController $instance = null;

    /**
     * Constructor for the MainController class.
     * This constructor can be overridden by child classes to implement specific initialization logic.
     */
    private function __construct() 
    {
        View::scanViewsRecursively();
    }

    public static function getInstance(): MainController
    {
        if (self::$instance === null) 
            self::$instance = new MainController();
        return self::$instance;
    }

    public function run()
    {
        [
            "method" => $method,
            "action" => $action,
        ] = Request::getRequest();

        Router::route(method:$method, action:$action)->render();
    }
}   
?>