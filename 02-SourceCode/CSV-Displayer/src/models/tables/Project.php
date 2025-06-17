<?php
/**
 * Author: Damien Loup & Thomas Rey
 * Date: 17-06-2025
 * Description: This class represents a project in the application.
 */
require_once __DIR__ . '/../Model.php';
require_once __DIR__ . '/Task.php';

/**
 * Project class represents a project in the application.
 * It contains properties such as id, name, deadline, and tasks.
 * This class provides methods to add a project, get all projects with their tasks, get a project by ID with its tasks, and get late projects.
 */
class Project extends Model
{
    public int $id;                 // Unique identifier for the project
    public string $name;            // Name of the project
    public $deadline;               // Deadline for the project
    /** @var Task[]|array */
    public array $tasks;            // Array of tasks associated with the project

    /**
     * Project constructor.
     * Initializes the project properties.
     */
    public function __construct()
    {
        if ($this->deadline != null && is_string($this->deadline)) 
            $this->deadline = new DateTime($this->deadline);
    }

    /**
     * Adds a new project to the database.
     * @param string $name The name of the project.
     * @param DateTime|null $deadline The deadline for the project, optional.
     * @return array The created project with its tasks, or an empty array if creation failed.
     */
    public static function addProject(string $name, ?DateTime $deadline = null): array
    {
        // Get the database instance
        $db = Database::getInstance();

        // Prepare the query to insert the data into the table
        $query = "INSERT INTO " . static::class . " (name, deadline) VALUES (:name, :deadline)";
        $binds = 
        [
            ["param" => ":name", "value" => $name, "type" => PDO::PARAM_STR],
            ["param" => ":deadline", "value" => isset($deadline) ? $deadline->format('Y-m-d H:i:s') : $deadline, "type" => PDO::PARAM_STR]
        ];

        // Execute the query with the parameters
        $db->QueryPrepareExecute($query, $binds);
        
        $project = self::getByIdWithTasks($db->connector->lastInsertId());
        if (empty($project) || $project[0][0]->name != $name || ($deadline && $project[0][0]->deadline != $deadline)) {
            return [];
        }
        return $project[0];
    }

    /**
     * Gets all projects with their associated tasks.
     * @return array An array containing all projects and their tasks.
     */
    public static function getAllWithTasks(): array
    {
        // Get the database instance
        $db = Database::getInstance();

        // Prepare the query to get all projects with their tasks
        //$query = "SELECT p.*, t.* FROM " . static::class . " p LEFT JOIN task t ON p.id = t.projectId";
        $queryProject = "SELECT * FROM " . static::class;
        $queryTask = "SELECT * FROM " . Task::class;


        // Execute the query and return the result
        //return $db->QuerySimpleExecute($query, static::class);
        ["data" => $projects] = $db->QuerySimpleExecute($queryProject, static::class);
        ["data" => $tasks] = $db->QuerySimpleExecute($queryTask, Task::class);

        return [$projects, $tasks];
    }

    /**
     * Gets a project by its ID along with its associated tasks.
     * @param int $id The ID of the project to retrieve.
     * @return array An array containing the project and its tasks.
     */
    public static function getByIdWithTasks(int $id): array
    {
        // Get the database instance
        $db = Database::getInstance();

        // Prepare the query to get the project by ID with its tasks
        $queryProject = "SELECT * FROM " . static::class . " WHERE id = :id";
        $queryTask = "SELECT * FROM " . Task::class . " WHERE projectId = :id";
        $projectBinds = 
        [
            ["param" => ":id", "value" => $id, "type" => PDO::PARAM_INT]
        ];
        $taskBinds = 
        [
            ["param" => ":id", "value" => $id, "type" => PDO::PARAM_INT]
        ];
        
        // Execute the query and return the result
        ["data" => $project] = $db->QueryPrepareExecute($queryProject, $projectBinds, static::class);
        ["data" => $tasks] = $db->QueryPrepareExecute($queryTask, $taskBinds, Task::class);

        return [$project, $tasks];
    }

    /**
     * Gets all projects that are late, meaning their deadline is in the past and they have unfinished tasks.
     * @return array An array of late projects with their unfinished tasks count.
     */
    public static function getLateProjects(): array
    {
        // Get the database instance
        $db = Database::getInstance();

        // Prepare the query to get all projects with a deadline in the past
        $query = "SELECT p.*, COUNT(t.id) AS 'unfinishedTask' FROM " . static::class . " p LEFT JOIN task t ON p.id = t.projectId AND t.finished = 0 WHERE deadline < NOW() GROUP BY p.id, p.name, p.deadline HAVING COUNT(t.id) > 0";

        // Execute the query and return the result
        ["data" => $data] = $db->QuerySimpleExecute($query, static::class);
        return $data;
    }
}
?>