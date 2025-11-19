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
class Classes extends Model
{
    public int $id_class;
    public string $name;
    public string $description;
    public string $image;

    /**
     * Get the class by its ID.
     *
     * @param int $id The ID of the class.
     * @return Classes[]|null Returns an array of Classes objects if found, null otherwise.
     */
    public static function getAllByCharacterId(int $characterId): ?array
    {
        // Get the database instance
        $db = Database::getInstance();

        $query ="SELECT cl.* FROM classes cl
                INNER JOIN characters ch ON cl.id_class = ch.fk_class OR cl.id_class = ch.fk_secondaryClass
                WHERE id_character = :characterId
                ORDER BY CASE WHEN cl.id_class = ch.fk_class THEN 0 ELSE 1 END";

        $binds = 
        [
            ["param" => ":characterId", "value" => $characterId, "type" => PDO::PARAM_INT]
        ];

        // Execute the query and return the result
        ["data" => $data] = $db->QueryPrepareExecute($query, $binds, static::class);

        return !empty($data) ? $data : null;
    }
}
