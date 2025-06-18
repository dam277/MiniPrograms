<?php
require_once __DIR__ . '/../Model.php';

class FileRow extends Model
{
    private int $id_row;
    private int $id_file;
    private mixed $rowJsonData;

    public function getIdRow(): int { return $this->id_row; }
    public function getIdFile(): int { return $this->id_file; }
    public function getRowJsonData(): mixed { return $this->rowJsonData; }

    public function __construct()
    {
    }

    public static function getAllByFileId(int $fileId): array
    {
        $query = "SELECT * FROM " . static::class . " WHERE `id_file` = :fileId";
        $binds = 
        [
            ["param" =>  ":fileId", "value" => $fileId, "type" => PDO::PARAM_INT]
        ];

        ["data" => $data] = Database::getInstance()->QueryPrepareExecute(query: $query, binds: $binds, class: static::class);
        return $data;
    }
        
}
?>