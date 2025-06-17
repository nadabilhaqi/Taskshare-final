<?php
class Database extends mysqli {
  public function __construct() {
    parent::__construct('localhost', 'root', '', 'taskshare_db');
    if ($this->connect_error) {
      die('Connection failed: ' . $this->connect_error);
    }
  }
}