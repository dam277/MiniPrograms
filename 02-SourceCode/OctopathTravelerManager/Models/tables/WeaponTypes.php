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
class WeaponTypes extends Model
{
    public int $id_weaponType;
    public string $name;
    public string $image;

    public static function getWeaponTypesByClassId(int $classId, ?int $id_secondaryClass = null): ?array
    {
        // Get the database instance
        $db = Database::getInstance();

        $query = "SELECT DISTINCT wt.* FROM weaponTypes wt
                    NATURAL JOIN classes_weapontypes cw
                    WHERE id_class = :classId OR id_class = :id_secondaryClass";

        $binds = 
        [
            ["param" => ":classId", "value" => $classId, "type" => PDO::PARAM_INT],
            ["param" => ":id_secondaryClass", "value" => $id_secondaryClass, "type" => PDO::PARAM_INT]
        ];

        // Execute the query and return the result
        ["data" => $data] = $db->QueryPrepareExecute($query, $binds, static::class);

        return !empty($data) ? $data : null;
    }
}
