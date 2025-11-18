<?php
require_once(__DIR__ . "/View.php");

class Response 
{
    private int $httpCode;
    private View|null $view = null;
    private array $variables = [];

    public function getHttpCode(): int { return $this->httpCode; }
    public function getView(): View|null { return $this->view; }
    public function getVariables(): array { return $this->variables; }

    public function __construct(int $httpCode, View|null $view = null, array $variables = []) 
    { 
        $this->httpCode = $httpCode;
        $this->view = $view;
        $this->variables = $variables;
    }

    public function render(): void
    {
        http_response_code($this->httpCode);
        header("Content-Type: text/html; charset=UTF-8");

        if ($this->view === null || $this->view === "")
            die("An error occurred while processing your request.");

        if ($this->variables)
            foreach ($this->variables as $key => $value) 
                $$key = $value;
            
        // Include the includes
        include_once(__DIR__ . "/../Views/includes/head.php");
        include_once(__DIR__ . "/../Views/includes/header.php");
        
        if ($this->view != null)
            include_once($this->view->getpath());

        include_once(__DIR__ . "/../Views/includes/footer.php");
        exit();
    }
}
?>