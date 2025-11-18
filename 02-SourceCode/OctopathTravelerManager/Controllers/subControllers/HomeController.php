<?php
require_once(__DIR__ . "/../Controller.php");
require_once(__DIR__ . "/../../Models/tables/Games.php");

class HomeController extends Controller
{
    public function home()
    {
        $games = Games::getAll();

        // Render the home view
        $responseString = View::get(viewName: "home.home", params: ["games" => $games]);

        // Return the response
        return new Response(httpCode: 200, responseString: $responseString);
    }
}
?>