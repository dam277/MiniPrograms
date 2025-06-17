<?php
require_once(__DIR__ . "/../core/Request.php");
require_once(__DIR__ . "/../core/View.php");
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

        $viewInfos = Router::route(method:$method, action:$action);

        $view = $viewInfos["view"] ?? null;
        $variable = $viewInfos["variable"] ?? null;
        $this->display($view, $variable);
    }

    private function display(View $view, ?array $variable = null)
    {
        if ($view === null || $view === "")
            $view = "An error occurred while processing your request.";

        if ($variable)
            foreach ($variable as $key => $value) 
                $$key = $value;
        
        // Include the includes
        include_once(__DIR__ . "/../Views/includes/head.php");
        include_once(__DIR__ . "/../Views/includes/header.php");
        
        $view->render();

        include_once(__DIR__ . "/../Views/includes/footer.php");
    }
}   
?>