<?php
class View
{
    public static function get(string $viewName, array $params = []): string
    {
        $viewPath = __DIR__ . "/pages/" . str_replace(".", "/", $viewName) . ".php";

        if (!file_exists($viewPath)) {
            throw new Exception("View file not found: " . $viewPath);
        }

        foreach ($params as $key => $value)
            $$key = $value; // Extract parameters to variables

        ob_start(); // Start output buffering
        include($viewPath); // Include the view file
        return ob_get_clean(); // Return the buffered content
    }

        public static function getComponent(string $viewName, array $params = []): string
    {
        $viewPath = __DIR__ . "/components/" . str_replace(".", "/", $viewName) . ".php";

        if (!file_exists($viewPath)) {
            throw new Exception("View file not found: " . $viewPath);
        }

        foreach ($params as $key => $value)
            $$key = $value; // Extract parameters to variables

        ob_start(); // Start output buffering
        include($viewPath); // Include the view file
        return ob_get_clean(); // Return the buffered content
    }
}
?>