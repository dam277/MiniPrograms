<?php
/**
 * Author: Damien Loup & Thomas Rey
 * Date: 17-06-2025
 * Description: This file contains the routes for the application, defining the actions and their corresponding controllers and functions. 
 */
require_once(__DIR__ . "/../Controllers/subControllers/HomeController.php");
require_once(__DIR__ . "/Route.php");

// Define the routes for the application
Route::get(action:"home", controller:HomeController::class, function:"home");
Route::get(action:"details", controller:HomeController::class, function:"details", params: ["id"]);
?>