<?php
require_once(__DIR__ . "/../Controller.php");
require_once(__DIR__ . "/../../Models/tables/Characters.php");

class CharacterController extends Controller
{
    public function abilities()
    {
        $characters = Characters::getAll();
    
        // Render the abilities view
        $responseString = View::get(viewName: "character.abilities", params: ["characters" => $characters]);

        // Return the response
        return new Response(httpCode: 200, responseString: $responseString);
    }

    public function characters()
    {
        $characters = Characters::getAllWithAll();

        // Make arrays of characters by game
        $charactersByGame = [];
        foreach ($characters as $character) 
        {
            $gameName = $character->gameName;
            if (!isset($charactersByGame[$gameName])) 
                $charactersByGame[$gameName] = [];
            
            $charactersByGame[$gameName][] = $character;
        }

        // Render the characters view
        $responseString = View::get(viewName: "character.default", params: ["charactersByGame" => $charactersByGame]);

        // Return the response
        return new Response(httpCode: 200, responseString: $responseString);
    }

    public function gameCharacters(array $params)
    {
        // Get the game ID from the parameters
        [
            "gameId" => $gameId
        ] = $params;

        // Validate the game ID
        if (!isset($gameId) || !is_numeric($gameId)) {
            return new Response(httpCode: 400, responseString: "Invalid or missing game ID.");
        }
        
        // Fetch characters associated with the game ID
        $characters = Characters::getAllWithAllByGameId($gameId);
        $game = Games::getById($gameId)[0] ?? null;

        // Render the game characters view
        $responseString = View::get(viewName: "character.default", params: ["characters" => $characters, "game" => $game]);
        return new Response(httpCode: 200, responseString: $responseString);
    }
}
?>