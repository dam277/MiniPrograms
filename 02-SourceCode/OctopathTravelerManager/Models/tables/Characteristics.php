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
class Characteristics extends Model
{
    public int $id_characteristic;
    public string $name;
    public string $image;
}
