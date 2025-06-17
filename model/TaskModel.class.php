<?php
require_once 'Database.class.php';

class TaskModel {
  private $db;

  public function __construct() {
    $this->db = new Database();
  }

  public function getAll() {
    $sql = "SELECT id, title, deadline, status, category FROM tasks";
    return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
  }

  public function getGroupedByCategory() {
    $sql = "SELECT * FROM tasks";
    $result = $this->db->query($sql);

    $grouped = [];

    while ($row = $result->fetch_assoc()) {
        $category = $row['category'];
        $grouped[$category][] = $row;
    }

    return $grouped;
  }
}



