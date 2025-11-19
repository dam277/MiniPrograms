<?php

/**
 * Author: Damien Loup & Thomas Rey
 * Date: 17-06-2025
 * Description: This class represents a task in the application.
 */
require_once __DIR__ . '/../Model.php';
/**
 * Task class represents a task in the application.
 * It contains properties such as id, projectId, name, description, and finished status.
 * This class provides methods to add a task to a project.
 */
class Characters extends Model
{
    public int $id_character;
    public string $name;
    public string $pathAction;
    public string $talent;
    public string $image;
    public string $backgroundImage;
    public int $fk_game;
    public int $fk_class;
    public ?int $fk_secondaryClass;

    public static function getAllByGameId(int $gameId): array
    {
        // Get the database instance
        $db = Database::getInstance();

        $query = "SELECT * FROM " . static::class . " WHERE fk_game = :gameId";

        $binds = 
        [
            ["param" => ":gameId", "value" => $gameId, "type" => PDO::PARAM_INT]
        ];

        // Execute the query and return the result
        ["data" => $data] = $db->QueryPrepareExecute($query, $binds, static::class);

        return $data;
    }

    public static function getAllWithGame(): array
    {
        // Get the database instance
        $db = Database::getInstance();
        $query = "SELECT c.*, g.name AS gameName FROM " . static::class . " c JOIN Games g ON c.fk_game = g.id_game";

        // Execute the query and return the result
        ["data" => $data] = $db->QuerySimpleExecute($query);

        return $data;
    }

    public static function getAllWithAll() : array
    {
        // Get the database instance
        $db = Database::getInstance();
        $query =    'SELECT c.*, 
                        cc.value AS "characteristicValue", 
                        ch.name AS "characteristicName", ch.image AS "characteristicImage",
                        g.name AS "gameName"
                    from characters c 
                    LEFT JOIN characteristics_characters cc ON c.id_character = cc.id_character 
                    LEFT JOIN characteristics ch ON cc.id_characteristic = ch.id_characteristic
                    INNER JOIN games g ON c.fk_game = g.id_game';

        // Execute the query and return the result
        ["data" => $data] = $db->QuerySimpleExecute($query);

        // Group the data by character
        $characters = [];
        foreach ($data as $character) 
        {
            $characterId = $character->id_character;
            if (!isset($characters[$characterId])) 
            {
                $char = new stdClass();
                $char->id_character = $characterId;
                $char->name = $character->name;
                $char->level = $character->level;
                $char->description = $character->description;
                $char->image = $character->image;
                $char->backgroundImage = $character->backgroundImage;
                $char->gameName = $character->gameName;
                $char->characteristics = [];
                $characters[$characterId] = $char;
            }

            $characteristic = new stdClass();
            $characteristic->value = $character->characteristicValue;
            $characteristic->image = $character->characteristicImage;
            
            $characters[$characterId]->characteristics[$character->characteristicName] = $characteristic;
        }
        return array_values($characters);
    }

    public static function getAllWithAllByGameId(int $gameId) : array
    {
        // Get the database instance
        $db = Database::getInstance();
        $query =    'SELECT c.id_character, c.name, c.level, c.description, c.image, c.backgroundImage, 
                        cc.value AS "characteristicValue", 
                        ch.name AS "characteristicName", ch.image AS "characteristicImage",
                        g.name AS "gameName"
                    from characters c 
                    LEFT JOIN characteristics_characters cc ON c.id_character = cc.id_character 
                    LEFT JOIN characteristics ch ON cc.id_characteristic = ch.id_characteristic
                    INNER JOIN games g ON c.fk_game = g.id_game
                    WHERE g.id_game = :gameId';

        $binds = 
        [
            ["param" => ":gameId", "value" => $gameId, "type" => PDO::PARAM_INT]
        ];

        // Execute the query and return the result
        ["data" => $data] = $db->QueryPrepareExecute($query, $binds);

        // Group the data by character
        $characters = [];
        foreach ($data as $character) 
        {
            $characterId = $character->id_character;
            if (!isset($characters[$characterId])) 
            {
                $char = new stdClass();
                $char->id_character = $characterId;
                $char->name = $character->name;
                $char->level = $character->level;
                $char->description = $character->description;
                $char->image = $character->image;
                $char->backgroundImage = $character->backgroundImage;
                $char->gameName = $character->gameName;
                $char->characteristics = [];
                $characters[$characterId] = $char;
            }

            $characteristic = new stdClass();
            $characteristic->value = $character->characteristicValue;
            $characteristic->image = $character->characteristicImage;
            
            $characters[$characterId]->characteristics[$character->characteristicName] = $characteristic;
        }
        return array_values($characters);
    }
}