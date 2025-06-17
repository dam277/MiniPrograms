<?php

/**
 * Author: Damien Loup & Thomas Rey
 * Date: 17-06-2025
 * Description: This file contains the Database class, which provides a singleton instance for database connection and query execution.
 */

/**
 * Database class provides a singleton instance for database connection and query execution.
 * It allows executing simple and prepared queries, formatting results, and managing database connections.
 * This class uses PDO for database interactions and ensures that only one instance of the database connection exists.
 */
class Database
{

    private static Database $instance;      // Singleton instance of the Database class
    public PDO $connector;                  // PDO connector for database interactions

    /**
     * Private constructor to prevent direct instantiation
     * Initializes the database connection
     */
    private function __construct(bool $withErrors)
    {
        try {
            $this->connector = new PDO(
                "mysql:host=localhost;port=3306;dbname=weba-te03-2025;charset=UTF8",
                "root",
                "root"
            );
            $this->connector->setAttribute(PDO::ATTR_ERRMODE, $withErrors ? PDO::ERRMODE_EXCEPTION : PDO::ERRMODE_SILENT);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Get the instance of the database
     * @return Database => the instance of the database
     */
    public static function getInstance(bool $withErrors = true): Database
    {
        if (!isset(self::$instance))
            self::$instance = new Database($withErrors);

        return self::$instance;
    }

    /**
     * Does a simple execution
     * @param query => query to execute
     * @return array<string,PDOStatement|array> the result of the query as an associative array
     */
    public function QuerySimpleExecute(string $query, $class = null): array
    {
        $req = $this->connector->prepare($query);
        $req->execute();
        return $this->FormatData($req, $class);
    }

    /**
     * Prepare and execute a query
     * @param query => query to execute
     * @param binds => binds of the query
     * @return array<string,PDOStatement|array> the result of the query as an associative array
     */
    public function QueryPrepareExecute(string $query, array $binds, $class = null): array
    {
        $req = $this->connector->prepare($query);
        foreach ($binds as $bind) {
            $req->bindValue($bind["param"], $bind["value"], $bind["type"]);
        }
        $req->execute();
        return $this->FormatData($req, $class);
    }

    /**
     * Format the req to an assoc array
     * @param req => req to format
     * @return array<string,PDOStatement|array> the result of the query as an associative array
     */
    private function FormatData(PDOStatement $req, $class): array
    {
        $data = [];
        if ($class == null)
            $data = $req->fetchAll(PDO::FETCH_OBJ);
        else
            $data = $req->fetchAll(PDO::FETCH_CLASS, $class);

        return ["data" => $data, "req" => $req];
    }

    /**
     * Unset data
     * @param req => request to close
     */
    public function UnsetData(PDOStatement $req): void
    {
        $req->closeCursor();
    }
}
