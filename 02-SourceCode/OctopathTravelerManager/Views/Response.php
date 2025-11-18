<?php

class Response 
{
    private int $httpCode;
    private string|null $responseString;
    private bool $isApi;

    public function __construct(int $httpCode, string|null $responseString = null, bool $isApi = false) 
    { 
        $this->httpCode = $httpCode;
        $this->responseString = $responseString;
        $this->isApi = $isApi;
    }

    public function generateResponse() 
    {
        http_response_code($this->httpCode);

        if ($this->isApi) 
        {
            header("Content-Type: application/json; charset=UTF-8");
            if ($this->responseString != null) 
                echo $this->responseString;
        }
        elseif ($this->responseString != null) 
        {
            include_once(__DIR__ . "/includes/head.php");
            include_once(__DIR__ . "/includes/header.php");
            echo $this->responseString;
            include_once(__DIR__ . "/includes/footer.php");
        }
    }
}
?>