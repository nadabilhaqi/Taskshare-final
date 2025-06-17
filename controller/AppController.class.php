<?php
require_once 'model/TaskModel.class.php';
require_once 'model/FriendTaskModel.class.php';
require_once 'Database.class.php';

class AppController
{
  public function myTasks()
  {
    $model = new TaskModel();
    $tasks = $model->getAll();
    include 'view/mytasks.php';
  }

  public function login()
  {
    // $model = new FriendTaskModel();
    // $friendTasks = $model->getAll();
    include 'view/login.php';
  }

  public function friendTasks()
  {
    $model = new FriendTaskModel();
    $friendTasks = $model->getAll();
    include 'view/friendtasks.php';
  }

  public function groupedTasks()
  {
    require_once 'model/TaskModel.class.php';
    $model = new TaskModel();
    $groupedTasks = $model->getGroupedByCategory();
    include 'view/halaman2.php';
  }

  public function copyTask()
  {
    $id = $_GET['id'] ?? null;
    if ($id) {
      $db = new Database();
      $task = $db->query("SELECT * FROM tugas_teman WHERE id = $id")->fetch_assoc();
      $stmt = $db->prepare("INSERT INTO tasks (title, deadline, category) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $task['title'], $task['deadline'], $task['category']);
      $stmt->execute();
    }
    header('Location: index.php?c=AppController&m=myTasks');
  }
}
