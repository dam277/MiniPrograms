<?php
require_once __DIR__ . '/../Model.php';

class File extends Model
{
    private int $id_file;
    private string $filName;
    private string $filAddedAt;
    private string $filUpdatedAt;
    private mixed $filHeaders;

    public function getIdFile(): int { return $this->id_file; }
    public function getFilName(): string { return $this->filName; }
    public function getFilAddedAt(): string { return $this->filAddedAt; }
    public function getFilUpdatedAt(): string { return $this->filUpdatedAt; }
    public function getFilHeaders(): mixed { return $this->filHeaders; }

    public function __construct()
    {
        // $this->addedAt = new DateTime();
        // $this->updatedAt = new DateTime();
    }

    public static function getById(int $id, string $where = ""): array
    {
        $where = "`id_file` = :id";
        return parent::getById(id: $id, where: $where);
    }
}
?>