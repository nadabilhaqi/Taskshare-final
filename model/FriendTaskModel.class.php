<?php
require_once 'Database.class.php';

class FriendTaskModel {
  private $db;

  public function __construct() {
    $this->db = new Database();
  }

  public function getAll() {
    $sql = "SELECT id, title, deadline, category FROM tugas_teman";
    return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
  }
}

