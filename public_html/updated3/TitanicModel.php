<?php
require_once 'Database.php';
class TitanicModel
{
    private $pdo;
    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }
    // Method: ดึงข้อมูลพร้อมแบ่งหน้า
    public function getPaginatedData($limit, $offset)
    {
        $sql = "SELECT * FROM titanic LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Method: นับจำนวนข้อมูลทั้งหมด
    public function getTotalRecords()
    {
        $sql = "SELECT COUNT(*) AS total FROM titanic";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}