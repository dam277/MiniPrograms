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
class Task extends Model
{
    public int $id;                 // Unique identifier for the task       
    public int $projectId;          // Identifier of the project to which the task belongs
    public string $name;            // Name of the task
    public string $description;     // Description of the task
    public bool $finished;          // Status of the task (finished or not)

    /**
     * Adds a new task to a project.
     * @param int $projectId The ID of the project to which the task belongs.
     * @param string $name The name of the task.
     * @param string $description The description of the task.
     * @param bool $finished The status of the task (default is false).
     * @return array The created task, or an empty array if creation failed.
     */
    public static function addTask(int $projectId, string $name, string $description, bool $finished = false): array
    {
        // Get the database instance
        $db = Database::getInstance();

        // Prepare the query to insert the data into the table
        $query = "INSERT INTO " . static::class . " (projectId, name, description, finished) VALUES (:projectId, :name, :description, :finished)";

        // Execute the query with the parameters
        $db->QueryPrepareExecute(
            $query,
            [
                ["param" => ":projectId", "value" => $projectId, "type" => PDO::PARAM_INT],
                ["param" => ":name", "value" => $name, "type" => PDO::PARAM_STR],
                ["param" => ":description", "value" => $description, "type" => PDO::PARAM_STR],
                ["param" => ":finished", "value" => $finished, "type" => PDO::PARAM_BOOL]
            ]
        );

        // Retrieve the created task by its ID and validate the data
        $task = self::getById($db->connector->lastInsertId());
        if (empty($task) || $task[0]->name != $name || $task[0]->description != $description || $task[0]->finished != $finished)
            return [];

        return $task;
    }
}
