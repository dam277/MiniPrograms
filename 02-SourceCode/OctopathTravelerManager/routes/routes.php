<?php
/**
 * Author: Damien Loup & Thomas Rey
 * Date: 17-06-2025
 * Description: This file contains the routes for the application, defining the actions and their corresponding controllers and functions. 
 */
require_once(__DIR__ . "/Route.php");
require_once(__DIR__ . "/../Controllers/subControllers/HomeController.php");
require_once(__DIR__ . "/../Controllers/subControllers/CharacterController.php");
require_once(__DIR__ . "/../Controllers/subControllers/GameController.php");

// Define the routes for the application
Route::get(action:"home", 
    controller:HomeController::class, function:"home");

Route::get(action:"abilities", 
    controller:CharacterController::class, function:"abilities");

Route::get(action:"characters", 
    controller:CharacterController::class, function:"characters");

Route::get(action:"characters", 
    controller:CharacterController::class, function:"gameCharacters",
    params: ["gameId"]);

Route::get(action:"characters",
    controller:CharacterController::class, function:"characterDetails", 
    params: ["id", "tab"]);

Route::get(action:"game",
    controller:GameController::class, function:"game", 
    params: ["id"]);
?>