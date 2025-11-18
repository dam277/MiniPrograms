<?php
/**
 * Author: Damien Loup & Thomas Rey
 * Date: 17-06-2025
 * Description: This class provides helper functions for security-related tasks, such as API key validation.
 */

 /**
  * SecurityHelper class provides methods for security-related tasks.
  * It includes functionality to validate API keys and generate error responses for unauthorized access.
  */
class SecurityHelper 
{
    private static string $apiKey = "IDjiaosudh128eudaj8ih";        // Api Key for authentication

    /**
     * Checks if the API key is valid
     * @return bool True if the API key is valid, false otherwise
     */
    public static function isAPIKeyValid(): bool 
    {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $authHeader);

        return $token === self::$apiKey; 
    }

    /**
     * Generates a 401 Unauthorized response if the API key is invalid
     * @return void
     */
    public static function generateAPIAccessError() : void
    {
        (new Response(httpCode: 401))->generateResponse();
    }
}

?>