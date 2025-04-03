<?php
class TitanicModel
{
    private $pdo;
    // Constructor: รับ PDO connection
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    // Method: ดึงข้อมูลทั้งหมดจากตาราง titanic
    public function getAll()
    {
        $sql = "SELECT * FROM titanic";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}