<?php
declare(strict_types=1);

require_once("Helpers/SecurityHelper.php");
require_once("Controllers/Router.php");

// Check API key
// if (!SecurityHelper::isAPIKeyValid()) 
// {
//     SecurityHelper::generateAPIAccessError();
//     die();
// }

// Http method
$httpMethod = $_SERVER['REQUEST_METHOD'];

// Get action parameter
$action = null;
if (isset($_GET["action"]) && !empty($_GET["action"])) {
    $action = $_GET["action"];
}

$response = null;
try {
    // Generate response (and data) according to API URL (from Router)
    $response = Router::route(method: $httpMethod, action: $action);
    
    // In case action could not be handle, generate a 404 error
    if ($response == null) {
       $response = new Response(httpCode: 404);
    }
    
}
catch(Exception $e) {
    $response = new Response(httpCode: 500, responseString: json_encode([
        "error" => "An unexpected error occurred: " . $e->getMessage()
    ]));
}

// Generate final response
$response->generateResponse();

?>