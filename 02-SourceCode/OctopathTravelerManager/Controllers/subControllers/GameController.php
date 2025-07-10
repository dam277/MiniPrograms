<?php
require_once(__DIR__ . "/../Controller.php");
require_once(__DIR__ . "/../../Models/tables/Games.php");

class GameController extends Controller
{
    public function game($params)
    {
        [
            "id" => $id
        ] = $params;

        $game = Games::getById($id)[0];

        // Render the game view
        $responseString = View::get(viewName: "game.default", params: ["game" => $game]);

        // Return the response
        return new Response(httpCode: 200, responseString: $responseString);
    }
}
?>